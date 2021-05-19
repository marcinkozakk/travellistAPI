<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
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

    public function stats($id)
    {
        if($id === 'me') {
            $stats = Auth::user()->stat;
        } else {
            $stats = User::findOrFail($id)->stat;
        }

        return $this->sendResponse($stats, 'User statistics');
    }
}
