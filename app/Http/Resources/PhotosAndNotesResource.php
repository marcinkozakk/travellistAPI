<?php

namespace App\Http\Resources;

use App\Note;
use App\Photo;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

/**
 * Class PhotosAndNotesResource
 * @package App\Http\Resources
 * @mixin Photo
 * @mixin Note
 */
class PhotosAndNotesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     * @mi
     */
    public function toArray($request)
    {
        $type = Str::singular($this->getTable());

        return [
            'type' => $type,
            'data' => $type === 'note' ?
                new NoteResource($this) :
                new PhotoResource($this)
        ];
    }
}
