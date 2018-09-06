<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamSignup extends Model
{
    public function parts(){
        return $this->belongsTo('App\Part');
    }

    public function characters(){
        return $this->belongsTo('App\Part');
    }

    public function users(){
        return $this->belongsTo('App\Part');
    }

    public function teams(){
        return $this->belongsTo('App\Part');
    }
}
