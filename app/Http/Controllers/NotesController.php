<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoteResource;
use App\Location;
use App\Note;
use App\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotesController extends BaseController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $travel_id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, $travel_id)
    {
        $travel = Travel::findOrFail($travel_id);

        $this->authorize('owner', $travel);

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'note' => 'required|string|max:255',
            'date' => 'required|date',
            'location.lat' => 'nullable|required_with_all:location.lng,location.country|numeric|between:-90,90',
            'location.lng' => 'nullable|required_with_all:location.lat,location.country|numeric|between:-180,180',
            'location.country' => 'nullable|string|max:255',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();

        if($request->has('location.lat')) {
            $location = Location::create($request->input('location'));
            $input['location_id'] = $location->id;
        }

        $input['travel_id'] = $travel_id;

        return $this->sendResponse(
            new NoteResource(Note::create($input)),
            'Note saved successfully'
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
        $note = Note::findOrFail($id);

        $this->authorize('owner', $note->travel);

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'note' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'location.lat' => 'nullable|required_with_all:location.lng,location.country|numeric|between:-90,90',
            'location.lng' => 'nullable|required_with_all:location.lat,location.country|numeric|between:-180,180',
            'location.country' => 'nullable|string|max:255'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();

        if($request->has('location.lat')) {
            $location = Location::findOrNew($note->location_id);
            $location->fill($request->input('location'));
            $location->save();
            $input['location_id'] = $location->id;
        }

        $input['travel_id'] = $note->travel_id;
        $note->update($input);

        return $this->sendResponse(
            new NoteResource($note),
            'Note updated successfully'
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
        $note = Note::findOrFail($id);

        $this->authorize('owner', $note->travel);

        if(!is_null($note->location)) {
            $note->location->delete();
        }

        $note->delete();

        return $this->sendResponse(
            new NoteResource($note),
            "Note deleted successfully"
        );
    }
}
