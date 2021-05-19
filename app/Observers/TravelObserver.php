<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;

class TravelObserver
{
    /**
     * Handle the travel "created" event.
     *
     * @return void
     */
    public function created()
    {
        Auth::user()->updateTravelsCountStat();
        Auth::user()->updateTotalTravelTimeStat();
    }

    /**
     * Handle the travel "updated" event.
     *
     * @return void
     */
    public function updated()
    {
        Auth::user()->updateTotalTravelTimeStat();
    }

    /**
     * Handle the travel "deleted" event.
     *
     * @return void
     */
    public function deleted()
    {
        Auth::user()->updateTotalTravelTimeStat();
        Auth::user()->updateCountriesCountStat();
        Auth::user()->updateTravelsCountStat();
        Auth::user()->updateLikesCountStat();
        Auth::user()->updateNotesCountStat();
        Auth::user()->updatePhotosCountStat();
    }

}
