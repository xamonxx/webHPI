<?php

use App\Http\Controllers\Admin\ContactSubmissionController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\TestimonialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (CMS - FULL CRUD)
|--------------------------------------------------------------------------
|
| These routes are for the admin CMS panel.
| Protected with authentication.
| Full CRUD operations.
|
| Domain: admin.example.com (or admin.homeputra-laravel.test locally)
|
*/

// Auth Routes (Public - no middleware)
Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware(['guest', 'throttle:5,1']);
Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Protected Admin Routes
Route::middleware(['admin'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Hero Section
    Route::get('/hero', [HeroController::class, 'index'])->name('admin.hero.index');
    Route::put('/hero', [HeroController::class, 'update'])->name('admin.hero.update');

    // Portfolio CRUD
    Route::resource('portfolio', PortfolioController::class)->names([
        'index' => 'admin.portfolio.index',
        'create' => 'admin.portfolio.create',
        'store' => 'admin.portfolio.store',
        'show' => 'admin.portfolio.show',
        'edit' => 'admin.portfolio.edit',
        'update' => 'admin.portfolio.update',
        'destroy' => 'admin.portfolio.destroy',
    ]);

    // Services CRUD
    Route::resource('services', ServiceController::class)->names([
        'index' => 'admin.services.index',
        'create' => 'admin.services.create',
        'store' => 'admin.services.store',
        'show' => 'admin.services.show',
        'edit' => 'admin.services.edit',
        'update' => 'admin.services.update',
        'destroy' => 'admin.services.destroy',
    ]);

    // Testimonials CRUD
    Route::resource('testimonials', TestimonialController::class)->names([
        'index' => 'admin.testimonials.index',
        'create' => 'admin.testimonials.create',
        'store' => 'admin.testimonials.store',
        'show' => 'admin.testimonials.show',
        'edit' => 'admin.testimonials.edit',
        'update' => 'admin.testimonials.update',
        'destroy' => 'admin.testimonials.destroy',
    ]);

    // Messages (Read Only + Delete)
    Route::resource('messages', ContactSubmissionController::class)
        ->only(['index', 'show', 'destroy'])
        ->names([
            'index' => 'admin.messages.index',
            'show' => 'admin.messages.show',
            'destroy' => 'admin.messages.destroy',
        ]);

    // Statistics Management
    Route::resource('statistics', StatisticController::class)->except(['create', 'show', 'edit'])->names([
        'index' => 'admin.statistics.index',
        'store' => 'admin.statistics.store',
        'update' => 'admin.statistics.update',
        'destroy' => 'admin.statistics.destroy',
    ]);

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('admin.settings.update');
});
