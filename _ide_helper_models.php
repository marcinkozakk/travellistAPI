<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Note
 *
 * @property int $id
 * @property string|null $title
 * @property string $note
 * @property \Illuminate\Support\Carbon $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $travel_id
 * @property-read \App\Travel $travel
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereTravelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereUpdatedAt($value)
 */
	class Note extends \Eloquent {}
}

namespace App{
/**
 * App\Travel
 *
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property int|null $photo_id
 * @property-read mixed $photos_and_notes
 * @property-read \App\Photo $mainPhoto
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Note[] $notes
 * @property-read int|null $notes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Photo[] $photos
 * @property-read int|null $photos_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Travel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Travel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Travel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Travel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Travel whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Travel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Travel wherePhotoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Travel whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Travel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Travel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Travel whereUserId($value)
 */
	class Travel extends \Eloquent {}
}

namespace App{
/**
 * App\Follow
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $following_id
 * @property int $follower_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow whereFollowerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow whereFollowingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow whereUpdatedAt($value)
 */
	class Follow extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $followers
 * @property-read int|null $followers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $following
 * @property-read int|null $following_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUsername($value)
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\Photo
 *
 * @property int $id
 * @property string|null $path
 * @property string|null $title
 * @property \Illuminate\Support\Carbon $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $travel_id
 * @property-read \App\Travel $travel
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo whereTravelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Photo whereUpdatedAt($value)
 */
	class Photo extends \Eloquent {}
}

