<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'title', 'path', 'date', 'travel_id', 'location_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date',
    ];

    protected $dates = [
        'date'
    ];

    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

}
