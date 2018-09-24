<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function attendance(){
        return $this->belongsTo('App\Attendance');
    }

}
