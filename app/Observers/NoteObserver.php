<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;

class NoteObserver
{
    /**
     * Handle the note "created" event.
     *
     * @return void
     */
    public function created()
    {
        Auth::user()->updateNotesCountStat();
    }


    /**
     * Handle the note "deleted" event.
     *
     * @return void
     */
    public function deleted()
    {
        Auth::user()->updateNotesCountStat();
    }

}
