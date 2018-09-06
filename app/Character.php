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
        return $this->belongsToMany('App\Team')->withTimestamps();
    }
}
