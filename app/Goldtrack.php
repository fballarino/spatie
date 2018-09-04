<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goldtrack extends Model
{

    use SoftDeletes;
    protected $fillable = ['booking_id', 'user_id', 'amount','status'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function booking(){
        return $this->belongsTo('App\Booking');
    }

    public function event(){
        return $this->belongsTo('App\Event');
    }

}
