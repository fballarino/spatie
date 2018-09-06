<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    public function teamsignups(){
        return $this->hasMany('App\TeamSignup');
    }
}
