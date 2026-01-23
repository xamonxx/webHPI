<?php

namespace App\Providers;

use App\Models\ContactSubmission;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     * Share settings with ALL views automatically.
     */
    public function boot(): void
    {
        // Share settings globally across ALL views
        View::composer('*', function ($view) {
            if (!isset($view->getData()['settings'])) {
                $view->with('settings', SiteSetting::getAllAsArray());
            }

            // Share unread messages count for admin panel
            if (!isset($view->getData()['unreadMessagesCount'])) {
                $view->with('unreadMessagesCount', ContactSubmission::unread()->count());
            }
        });
    }
}
