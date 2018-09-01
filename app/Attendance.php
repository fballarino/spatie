<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
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
