<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Character;
use App\Signup;
use App\Transaction;
use App\Booking;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        //fetches the characters owned by user
        $characters = Character::select(['name','realm','class','gear'])
            ->where('user_id', Auth::user()->id)
            ->orderBy('name','asc')
            ->get();

        $signups = Signup::join('events','signups.event_id','events.id')
            ->where('signups.user_id', Auth::user()->id)
            ->orderBy('events.run_at','asc')
            ->with(['event'])
            ->limit(5)
            ->get();

        $attendances = Attendance::with(['event'])
            ->where('user_id', Auth::user()->id)
            ->limit(5)
            ->get();

        $payments = Transaction::select('amount')
            ->where('user_id', Auth::user()->id)
            ->get();

        $fees = Booking::select('fee')
            ->where('user_id', Auth::user()->id)
            ->sum('fee');

        $characters_array = Character::with('teams')
            ->where('user_id', Auth::user()->id)
            ->get();

        $earned = ($attendances->sum('cut')+$attendances->sum('leader_cut'));
        $paid = abs($payments->sum('amount'));
        $balance = $earned-$paid;

        /*
        foreach($characters_array as $single_character){
            foreach($single_character->teams as $team){
                echo $single_character->name . $team->name;
            };
        }*/

        return view('dashboard.indexnew', compact('characters', 'signups',
           'attendances', 'balance', 'fees', 'characters_array'));


    }
}
