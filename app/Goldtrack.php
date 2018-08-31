<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goldtrack extends Model
{

    use SoftDeletes;
    protected $fillable = ['booking_id', 'user_id', 'amount','status'];
}
