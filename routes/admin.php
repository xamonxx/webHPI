<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TestimonialController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('/login', function () {
    return view('admin.auth.login');
})->name('admin.login')->middleware('guest');

Route::post('/login', function () {
    $credentials = request()->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    // Try to authenticate with username
    if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
        request()->session()->regenerate();

        // Update last login
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->update(['last_login' => now()]);

        return redirect()->intended(route('admin.dashboard'));
    }

    return back()->withErrors([
        'username' => 'Username atau password salah.',
    ])->onlyInput('username');
})->middleware('guest');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('admin.login');
})->name('admin.logout');

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
    Route::resource('messages', \App\Http\Controllers\Admin\ContactSubmissionController::class)
        ->only(['index', 'show', 'destroy'])
        ->names([
            'index' => 'admin.messages.index',
            'show' => 'admin.messages.show',
            'destroy' => 'admin.messages.destroy',
        ]);

    // Statistics Management
    Route::resource('statistics', \App\Http\Controllers\Admin\StatisticController::class)->except(['create', 'show', 'edit'])->names([
        'index' => 'admin.statistics.index',
        'store' => 'admin.statistics.store',
        'update' => 'admin.statistics.update',
        'destroy' => 'admin.statistics.destroy',
    ]);

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('admin.settings.update');
});
