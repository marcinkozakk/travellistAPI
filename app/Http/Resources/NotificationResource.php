<?php

namespace App\Http\Resources;

use App\Notification;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class NotificationResource
 * @package App\Http\Resources
 * @mixin Notification
 */
class NotificationResource extends JsonResource
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
            'body' => $this->body,
            'user_id' => $this->user_id,
            'travel_id' => $this->travel_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
