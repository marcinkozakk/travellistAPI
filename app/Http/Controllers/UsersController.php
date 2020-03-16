<?php

namespace App\Http\Controllers;

use App\Http\Resources\User as UserResource;
use App\User;

class UsersController extends BaseController
{
    public function show($id)
    {
        return $this->sendResponse(
            new UserResource(User::findOrFail($id)),
            'User data'
        );
    }
}
