<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Models\SiteSetting;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer(['frontend.partials.navbar', 'frontend.partials.footer', 'frontend.index'], function ($view) {
            $view->with('setting', SiteSetting::first());
        });
    }
}
