<?php

/**
 * Dynamic Sitemap Generator for Home Putra Interior
 * This generates an XML sitemap for better SEO indexing
 */

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Models\Portfolio;
use App\Models\Service;

Route::get('/sitemap.xml', function () {
    $portfolios = Portfolio::where('is_active', true)->orderBy('updated_at', 'desc')->get();

    $content = '<?xml version="1.0" encoding="UTF-8"?>';
    $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    // Static Pages
    $routes = [
        '/' => ['priority' => '1.0', 'freq' => 'weekly'],
        '/services' => ['priority' => '0.8', 'freq' => 'monthly'],
        '/portfolio' => ['priority' => '0.8', 'freq' => 'weekly'],
        '/calculator' => ['priority' => '0.9', 'freq' => 'monthly'],
    ];

    foreach ($routes as $uri => $meta) {
        $content .= '<url>';
        $content .= '<loc>' . url($uri) . '</loc>';
        $content .= '<lastmod>' . now()->toW3cString() . '</lastmod>';
        $content .= '<changefreq>' . $meta['freq'] . '</changefreq>';
        $content .= '<priority>' . $meta['priority'] . '</priority>';
        $content .= '</url>';
    }

    // Portfolios (using ID since slug column doesn't exist)
    foreach ($portfolios as $portfolio) {
        $content .= '<url>';
        $content .= '<loc>' . route('portfolio.show', $portfolio->id) . '</loc>';
        $content .= '<lastmod>' . $portfolio->updated_at->toW3cString() . '</lastmod>';
        $content .= '<changefreq>monthly</changefreq>';
        $content .= '<priority>0.7</priority>';
        $content .= '</url>';
    }

    $content .= '</urlset>';

    return Response::make($content, 200, [
        'Content-Type' => 'application/xml'
    ]);
})->name('sitemap');
