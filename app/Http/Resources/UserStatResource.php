<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserStatResource
 * @package App\Http\Resources
 * @mixin \App\User
 */
class UserStatResource extends JsonResource
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
            'user_id' => $this->id,
            'name' => $this->name,
            'username' => $this->name,
            'total_points' => $this->stat->total_points,
            'countries_count' => $this->stat->countries_count,
            'travels_count' => $this->stat->travels_count,
            'photos_count' => $this->stat->photos_count,
            'notes_count' => $this->stat->notes_count,
            'likes_count' => $this->stat->likes_count,
            'total_travel_time' => $this->stat->total_travel_time,
        ];
    }
}
