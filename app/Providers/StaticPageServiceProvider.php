<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//use Illuminate\Support\Facades\Schema;

class StaticPageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        //Schema::defaultStringLength(191);
        // Views
        $this->loadViewsFrom(__DIR__ . '/../../resources/views/admin/page', 'laravel-static-pages');

        // Binding
        $this->app->bind('App\Interfaces\StaticPagesInterface',
            'App\Page');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
