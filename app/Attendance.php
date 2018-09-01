<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{

    protected $fillable = ['user_id', 'character_id', 'event_id', 'signup_id', 'cut', 'leader_cut', 'status'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function booking(){
        return $this->belongsTo('App\Booking');
    }

    public function event(){
        return $this->belongsTo('App\Event');
    }

    public function signup(){
        return $this->belongsTo('App\Signup');
    }
}
