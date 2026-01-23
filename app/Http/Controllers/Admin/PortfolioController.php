<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    /**
     * Display a listing of portfolios
     */
    public function index(): View
    {
        $portfolios = Portfolio::ordered()->paginate(10);
        return view('admin.portfolio.index', compact('portfolios'));
    }

    /**
     * Show the form for creating a new portfolio
     */
    public function create(): View
    {
        return view('admin.portfolio.create');
    }

    /**
     * Store a newly created portfolio
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'display_order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        // Handle defaults
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['display_order'] = $validated['display_order'] ?? 0;

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('portfolio', 'public');
        }

        Portfolio::create($validated);

        return redirect()
            ->route('admin.portfolio.index')
            ->with('success', 'Portfolio berhasil ditambahkan!');
    }

    /**
     * Display the specified portfolio
     */
    public function show(Portfolio $portfolio): View
    {
        return view('admin.portfolio.show', compact('portfolio'));
    }

    /**
     * Show the form for editing the specified portfolio
     */
    public function edit(Portfolio $portfolio): View
    {
        return view('admin.portfolio.edit', compact('portfolio'));
    }

    /**
     * Update the specified portfolio
     */
    public function update(Request $request, Portfolio $portfolio): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'display_order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        // Handle defaults
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');
        $validated['display_order'] = $validated['display_order'] ?? $portfolio->display_order;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($portfolio->image && !filter_var($portfolio->image, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($portfolio->image);
            }

            $validated['image'] = $request->file('image')
                ->store('portfolio', 'public');
        }

        $portfolio->update($validated);

        return redirect()
            ->route('admin.portfolio.index')
            ->with('success', 'Portfolio berhasil diperbarui!');
    }

    /**
     * Remove the specified portfolio
     */
    public function destroy(Portfolio $portfolio): RedirectResponse
    {
        // Delete image if exists
        if ($portfolio->image && !filter_var($portfolio->image, FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete($portfolio->image);
        }

        $portfolio->delete();

        return redirect()
            ->route('admin.portfolio.index')
            ->with('success', 'Portfolio berhasil dihapus!');
    }
}
