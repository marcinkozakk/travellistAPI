<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Resources\UserStatResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends BaseController
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return $this->sendResponse(
            new UserResource(User::findOrFail($id)),
            'User data'
        );
    }

    public function search(Request $request)
    {
        return $this->sendResponse(UserResource::collection(
            User::where('username', 'like', $request->username . '%')
                ->take(8)
                ->get()
        ), 'List of found users');
    }

    public function stats($target)
    {
        if($target === 'me') {
            $stats = new UserStatResource(Auth::user());
        } else {
            $stats = UserStatResource::collection(
                Auth::user()
                    ->following
                    ->load('stat')
                    ->collect()
                    ->add(Auth::user()->load('stat'))
                    ->sortByDesc('stat.totalPoints')
            );
        }

        return $this->sendResponse($stats, 'User statistics');
    }

    public function countries($user_id)
    {
        $user = User::findOrFail($user_id);

        return $this->sendResponse($user->getUniqueCountries()->values(), 'Unique countries');
    }
}
