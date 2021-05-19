<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;

class LocationObserver
{
    /**
     * Handle the location "created" event.
     *
     * @return void
     */
    public function created()
    {
        Auth::user()->updateCountriesCountStat();
    }
    /**
     * Handle the location "updated" event.
     *
     * @return void
     */
    public function updated()
    {
        Auth::user()->updateCountriesCountStat();
    }
    /**
     * Handle the location "deleted" event.
     *
     * @return void
     */
    public function deleted()
    {
        Auth::user()->updateCountriesCountStat();
    }

}
