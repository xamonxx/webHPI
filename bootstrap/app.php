<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            /*
            |--------------------------------------------------------------------------
            | Admin Routes Configuration
            |--------------------------------------------------------------------------
            |
            | Konfigurasi routing admin yang fleksibel:
            |
            | MODE 1: Subdomain (Production)
            | - Akses via: admin.homeputrainterior.com
            | - Set ADMIN_SUBDOMAIN=true di .env
            |
            | MODE 2: Path-based (Local Development)
            | - Akses via: homeputra-laravel.test/admin
            | - Set ADMIN_SUBDOMAIN=false di .env (atau tidak diset)
            |
            */

            $useSubdomain = env('ADMIN_SUBDOMAIN', false);
            $adminDomain = env('ADMIN_DOMAIN', 'admin.' . env('APP_DOMAIN', 'homeputrainterior.com'));

            if ($useSubdomain) {
                // MODE 1: Subdomain-based routing (Production)
                // URL: admin.homeputrainterior.com
                Route::middleware('web')
                    ->domain($adminDomain)
                    ->group(base_path('routes/admin.php'));
            } else {
                // MODE 2: Path-based routing (Local Development)
                // URL: homeputra-laravel.test/admin
                Route::middleware('web')
                    ->prefix('admin')
                    ->group(base_path('routes/admin.php'));
            }
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Register admin middleware alias
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminAuthenticate::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
