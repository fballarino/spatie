<?php

namespace App\Http\Controllers;

use App\Event;
use App\Signup;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class SignupController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    public function sign(Event $event)
    {
        $check = Signup::select()
                 ->where('event_id', $event->id)
                 ->where('user_id', Auth::user()->id)
                 ->first();

        if($check){
            Session::flash('flash_message', "Already signed up for this event!");
            return redirect()->to('events');
        }

        $characters = User::find(Auth::user()->id)->characters;
        if($characters){
            foreach ($characters as $character){
                $temp[$character->id] = $character->name . '-' .$character->realm .
                                        ' / ' .$character->mainspec . ' ' .$character->class;
            }
        }
        return view('signups.create', compact('event', 'temp'));
        //dd($event);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateRequest = ['character_id'  => 'required|integer'];
        $this->validate($request, $validateRequest);

        $signup = new Signup;
        $signup->character_id = $request->input('character_id');
        $signup->event_id = $request->input('event_id');
        $signup->user_id = Auth::user()->id;
        $signup->status = 'Signed';
        $signup->save();

        $addBoosterEvent = Event::find($request->input('event_id'));
        $addBoosterEvent->boosters_booked += 1;
        $addBoosterEvent->save();

        Cookie::queue('CookieEvent'.$request->input('event_id'), 'event'.$request->input('event_id'));
        //dd($value);

        return redirect()->to('events');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Signup  $signup
     * @return \Illuminate\Http\Response
     */
    public function show(Signup $signup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Signup  $signup
     * @return \Illuminate\Http\Response
     */
    public function edit(Signup $signup)
    {
        dd($signup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Signup  $signup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Signup $signup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Signup  $signup
     * @return \Illuminate\Http\Response
     */
    public function destroy($event)
    {
        //dd($event);
        $signup = Signup::select('id')
                 ->where('event_id', $event)
                 ->where('user_id', Auth::user()->id)
                 ->first();
        if($signup){

            $signup->status = "Cancelled";
            $signup->save();
            $signup->destroy($signup->id);

            $remBoosterEvent = Event::find($event);
            $remBoosterEvent->boosters_booked -= 1;
            $remBoosterEvent->save();

            Session::flash('flash_message', "Successfully canceled the sign-up!");
            Cookie::queue(
                Cookie::forget('CookieEvent'.$remBoosterEvent->id)
            );
            return redirect()->to('events');
        }
        Session::flash('flash_message', "You have no sign-up to cancel!");
        return redirect()->to('events');
    }

    public function status(Request $request, Signup $signup)
    {
        $signup->status = config('globals.eventStatuses')[$request->input('status')];
        $signup->save();

        return redirect()->route('events.show',$signup->event_id);
    }
}
