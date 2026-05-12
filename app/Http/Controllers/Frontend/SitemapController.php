<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Service;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $content = Cache::remember('sitemap.xml', now()->addHour(), function () {
            $portfolios = Portfolio::where('is_active', true)->orderBy('updated_at', 'desc')->get();
            $services = Service::where('is_active', true)->orderBy('updated_at', 'desc')->get();
            $categories = Portfolio::query()
                ->where('is_active', true)
                ->whereNotNull('category')
                ->where('category', '!=', '')
                ->orderBy('category')
                ->pluck('category')
                ->unique()
                ->values();

            $xml = fn (string $value): string => htmlspecialchars($value, ENT_XML1 | ENT_COMPAT, 'UTF-8');

            $content = '<?xml version="1.0" encoding="UTF-8"?>';
            $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

            foreach ($this->staticRoutes() as $uri => $meta) {
                $content .= '<url>';
                $content .= '<loc>'.$xml(url($uri)).'</loc>';
                $content .= '<lastmod>'.now()->toW3cString().'</lastmod>';
                $content .= '<changefreq>'.$meta['freq'].'</changefreq>';
                $content .= '<priority>'.$meta['priority'].'</priority>';
                $content .= '</url>';
            }

            foreach ($categories as $category) {
                $content .= '<url>';
                $content .= '<loc>'.$xml(route('portfolio.all', ['category' => $category])).'</loc>';
                $content .= '<lastmod>'.now()->toW3cString().'</lastmod>';
                $content .= '<changefreq>weekly</changefreq>';
                $content .= '<priority>0.75</priority>';
                $content .= '</url>';
            }

            foreach ($services as $service) {
                $content .= '<url>';
                $content .= '<loc>'.$xml(route('services.show', $service->id)).'</loc>';
                $content .= '<lastmod>'.$service->updated_at->toW3cString().'</lastmod>';
                $content .= '<changefreq>monthly</changefreq>';
                $content .= '<priority>0.7</priority>';
                $content .= '</url>';
            }

            foreach ($portfolios as $portfolio) {
                $content .= '<url>';
                $content .= '<loc>'.$xml(route('portfolio.show', $portfolio->id)).'</loc>';
                $content .= '<lastmod>'.$portfolio->updated_at->toW3cString().'</lastmod>';
                $content .= '<changefreq>monthly</changefreq>';
                $content .= '<priority>0.7</priority>';
                $content .= '</url>';
            }

            return $content.'</urlset>';
        });

        return response($content, 200, [
            'Content-Type' => 'application/xml',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    private function staticRoutes(): array
    {
        return [
            '/' => ['priority' => '1.0', 'freq' => 'weekly'],
            '/services' => ['priority' => '0.8', 'freq' => 'monthly'],
            '/portfolio' => ['priority' => '0.8', 'freq' => 'weekly'],
        ];
    }
}
