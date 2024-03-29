<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'following_id', 'follower_id'
    ];


    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

}
