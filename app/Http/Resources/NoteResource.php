<?php

namespace App\Http\Resources;

use App\Note;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class NoteResource
 * @package App\Http\Resources
 * @mixin Note
 */
class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'note' => $this->note,
            'date' => $this->date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'travel_id' => $this->travel_id
        ];
    }
}
