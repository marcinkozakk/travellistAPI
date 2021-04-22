<?php

namespace App\Http\Controllers;

use App\Http\Resources\PhotoResource;
use App\Location;
use App\Photo;
use App\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PhotosController extends BaseController
{
    private $storePath = 'public/photos';

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, $travel_id)
    {
        $travel = Travel::findOrFail($travel_id);

        $this->authorize('owner', $travel);

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'date' => 'required|date',
            'photo' => 'required|image',
            'location.lat' => 'required_with_all:location.lng,location.country|numeric|between:-90,90',
            'location.lng' => 'required_with_all:location.lat,location.country|numeric|between:-180,180',
            'location.country' => 'nullable|string|max:255'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();

        if($request->has('location.lat')) {
            $location = Location::create($request->input('location'));
            $input['location_id'] = $location->id;
        }

        $input['path'] = $request->file('photo')->store($this->storePath);
        $input['travel_id'] = $travel_id;

        return $this->sendResponse(
            new PhotoResource(Photo::create($input)),
            'Photo saved successfully'
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
        $photo = Photo::findOrFail($id);

        $this->authorize('owner', $photo->travel);

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'photo' => 'nullable|image',
            'location.lat' => 'nullable|required_with_all:location.lng,location.country|numeric|between:-90,90',
            'location.lng' => 'nullable|required_with_all:location.lat,location.country|numeric|between:-180,180',
            'location.country' => 'nullable|string|max:255'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();

        if($request->has('location.lat')) {
            $location = Location::findOrNew($photo->location_id);
            $location->fill($request->input('location'));
            $location->save();
            $input['location_id'] = $location->id;
        }

        if($request->has('photo')) {
            Storage::delete($photo->path);
            $input['path'] = $request->file('photo')->store($this->storePath);
        } else {
            $input['path'] = $photo->path;
        }

        $input['travel_id'] = $photo->travel->id;
        $photo->update($input);

        return $this->sendResponse(
            new PhotoResource($photo),
            'Photo updated successfully'
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
        $photo = Photo::findOrFail($id);

        $this->authorize('owner', $photo->travel);

        if($photo->travel->photo_id == $id) {
            $photo->travel->photo_id = null;
            $photo->travel->save();
        }

        if(!is_null($photo->location)) {
            $photo->location->delete();
        }

        $photo->delete();

        return $this->sendResponse(
            new PhotoResource($photo),
            "Photo deleted successfully"
        );

    }
}
