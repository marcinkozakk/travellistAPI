<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'device_key'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows','following_id', 'follower_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
    }

    public function travels()
    {
        return $this->hasMany(Travel::class)->orderByDesc('created_at');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'concerns_user_id')->orderBy('created_at', 'desc');
    }

    public function stat()
    {
        return $this->hasOne(Stat::class)->withDefault();
    }

    public function notes()
    {
        return $this->hasManyThrough(Note::class, Travel::class);
    }

    public function photos()
    {
        return $this->hasManyThrough(Photo::class, Travel::class);
    }

    public function likes()
    {
        return $this->hasManyThrough(Like::class, Travel::class);
    }

    public function updateCountriesCountStat()
    {
        $notesCountries = $this->notes->load('location')->pluck('location.country')->unique();
        $photosCountries = $this->photos->load('location')->pluck('location.country')->unique();

        $this->stat->countries_count = $notesCountries->union($photosCountries)->count();
        $this->stat->save();
    }

    public function updateTravelsCountStat()
    {
        $this->stat->travels_count = $this->travels->count();
        $this->stat->save();
    }

    public function updatePhotosCountStat()
    {
        $this->stat->photos_count = $this->photos->count();
        $this->stat->save();
    }

    public function updateNotesCountStat()
    {
        $this->stat->notes_count = $this->notes->count();
        $this->stat->save();
    }

    public function updateLikesCountStat()
    {
        $this->stat->likes_count = $this->likes->count();
        $this->stat->save();
    }

    public function updateTotalTravelTimeStat()
    {
        $days = $this->travels->map(function (Travel $travel) {
            return $travel->start_date->diffInDays($travel->end_date);
        })->sum();

        $this->stat->total_travel_time = $days;
        $this->stat->save();
    }
}
