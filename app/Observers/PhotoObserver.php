<?php

namespace App\Observers;

use App\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PhotoObserver
{
    /**
     * Handle the photo "created" event.
     *
     * @return void
     */
    public function created()
    {
        Auth::user()->updatePhotosCountStat();
    }


    /**
     * Handle the photo "deleted" event.
     *
     * @param  \App\Photo  $photo
     * @return void
     */
    public function deleted(Photo $photo)
    {
        Storage::delete($photo->path);
        Auth::user()->updatePhotosCountStat();
    }
}
