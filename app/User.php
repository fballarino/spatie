<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function characters(){
        return $this->hasMany('App\Character');
    }

    public function events(){
        return $this->hasMany('App\Event');
    }

    public function goldtracks(){
        return $this->hasMany('App\Goldtrack');
    }

    public function attendances(){
        return $this->hasMany('App\Attendance');
    }

    public function bookings(){
        return $this->hasMany('App\Booking');
    }

    public function transactions(){
        return $this->hasMany('App\Transaction');
    }

    public function goldtrackDeposits(){
        return $this->hasMany('App\Transaction','operator_id');
    }

    public function teamsignups(){
        return $this->hasMany('App\TeamSignup')->withTimestamps();
    }


    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
