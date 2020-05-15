<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'title', 'start_date', 'end_date', 'user_id', 'photo_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    protected $dates = [
        'start_date', 'end_date'
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function mainPhoto()
    {
        return $this->hasOne(Photo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPhotosAndNotesAttribute()
    {
        $photos = collect($this->photos);
        $notes = collect($this->notes);

        return $photos->merge($notes)->sortBy('date');
    }
}
