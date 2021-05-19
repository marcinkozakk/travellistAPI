<?php

namespace App\Observers;

use App\Like;
use App\Notification;
use App\User;

class LikeObserver
{
    /**
     * Handle the like "created" event.
     *
     * @param  \App\Like  $like
     * @return void
     */
    public function created(Like $like)
    {
        User::find($like->travel->user_id)->updateLikesCountStat();

        Notification::create([
            'body' => $like->user->username . ' liked your travel ' . $like->travel->title,
            'user_id' => $like->user_id,
            'travel_id' => $like->travel_id,
            'concerns_user_id' => $like->travel->user_id
        ]);

    }

    /**
     * Handle the like "deleted" event.
     *
     * @param \App\Like $like
     * @return void
     * @throws \Exception
     */
    public function deleted(Like $like)
    {
        User::find($like->travel->user_id)->updateLikesCountStat();

        $notification = Notification::where([
            'user_id' => $like->user_id,
            'concerns_user_id' => $like->travel->user_id,
            'travel_id' => $like->travel_id
        ])->first();

        if(!is_null($notification)) {
            $notification->delete();
        }
    }
}
