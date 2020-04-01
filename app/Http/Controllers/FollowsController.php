<?php

namespace App\Http\Controllers;

use App\Follow;
use App\Http\Resources\FollowResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FollowsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->sendResponse(
            [
                'followers' => UserResource::collection(Auth::user()->followers),
                'following' => UserResource::collection(Auth::user()->following)
            ]
        );
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'following_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $follow = Follow::firstOrCreate([
            'following_id' => $request->following_id,
            'follower_id' => Auth::id()
        ]);

        return $this->sendResponse(
            new FollowResource($follow),
            $follow->wasRecentlyCreated ? 'Follow saved successfully' : 'Follow already exist'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}