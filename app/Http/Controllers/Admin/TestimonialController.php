<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    /**
     * Display a listing of testimonials
     */
    public function index(): View
    {
        $testimonials = Testimonial::ordered()->latest()->paginate(10);

        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new testimonial
     */
    public function create(): View
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created testimonial
     */
    public function store(TestimonialRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['display_order'] = $validated['display_order'] ?? 0;
        $uploadedPath = null;

        if ($request->hasFile('client_image')) {
            $uploadedPath = $request->file('client_image')->store('testimonials', 'public');
            $validated['client_image'] = $uploadedPath;
        }

        try {
            Testimonial::create($validated);
        } catch (\Throwable $exception) {
            if ($uploadedPath) {
                Storage::disk('public')->delete($uploadedPath);
            }

            report($exception);

            return back()
                ->withInput()
                ->with('error', 'Testimoni gagal ditambahkan, silakan coba lagi.');
        }

        $this->clearFrontendCache();

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil ditambahkan!');
    }

    /**
     * Display the specified testimonial
     */
    public function show(Testimonial $testimonial): View
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified testimonial
     */
    public function edit(Testimonial $testimonial): View
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified testimonial
     */
    public function update(TestimonialRequest $request, Testimonial $testimonial): RedirectResponse
    {
        $validated = $request->validated();

        $validated['is_active'] = $request->boolean('is_active');
        $validated['display_order'] = $validated['display_order'] ?? $testimonial->display_order;
        $uploadedPath = null;
        $oldImage = null;

        if ($request->hasFile('client_image')) {
            $oldImage = $testimonial->client_image && ! filter_var($testimonial->client_image, FILTER_VALIDATE_URL)
                ? $testimonial->client_image
                : null;

            $uploadedPath = $request->file('client_image')->store('testimonials', 'public');
            $validated['client_image'] = $uploadedPath;
        }

        try {
            $testimonial->update($validated);
        } catch (\Throwable $exception) {
            if ($uploadedPath) {
                Storage::disk('public')->delete($uploadedPath);
            }

            report($exception);

            return back()
                ->withInput()
                ->with('error', 'Testimoni gagal diperbarui, silakan coba lagi.');
        }

        if ($oldImage) {
            Storage::disk('public')->delete($oldImage);
        }

        $this->clearFrontendCache();

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil diperbarui!');
    }

    /**
     * Remove the specified testimonial
     */
    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        try {
            if ($testimonial->client_image && ! filter_var($testimonial->client_image, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($testimonial->client_image);
            }

            $testimonial->delete();
        } catch (\Throwable $exception) {
            report($exception);

            return back()->with('error', 'Testimoni gagal dihapus, silakan coba lagi.');
        }

        $this->clearFrontendCache();

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil dihapus!');
    }

    private function clearFrontendCache(): void
    {
        Cache::forget('frontend.home.data');
    }
}
