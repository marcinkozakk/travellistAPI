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
        'total_travel_time' => 0
    ];
}
