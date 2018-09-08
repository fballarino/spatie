<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Character extends Model
{
    use SoftDeletes;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function teams(){
        return $this->belongsToMany('App\Team')->withTimestamps()->withPivot('part','user_id');
    }

    public function signups(){
        return $this->hasMany('App\Signup');
    }
}
