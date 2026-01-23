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

        $query = Portfolio::active()->ordered();

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
        // Only show if active
        if (!$portfolio->is_active) {
            abort(404);
        }

        return view('frontend.portfolio-detail', compact('portfolio'));
    }
}
