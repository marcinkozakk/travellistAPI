<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class Travel
 * @package App\Http\Resources
 * @mixin \App\Travel
 */
class TravelResource extends JsonResource
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
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
            'main_photo' => $this->mainPhoto,//new PhotoResource($this->mainPhoto),
            'photos&notes' => PhotosAndNotesResource::collection($this->photos_and_notes)
        ];
    }
}
