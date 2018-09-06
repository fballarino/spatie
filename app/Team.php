<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes;

    public function article(){
        return $this->belongsTo('App\Article');
    }

    public function characters(){
        return $this->belongsToMany('App\Character')->withTimestamps()->withPivot('part');
    }
}
