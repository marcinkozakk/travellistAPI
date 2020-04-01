<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Travel;
use App\Http\Resources\TravelResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TravelsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['photo_id'] = null;
        $input['user_id'] = Auth::id();

        return $this->sendResponse(
            new TravelResource(Travel::create($input)),
            'Travel saved successfully'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return $this->sendResponse(
            new TravelResource(Travel::findOrFail($id)),
            'Travel data'
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, $id)
    {
        $travel = Travel::findOrFail($id);

        $this->authorize('owner', $travel);

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'photo_id' => 'nullable|integer'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['user_id'] = Auth::id();

        if(
            isset($input['photo_id']) &&
            !Photo::where([
                'id' => $input['photo_id'],
                'travel_id' => $id
            ])->exists()
        ) {
            return $this->sendError('The photo is not associated with this travel');
        }

        $travel->update($input);

        return $this->sendResponse(
            new TravelResource($travel),
            'Travel updated successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function destroy($id)
    {
        $travel = Travel::findOrFail($id);

        $this->authorize('owner', $travel);

        $travel->notes()->delete();
        foreach ($travel->photos as $photo) {
            $photo->delete();
        }
        $travel->delete();

        return $this->sendResponse(
            new TravelResource($travel),
            'Travel deleted successfully'
        );
    }
}
