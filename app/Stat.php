<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $fillable = [
        '*'
    ];

    protected $attributes = [
        'countries_count' => 0,
        'travels_count' => 0,
        'photos_count' => 0,
        'notes_count' => 0,
        'likes_count' => 0,
        'total_travel_time' => 0,
        'total_points' => 0
    ];

    public function getTotalPointsAttribute(): int
    {
        return array_sum([
            $this->countries_count,
            $this->travels_count,
            $this->photos_count,
            $this->notes_count,
            $this->likes_count,
            $this->total_travel_time,
        ]);
    }
}
