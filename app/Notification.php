<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Notification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'body', 'user_id', 'concerns_user_id', 'travel_id'
    ];

    public function sendPush()
    {
        $user = User::findOrFail($this->concerns_user_id);

        if(is_null($user->device_key)) {
            return false;
        }

        $data = [
            "registration_ids" => $user->device_key,
            "data" => [
                'title' => $this->body,
                'body' => $this->body
            ]
        ];

        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . Config::get('services.fcm.server_key'),
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }
}
