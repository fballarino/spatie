<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    public function banks()
    {
        return $this->belongsTo('App\Bank');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
