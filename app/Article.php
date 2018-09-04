<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function pricelists(){
        return $this->hasMany('App\Pricelist');
    }

    public function teams(){
        return $this->hasMany('App\Team');
    }
}
