<?php

namespace App\Policies;

use App\Travel;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TravelPolicy
{
    use HandlesAuthorization;

    public function owner(User $user, Travel $travel)
    {
        return $user->id === $travel->user_id;
    }
}
