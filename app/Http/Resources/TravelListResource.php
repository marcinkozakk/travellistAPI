<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

/**
 * Class Travel
 * @package App\Http\Resources
 * @mixin \App\Travel
 */
class TravelListResource extends JsonResource
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
            'user_id' => $this->user_id,
            'username' => $this->user->username,
            'main_photo' => !is_null($this->photo_id) ? Config::get('app.url') . Storage::url($this->mainPhoto->path) : null,
            'likes_count' => $this->likes()->count(),
            'is_liked' => $this->likes()->where(['user_id' => \Auth::id()])->exists()
        ];
    }
}
