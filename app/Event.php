<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    public function signups(){
        return $this->hasMany('App\Signup');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function article(){
        return $this->belongsTo('App\Article');
    }

    public function faction(){
        return $this->belongsTo('App\Faction');
    }

    public function bookings(){
        return $this->hasMany('App\Booking');
    }
}
