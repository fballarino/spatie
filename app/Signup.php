<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Signup extends Model
{
    use SoftDeletes;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function character(){
        return $this->belongsTo('App\Character');
    }

    public function event(){
        return $this->belongsTo('App\Event')->orderBy('run_at','asc');
    }

    public static function getSignupsUser(){
        return DB::table('signups as S')
            ->select('A.description', 'E.run_at', 'C.name', 'C.realm', 'S.created_at')
            ->join('events as E', 'E.id','=','S.event_id')
            ->join('characters as C', 'C.id','=','S.character_id')
            ->join('articles as A', 'A.id','=','E.article_id')
            ->where('S.user_id','=', Auth::user()->id)
            ->get();
    }
}
