<?php

namespace App\Http\Resources;

use App\Photo;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

/**
 * Class PhotoResource
 * @package App\Http\Resources
 * @mixin Photo
 */
class PhotoResource extends JsonResource
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
            'path' => Config::get('app.url') . Storage::url($this->path),
            'title' => $this->title,
            'date' => $this->date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'travel_id' => $this->travel_id,
            'location' => !is_null($this->location_id) ?
                new LocationResource($this->location) :
                null
        ];
    }
}
