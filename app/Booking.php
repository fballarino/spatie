<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    public function goldtracks(){
        return $this->hasMany('App\Goldtrack');
    }

    public function event(){
        return $this->belongsTo('App\Event');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function realm(){
        return $this->belongsTo('App\Realm');
    }
}
