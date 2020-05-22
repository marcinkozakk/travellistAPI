<?php

namespace App\Observers;

use App\Follow;
use App\Notification;

class FollowObserver
{
    /**
     * Handle the follow "created" event.
     *
     * @param  \App\Follow  $follow
     * @return void
     */
    public function created(Follow $follow)
    {
        Notification::create([
            'body' => $follow->follower->username . ' follows you',
            'user_id' => $follow->follower_id,
            'concerns_user_id' => $follow->following_id
        ]);
    }

    /**
     * Handle the follow "deleted" event.
     *
     * @param \App\Follow $follow
     * @return void
     * @throws \Exception
     */
    public function deleted(Follow $follow)
    {
        $notification = Notification::where([
            'user_id' => $follow->follower_id,
            'concerns_user_id' => $follow->following_id
        ])->first();

        if(!is_null($notification)) {
            $notification->delete();
        }
    }
}
