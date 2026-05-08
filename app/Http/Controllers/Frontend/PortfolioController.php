<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    /**
     * Display all portfolios with optional category filter
     */
    public function index(Request $request): View
    {
        $category = $request->get('category');

        $query = Portfolio::active()->with('photos')->ordered();

        if ($category) {
            $query->where('category', $category);
        }

        $portfolios = $query->paginate(12);

        // Get unique categories for filter
        $categories = Portfolio::active()
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        return view('frontend.portfolio-all', compact(
            'portfolios',
            'categories',
            'category'
        ));
    }

    /**
     * Display single portfolio detail (optional)
     */
    public function show(Portfolio $portfolio): View
    {
        $portfolio->load('photos');

        // Only show if active
        if (! $portfolio->is_active) {
            abort(404);
        }

        $related = Portfolio::active()
            ->with('photos')
            ->where('id', '!=', $portfolio->id)
            ->when($portfolio->category, function ($query) use ($portfolio) {
                $query->where('category', $portfolio->category);
            })
            ->ordered()
            ->limit(4)
            ->get();

        if ($related->count() < 4) {
            $fallback = Portfolio::active()
                ->with('photos')
                ->where('id', '!=', $portfolio->id)
                ->whereNotIn('id', $related->pluck('id'))
                ->ordered()
                ->limit(4 - $related->count())
                ->get();

            $related = $related->merge($fallback);
        }

        return view('frontend.portfolio-detail', compact('portfolio', 'related'));
    }
}
