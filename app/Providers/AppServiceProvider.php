<?php

namespace App\Providers;

use App\Follow;
use App\Like;
use App\Location;
use App\Note;
use App\Notification;
use App\Observers\FollowObserver;
use App\Observers\LikeObserver;
use App\Observers\LocationObserver;
use App\Observers\NoteObserver;
use App\Observers\NotificationObserver;
use App\Observers\PhotoObserver;
use App\Observers\TravelObserver;
use App\Photo;
use App\Travel;
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
        Follow::observe(FollowObserver::class);
        Like::observe(LikeObserver::class);
        Location::observe(LocationObserver::class);
        Note::observe(NoteObserver::class);
        Notification::observe(NotificationObserver::class);
        Photo::observe(PhotoObserver::class);
        Travel::observe(TravelObserver::class);
    }
}
