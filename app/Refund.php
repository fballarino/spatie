<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    public function booking() {
        return $this->belongsTo('App\Booking');
    }

    public function goldtrack() {
        return $this->belongsTo('App\Goldtrack');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
