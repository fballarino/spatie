<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Attendance extends Model
{

    protected $fillable = ['user_id', 'character_id', 'event_id', 'signup_id', 'cut', 'leader_cut', 'status'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function booking(){
        return $this->belongsTo('App\Booking');
    }

    public function event(){
        return $this->belongsTo('App\Event');
    }

    public function signup(){
        return $this->belongsTo('App\Signup');
    }

    public static function getByMember(){

        return DB::table('attendances as A')
            ->select('A.cut', 'A.leader_cut', 'E.reference', 'E.run_at', 'AR.description',
                'E.pot', 'C.name', 'C.realm' )
            ->where('A.user_id', '=', Auth::user()->id)
            ->join('events as E', 'E.id', '=', 'A.event_id')
            ->join('characters as C', 'C.id', '=', 'A.character_id')
            ->join('articles as AR', 'AR.id', '=', 'E.article_id')
            ->orderBy('E.run_at', 'desc')
            ->get();
    }

    public static function attendanceById($id){

        return DB::table('attendances as A')
            ->select('A.cut', 'A.leader_cut', 'E.reference', 'E.run_at', 'AR.description',
                'E.pot', 'C.name', 'C.realm' )
            ->where('A.user_id', '=', $id)
            ->join('events as E', 'E.id', '=', 'A.event_id')
            ->join('characters as C', 'C.id', '=', 'A.character_id')
            ->join('articles as AR', 'AR.id', '=', 'E.article_id')
            ->orderBy('E.run_at', 'desc')
            ->get();
    }
}
