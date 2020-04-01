<?php

namespace App\Providers;

use App\Observers\PhotoObserver;
use App\Photo;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Photo::observe(PhotoObserver::class);
    }
}
