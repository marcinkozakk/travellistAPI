<?php

namespace App\Providers;

use App\Follow;
use App\Like;
use App\Observers\FollowObserver;
use App\Observers\LikeObserver;
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
        Like::observe(LikeObserver::class);
        Follow::observe(FollowObserver::class);
    }
}
