<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Jenssegers\Mongodb\Eloquent\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Builder::macro('getName', function() {
            return 'mongodb';
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
