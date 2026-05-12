<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Statistic;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the landing page
     * READ ONLY - No authentication required
     */
    public function index(): View
    {
        $data = Cache::remember('frontend.home.data', now()->addMinutes(10), function () {
            return [
                'hero' => HeroSection::active()->first(),
                'statistics' => Statistic::active()
                    ->ordered()
                    ->limit(4)
                    ->get(),
                'portfolios' => Portfolio::active()
                    ->with('photos')
                    ->featured()
                    ->ordered()
                    ->limit(4)
                    ->get(),
                'services' => Service::active()
                    ->ordered()
                    ->get(),
                'testimonials' => Testimonial::active()
                    ->ordered()
                    ->get(),
                'settings' => SiteSetting::getAllAsArray(),
            ];
        });

        return view('frontend.home', $data);
    }
}
