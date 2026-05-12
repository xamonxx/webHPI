<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PortfolioController;
use App\Http\Controllers\Frontend\ServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES (Landing Page - READ ONLY)
|--------------------------------------------------------------------------
|
| These routes are for the public landing page.
| No authentication required.
| All operations are READ ONLY.
|
| Domain: example.com (or homeputra-laravel.test locally)
|
*/

// Home / Landing Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Portfolio
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.all');
Route::get('/portfolio/{portfolio}', [PortfolioController::class, 'show'])->name('portfolio.show');

// Services
Route::get('/services', [ServiceController::class, 'index'])->name('services.all');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');

// --- AUTHENTICATION SAFETY NET ---
// Fixes "Route [login] not defined" error if generic auth middleware triggers
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// --- SITEMAP FOR SEO ---
require __DIR__.'/sitemap.php';
