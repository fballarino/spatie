<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Event;
use App\Signup;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = config('globals.eventProgress');
        $attendances = Event::where('status', $status[2])->orderBy('run_at', 'desc')->get();
        return view('attendances.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        /*
           "event_id" => "1"
           "character_id" => "6"
           "user_id" => "1"
           "signup_id" => null
           "status" => "1"
         */
        $attendance = Attendance::where([
            ['user_id', '=', $request->input('user_id')],
            ['character_id', '=', $request->input('user_id')],
            ['event_id', '=', $request->input('event_id')],
            ['signup_id', '=', $request->input('signup_id')],
        ])->first();
        //dd($attendance);
        if(!$attendance){
            $attendance = new Attendance;
            $attendance->user_id = $request->input('user_id');
            $attendance->character_id = $request->input('character_id');
            $attendance->event_id = $request->input('event_id');
            $attendance->signup_id = $request->input('signup_id');
            $attendance->status = $request->input('status');
            $attendance->save();
        };
        //return redirect()-back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        return 'hey';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }

    public function displayEventSignups($event)
    {
        $signups = Signup::with(['user', 'character', 'event'])->where('event_id', $event)->get();
        $event = Event::find($event);
        $pot = $event->pot;
        $leader_cut = $event->leader_cut;
        $reference = $event->reference;
        $data = [$reference, $pot, $leader_cut];
        //dd($signups);
        return view('signups.show', compact('signups', 'data'));
    }
}
