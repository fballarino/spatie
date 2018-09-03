<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    public function bank()
    {
        return $this->belongsTo('App\Bank');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function recipient()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function sender()
    {
        return $this->belongsTo('App\User','operator_id');
    }
}
