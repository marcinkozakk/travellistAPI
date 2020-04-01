<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoteResource;
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
            'date' => 'required|date'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
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
            'date' => 'nullable|date'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
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

        $note->delete();

        return $this->sendResponse(
            new NoteResource($note),
            "Note deleted successfully"
        );
    }
}
