<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PortfolioRequest;
use App\Models\Portfolio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

class PortfolioController extends Controller
{
    private const PHOTO_DISK = 'public';

    private const PHOTO_DIRECTORY = 'portfolio';

    private const MAX_PHOTOS = 5;

    public function index(): View
    {
        $portfolios = Portfolio::query()
            ->with('photos')
            ->ordered()
            ->paginate(10);

        $totalPortfolios = Portfolio::count();

        return view('admin.portfolio.index', compact('portfolios', 'totalPortfolios'));
    }

    public function create(): View
    {
        $categories = $this->portfolioCategories();

        return view('admin.portfolio.create', compact('categories'));
    }

    public function store(PortfolioRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $storedPaths = [];

        try {
            $storedPaths = $this->storeUploadedPhotos($request->file('photos', []));

            DB::transaction(function () use ($validated, $request, $storedPaths) {
                $portfolio = Portfolio::create($this->portfolioPayload($validated, $request, $storedPaths));
                $this->createPhotoRows($portfolio, $storedPaths);
            });
        } catch (Throwable $exception) {
            $this->deleteFiles($storedPaths);
            Log::error('Portfolio upload failed during create.', [
                'message' => $exception->getMessage(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Upload gagal, silakan coba lagi.')
                ->withErrors(['photos' => 'Upload gagal, silakan coba lagi.']);
        }

        $this->clearFrontendCache();

        return redirect()
            ->route('admin.portfolio.index')
            ->with('success', 'Portfolio berhasil ditambahkan!');
    }

    public function show(Portfolio $portfolio): View
    {
        $portfolio->load('photos');

        return view('admin.portfolio.show', compact('portfolio'));
    }

    public function edit(Portfolio $portfolio): View
    {
        $portfolio->load('photos');
        $categories = $this->portfolioCategories($portfolio->category);

        return view('admin.portfolio.edit', compact('portfolio', 'categories'));
    }

    public function update(PortfolioRequest $request, Portfolio $portfolio): RedirectResponse
    {
        $portfolio->load('photos');

        $validated = $request->validated();
        $currentPhotoIds = $portfolio->photos->pluck('id');
        $existingPhotoIds = collect($validated['existing_photos'] ?? $currentPhotoIds->all())
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->intersect($currentPhotoIds);
        $removedPhotoIds = collect($validated['removed_photos'] ?? [])
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->intersect($currentPhotoIds);
        $keptPhotoIds = $existingPhotoIds->diff($removedPhotoIds)->values();
        $newFiles = $request->file('photos', []);
        $newFileCount = is_array($newFiles) ? count($newFiles) : 0;
        $finalPhotoCount = $keptPhotoIds->count() + $newFileCount;

        if ($finalPhotoCount < 1) {
            return back()
                ->withInput()
                ->withErrors(['photos' => 'Minimal 1 foto portfolio wajib tersedia.'])
                ->with('error', 'Minimal 1 foto portfolio wajib tersedia.');
        }

        if ($finalPhotoCount > self::MAX_PHOTOS) {
            return back()
                ->withInput()
                ->withErrors(['photos' => 'Maksimal upload '.self::MAX_PHOTOS.' foto portfolio.'])
                ->with('error', 'Maksimal upload '.self::MAX_PHOTOS.' foto portfolio.');
        }

        $newPaths = [];
        $pathsToDeleteAfterCommit = [];

        try {
            $newPaths = $this->storeUploadedPhotos($newFiles);

            DB::transaction(function () use (
                $portfolio,
                $validated,
                $request,
                $removedPhotoIds,
                $newPaths,
                &$pathsToDeleteAfterCommit
            ) {
                $pathsToDeleteAfterCommit = $portfolio->photos()
                    ->whereIn('id', $removedPhotoIds)
                    ->pluck('path')
                    ->all();

                if ($removedPhotoIds->isNotEmpty()) {
                    $portfolio->photos()->whereIn('id', $removedPhotoIds)->delete();
                }

                $nextOrder = $portfolio->photos()->max('sort_order') ?: 0;
                foreach ($newPaths as $path) {
                    $portfolio->photos()->create([
                        'path' => $path,
                        'sort_order' => ++$nextOrder,
                    ]);
                }

                $portfolio->load('photos');
                $paths = $portfolio->photos->pluck('path')->values()->all();
                $portfolio->update($this->portfolioPayload($validated, $request, $paths));
            });
        } catch (Throwable $exception) {
            $this->deleteFiles($newPaths);
            Log::error('Portfolio upload failed during update.', [
                'portfolio_id' => $portfolio->id,
                'message' => $exception->getMessage(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Upload gagal, silakan coba lagi.')
                ->withErrors(['photos' => 'Upload gagal, silakan coba lagi.']);
        }

        $this->deleteFiles($pathsToDeleteAfterCommit);

        $this->clearFrontendCache();

        return redirect()
            ->route('admin.portfolio.index')
            ->with('success', 'Portfolio berhasil diperbarui!');
    }

    public function destroy(Portfolio $portfolio): RedirectResponse
    {
        $portfolio->load('photos');
        $paths = $portfolio->photos->pluck('path')->all();

        try {
            DB::transaction(fn () => $portfolio->delete());
        } catch (Throwable $exception) {
            Log::error('Portfolio delete failed.', [
                'portfolio_id' => $portfolio->id,
                'message' => $exception->getMessage(),
            ]);

            return back()->with('error', 'Portfolio gagal dihapus, silakan coba lagi.');
        }

        $this->deleteFiles($paths);

        $this->clearFrontendCache();

        return redirect()
            ->route('admin.portfolio.index')
            ->with('success', 'Portfolio berhasil dihapus!');
    }

    private function portfolioPayload(array $validated, PortfolioRequest $request, array $paths): array
    {
        $paths = collect($paths)->filter()->unique()->values()->all();

        return [
            'title' => $validated['title'],
            'category' => $validated['category'] ?? null,
            'description' => $validated['description'] ?? null,
            'image' => $paths[0] ?? null,
            'slider_images' => $paths,
            'display_order' => $validated['display_order'] ?? 0,
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active', true),
        ];
    }

    private function portfolioCategories(?string $currentCategory = null): Collection
    {
        $defaultCategories = [
            'Kitchen Set',
            'Lemari & Wardrobe',
            'Backdrop TV',
            'Wallpanel',
            'Interior Design',
            'Furniture Custom',
            'Renovation',
            'Komersial',
            'Residensial',
        ];

        $storedCategories = Portfolio::query()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->orderBy('category')
            ->pluck('category')
            ->all();

        return collect($defaultCategories)
            ->merge($storedCategories)
            ->when($currentCategory, fn (Collection $categories) => $categories->push($currentCategory))
            ->filter(fn ($category) => is_string($category) && trim($category) !== '')
            ->map(fn (string $category) => trim($category))
            ->unique()
            ->values();
    }

    private function storeUploadedPhotos(array $files): array
    {
        $paths = [];

        foreach ($files as $file) {
            $extension = strtolower($file->getClientOriginalExtension() ?: $file->extension());
            $filename = Str::uuid()->toString().'.'.$extension;
            $path = $file->storeAs(self::PHOTO_DIRECTORY, $filename, self::PHOTO_DISK);

            if (! $path) {
                throw new \RuntimeException('Failed to store uploaded portfolio photo.');
            }

            $paths[] = $path;
        }

        return $paths;
    }

    private function createPhotoRows(Portfolio $portfolio, array $paths): void
    {
        foreach ($paths as $index => $path) {
            $portfolio->photos()->create([
                'path' => $path,
                'sort_order' => $index + 1,
            ]);
        }
    }

    private function deleteFiles(array|Collection $paths): void
    {
        collect($paths)
            ->filter(fn ($path) => is_string($path) && $path !== '')
            ->reject(fn ($path) => filter_var($path, FILTER_VALIDATE_URL))
            ->reject(fn ($path) => str_starts_with($path, 'assets/'))
            ->unique()
            ->each(function (string $path) {
                try {
                    Storage::disk(self::PHOTO_DISK)->delete($path);
                } catch (Throwable $exception) {
                    Log::warning('Unable to delete portfolio photo.', [
                        'path' => $path,
                        'message' => $exception->getMessage(),
                    ]);
                }
            });
    }

    private function clearFrontendCache(): void
    {
        Cache::forget('frontend.home.data');
        Cache::forget('sitemap.xml');
    }
}
