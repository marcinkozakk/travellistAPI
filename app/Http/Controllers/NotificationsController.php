<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NotificationsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->sendResponse(
            NotificationResource::collection(Auth::user()->notifications),
            'User notifications'
        );
    }

    public function registerDevice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'device_key' => 'required|string|max:255'
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $user = Auth::user();
        $user->update([
            'device_key' => $request->device_key
        ]);

        return $this->sendResponse(
            new UserResource($user),
            'User device registered successfully' . $request->device_key
        );
    }

}
