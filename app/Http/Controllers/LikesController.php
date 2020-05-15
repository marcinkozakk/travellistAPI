<?php

namespace App\Http\Controllers;

use App\Like;
use App\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LikesController extends BaseController
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'travel_id' => 'required',
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $like = Like::firstOrCreate([
            'travel_id' => $request->travel_id,
            'user_id' => Auth::id()
        ]);

        return $this->sendResponse(
            'success',
            $like->wasRecentlyCreated ? 'Travel Liked  successfully' : 'Like already exist'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $like = Like::where(['user_id' => Auth::id(), 'travel_id' => $id])->first();

        if(is_null($like)) {
            return $this->sendError('Like doesn\'t exist!');
        }

        $like->delete();

        return $this->sendResponse(
            'success',
            "Travel unliked successfully"
        );

    }
}
