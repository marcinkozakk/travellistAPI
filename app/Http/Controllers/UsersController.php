<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\User;

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
}
