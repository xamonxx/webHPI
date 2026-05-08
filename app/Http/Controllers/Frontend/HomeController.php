<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Statistic;
use App\Models\Testimonial;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the landing page
     * READ ONLY - No authentication required
     */
    public function index(): View
    {
        // Get active Hero Section
        $hero = HeroSection::active()->first();

        // Get Statistics (first 4)
        $statistics = Statistic::active()
            ->ordered()
            ->limit(4)
            ->get();

        // Get Featured/Active Portfolios in curated display order
        $portfolios = Portfolio::active()
            ->with('photos')
            ->featured()
            ->ordered()
            ->limit(4)
            ->get();

        // Get Active Services
        $services = Service::active()
            ->ordered()
            ->get();

        // Get Active Testimonials
        $testimonials = Testimonial::active()
            ->ordered()
            ->get();

        // Get Site Settings
        $settings = SiteSetting::getAllAsArray();

        return view('frontend.home', compact(
            'hero',
            'statistics',
            'portfolios',
            'services',
            'testimonials',
            'settings'
        ));
    }
}
