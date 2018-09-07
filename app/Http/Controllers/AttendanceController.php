<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Event;
use App\Signup;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AttendanceController extends Controller
{

    public function index()
    {
        $status = config('globals.eventProgress');
        $attendances = Event::with('article')
            ->where('status', $status[2])
            ->orderBy('run_at', 'desc')
            ->get();
        return view('attendances.index', compact('attendances'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //dd($request->all());
        /*
           "_token" => "6QygLtE6fLBI8Ev91tSX5dCQF6ViJWc0mV9SldGP"
           "signup_id" => "6"
           "cut" => "4,250,000"
           "leader_cut" => "100,000"
           "submit" => null
         */
        $validateRequest = [
            'cut'         => 'required|integer|min:0|max:9999999',
            'leader_cut'  => 'nullable|integer|min:0|max:9999999',
        ];
        $this->validate($request, $validateRequest);
        ($request->input('is_leader') == "on")? $leader_cut = $request->input('leader_cut') : $leader_cut = 0;

        $data = Signup::find($request->input('signup_id'));
        $data->attendance = true;
        $data->is_leader = ($request->input('is_leader') == "on")? 1 : 0;

        Attendance::create([
            'user_id' => $data->user_id,
            'character_id' => $data->character_id,
            'event_id' => $data->event_id,
            'signup_id' => $data->id,
            'cut' => $request->input('cut'),
            'leader_cut' => $leader_cut,
            'status' => $request->input('status'),
        ]);
        $data->save();
        Session::flash('flash_message', 'Attendance for Signup ID:  created');
        return redirect()->back();

    }

    public function show(Attendance $attendance)
    {
        return 'hey';
    }

    public function edit(Attendance $attendance)
    {
        //
    }

    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    public function destroy(Attendance $attendance)
    {
        //
    }

    public function displayEventSignups($event)
    {
        $signups = Signup::with(['user', 'character', 'event'])->where('event_id', $event)->where('status', "Accepted")->get();
        $event = Event::find($event);
        $partecipants = $signups->count();
        $pot = $event->pot;
        $cut = (int)round($pot / $partecipants);
        $leader_cut = $event->leader_cut;
        $reference = $event->reference;

        foreach(config('globals.attendanceStatuses') as $key =>$value){
            $data[$key] = $value;
        }
        $data[] = $reference;
        $data[] = $pot;
        $data[] = $leader_cut;
        $data[] = $cut;
        //dd($data);


        //dd($signups);
        return view('signups.show', compact('signups', 'data', 'statuses'));
    }

    public function memberDisplay(){

        $attendances_user = Attendance::getByMember();
        //dd($attendances_user);
        return view('attendances.member', compact('attendances_user'));
    }
}
