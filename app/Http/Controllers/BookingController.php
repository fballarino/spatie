<?php

namespace App\Http\Controllers;

use App\Booking;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Event;

class BookingController extends Controller
{

    protected $classSpec = [
        'Death Knight' => ['Select..','Blood','Frost','Unholy'],
        'Demon Hunter' => ['Select..','Havoc','Vengeance'],
        'Druid' => ['Select..','Balance','Feral','Guardian', 'Restoration'],
        'Hunter' => ['Select..','Beast Mastery','Marskmanship','Survival'],
        'Mage' => ['Select..','Arcane','Fire','Frost'],
        'Monk' => ['Select..','Brewmaster','Mistweaver','Windwalker'],
        'Paladin' => ['Select..','Holy','Protection','Retribution'],
        'Priest' => ['Select..','Discipline','Holy','Shadow'],
        'Rogue' => ['Select..','Assassination','Outlaw','Subtlety'],
        'Shaman' => ['Select..','Elemental','Enhancement','Restoration'],
        'Warlock' => ['','Affliction','Demonology','Destruction'],
        'Warrior' => ['Select..','Arms','Fury','Protection'],
    ];

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {

    }

    public function create(Request $request)
    {
        $requestArray['id'] = $request->query('id');
        $requestArray['ref'] = $request->query('ref');
        $classSpec = $this->classSpec;
        return view('bookings/create',compact('requestArray','classSpec'));
    }

    public function store(Request $request)
    {
        //Validating title and body field
        if ($request->input('buyer_btag') != ""){
            $validateRequest['buyer_btag'] = 'required|string|max:30';
        }
        if ($request->input('fee') != ""){
            $validateRequest['fee'] = 'integer';
        }
        $validateRequest = [
            'buyer_name'  => 'required|string|max:20',
            'buyer_realm' => 'required|string|max:30',
            'price'       => 'required|integer',
            ];
        $this->validate($request, $validateRequest);

        $newBooking = new Booking;
        $newBooking->buyer_name  = $request->input('buyer_name');
        $newBooking->buyer_realm = $request->input('buyer_realm');
        $newBooking->buyer_btag = $request->input('buyer_btag');
        $newBooking->class = $request->input('class');
        if (($request->input('buyer_spec')!= null)){
            $newBooking->buyer_spec = $request->input('buyer_spec');
        }
        $newBooking->buyer_boosters = $request->input('buyer_boosters');
        $newBooking->user_id = Auth::user()->id;
        $newBooking->price = $request->input('price');
        $newBooking->fee = $request->input('fee');
        $newBooking->note = $request->input('note');
        $newBooking->event_id = $request->input('event_id');
        $newBooking->save();

        $currentEvent = Event::find($request->input('event_id'));
        $currentEvent->pot += $request->input('price');
        $currentEvent->buyers_booked += 1;
        $currentEvent->save();
        return redirect()->back();
    }

    public function show($id)
    {
        $eventName = Event::findOrfail($id)->reference;
        $advertiser = "temp";
        $bookingsEventId = Booking::where('event_id', $id)->orderBy('created_at', 'ASC')->get();
        return view('bookings.show', compact('bookingsEventId', 'advertiser', 'eventName'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $currentBooking = Booking::findOrFail($id);
        Booking::destroy($id);
        $currentEvent = Event::findOrFail(request()->input('event_id'));
        $currentEvent->pot -= $currentBooking->price;
        $currentEvent->buyers_booked -= 1;
        $currentEvent->save();
        //Display a successful message upon deletion
        return redirect()->back()->with('flash_message', 'Booking of:
                                        '.$currentBooking->buyer_name.'-'.$currentBooking->buyer_realm.
                                        ' successfully deleted');
    }
}
