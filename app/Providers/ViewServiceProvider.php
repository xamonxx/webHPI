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
     *
     * Uses scoped View::composer() instead of '*' wildcard to prevent
     * running queries on every partial/component render. Each composer
     * targets only the layout files, so queries execute once per request.
     */
    public function boot(): void
    {
        // Share settings with frontend layout (resolves once, inherited by all partials)
        View::composer('frontend.layouts.app', function ($view) {
            if (! isset($view->getData()['settings'])) {
                $view->with('settings', SiteSetting::getAllAsArray());
            }
        });

        // Share settings + unread count with admin layout only
        View::composer('admin.layouts.app', function ($view) {
            if (! isset($view->getData()['settings'])) {
                $view->with('settings', SiteSetting::getAllAsArray());
            }

            if (! isset($view->getData()['unreadMessagesCount'])) {
                $view->with('unreadMessagesCount', ContactSubmission::unread()->count());
            }
        });

        // Admin login page needs settings but not unread count
        View::composer('admin.auth.login', function ($view) {
            if (! isset($view->getData()['settings'])) {
                $view->with('settings', SiteSetting::getAllAsArray());
            }
        });
    }
}
