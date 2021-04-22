<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Resources\MeResource;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends BaseController
{
    public function redirect() {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        try {
            $socialMediaUser = Socialite::driver('facebook')->user();
        } catch (InvalidStateException $e) {
            $socialMediaUser = Socialite::driver('facebook')->stateless()->user();
        }

        $user = $this->findOrCreateUser($socialMediaUser);
        Auth::guard()->login($user);

        $user = Auth::user();
        $token = $user->createToken('Travellist')->accessToken;

        return $this->sendResponse(
            (new MeResource($user))->additional(['token' => $token]),
            'User login successfully.');

    }

    public function findOrCreateUser($socialMediaUser)
    {
        $user = User::where('facebook_id', $socialMediaUser->getId())->first();
        if(!is_null($user)) {
            return $user;
        }

        $user = User::where('email', $socialMediaUser->getEmail())->first();
        if(!is_null($user)) {
            if($user->facebook_id !== $socialMediaUser->getId()) {
                $user->facebook_id = $socialMediaUser->getId();
                $user->save();
            }
            return $user;
        }

        $user = User::forceCreate([
            'name' => $socialMediaUser->getName(),
            'username' => $socialMediaUser->getName(),
            'email' => $socialMediaUser->getEmail(),
            'email_verified_at' => now(),
            'password' => '',
            'facebook_id' => $socialMediaUser->getId(),
        ]);

        return $user;
    }


}
