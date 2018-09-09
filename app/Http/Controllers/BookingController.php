<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Goldtrack;
use App\Realm;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Event;
use Carbon\Carbon;

class BookingController extends Controller
{

    protected $classSpec = [];

    public function __construct()
    {
        $this->middleware(['auth']);
        $this->populateClassSpec();
    }

    public function index()
    {
        //return $this->testRelation();
    }

    public function create(Request $request)
    {
        $requestArray['id'] = $request->query('id');
        $requestArray['ref'] = $request->query('ref');
        $realms = Realm::all();
        $realms2 = Realm::all();
        $classSpec = $this->classSpec;
        return view('bookings/create',compact('requestArray','classSpec', 'realms', 'realms2'));
    }

    public function store(Request $request)
    {
        //Validating title and body field
        //dd($request->input());
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
            'fpaid'       => 'required|integer',
            'realm_id'    => 'required|integer',
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
        $newBooking->fpaid = (int)$request->input('fpaid');
        $newBooking->realm_id = $request->input('realm_id');
        if((int)$request->input('fpaid')){
            $newBooking->collector_id =  Auth::user()->id;

        }

        $newBooking->note = $request->input('note');
        $newBooking->event_id = $request->input('event_id');
        $newBooking->status = "Booked";
        $newBooking->save();

        if((int)$request->input('fpaid')){
            $goldtrack = new Goldtrack;
            $goldtrack->booking_id = $newBooking->id;
            $goldtrack->event_id = $request->input('event_id');
            $goldtrack->user_id = Auth::user()->id;
            $goldtrack->amount = ($request->input('price')-$request->input('fee'));
            $goldtrack->code = 1;
            $goldtrack->save();
        }

        $currentEvent = Event::find($request->input('event_id'));
        $currentEvent->pot += $request->input('price');
        $currentEvent->buyers_booked += 1;
        $currentEvent->save();
        return redirect()->to('events');
    }

    public function show($id)
    {
        $eventName = Event::findOrfail($id)->reference;
        $bookingsEventId = Booking::where('event_id', $id)->orderBy('created_at', 'ASC')->get();
        //dd($bookingsEventId);
        foreach($bookingsEventId as $bookingEvent){
            $bookingEvent['advertiser'] = User::findOrfail($bookingEvent['user_id'])->name;
            if($bookingEvent['collector_id']){
            $bookingEvent['collector'] = User::findOrfail($bookingEvent['collector_id'])->name;
            }
        }

        return view('bookings.show', compact('bookingsEventId', 'eventName'));
    }

    public function edit($id)
    {
        $classSpec = $this->classSpec;
        $booking = Booking::findOrFail($id);
        $event = Event::find($booking->event_id);
        $realms = Realm::pluck('realm', 'id');
        $events = Event::where('run_at', '>=', Carbon::now())
            ->where('faction_id', '=', $event->faction_id)
            ->pluck('reference', 'id');
        return view('bookings.edit', compact('booking','classSpec', 'realms', 'events'));
    }

    public function update(Request $request, $id)
    {
        //dd($request->input());
        if ($request->input('buyer_btag') != ""){
            $validateRequest['buyer_btag'] = 'required|string|max:30';
        }
        if ($request->input('fee') != ""){
            $validateRequest['fee'] = 'integer';
        }
        $validateRequest = [
            'buyer_name'  => 'required|string|min:3|max:20',
            'buyer_realm' => 'required|string|max:30',
            'price'       => 'required|integer',
            'fpaid'       => 'required|integer',
            'realm_id'    => 'required|integer',
        ];
        $this->validate($request, $validateRequest);

        $booking = Booking::findOrFail($id);
        //dd($booking);
        $oldPrice = $booking->price;
        $booking->buyer_name  = $request->input('buyer_name');
        $booking->buyer_realm = $request->input('buyer_realm');
        $booking->buyer_btag = $request->input('buyer_btag');
        $booking->class = $request->input('class');
        if (($request->input('buyer_spec')!= null)){
            $booking->buyer_spec = $request->input('buyer_spec');
        }
        $booking->buyer_boosters = $request->input('buyer_boosters');
        $booking->price = $request->input('price');
        $booking->fee = $request->input('fee');
        $booking->realm_id = $request->input('realm_id');
        $booking->status = $request->input('status');


        if(($booking->fpaid == 0) && ($request->input('fpaid') == 1)) {
            $booking->fpaid = $request->input('fpaid');
            $goldtrack = Goldtrack::where('booking_id', $id)->first();
            //dd($goldtrack);
            if($goldtrack == null){
                $goldtrack = new Goldtrack;
                $goldtrack->booking_id = $id;
                $goldtrack->event_id = $request->input('event_id');
                $goldtrack->user_id = Auth::user()->id;
                $goldtrack->amount = ($request->input('price')-$request->input('fee'));
                $goldtrack->code = 1;
                $goldtrack->save();
            }
        }

        $booking->note = $request->input('note');
        ($booking->fpaid)? $booking->collector_id = Auth::user()->id : $booking->collector_id = null;



        if($request->input('event_id') != $booking->event_id){
            $currentEvent = Event::find($booking->event_id);
            $currentEvent->pot = $currentEvent->pot - $oldPrice;
            $currentEvent->buyers_booked -= 1;
            $currentEvent->save();
            $nextEvent = Event::findOrFail($request->input('event_id'));
            $nextEvent->pot += ($request->input('price'));
            $nextEvent->buyers_booked += 1;
            $nextEvent->save();
        }
        else {
            $currentEvent = Event::find($booking->event_id);
            $currentEvent->pot = $currentEvent->pot - $oldPrice + $request->input('price');
            $currentEvent->save();
        }

        $booking->event_id = $request->input('event_id');
        $booking->save();

        return redirect()->to(route('bookings.show', $booking->event_id));

    }

    public function destroy($id)
    {
        $currentBooking = Booking::findOrFail($id);
        //dd(request()->input('event_id'));
        Booking::destroy($id);
        Goldtrack::where('booking_id',$id)->delete();
        $currentEvent = Event::findOrFail(request()->input('event_id'));
        $currentEvent->pot -= $currentBooking->price;
        $currentEvent->buyers_booked -= 1;
        $currentEvent->save();
        return redirect()->route('events.index')->with('flash_message', 'Booking of:
                                        '.$currentBooking->buyer_name.'-'.$currentBooking->buyer_realm.
                                        ' successfully deleted');
    }

    public function changeStatus()
    {
        $data = request()->input('status');
        foreach($data as $key => $value){
            $ids[] = $key;
            $values[] = $value;
        }
        dd($ids);
        //dd(request()->input('status'));

        $bookingStatus = Booking::findOrFail(1);
        if($bookingStatus){
            $bookingStatus->status = request()->input('status');
            $bookingStatus->save();
            $event = $bookingStatus->event_id;
        }
        //return redirect(route('bookings.show', $event));
    }

    private function populateClassSpec(){
        $this->classSpec = config('globals.classSpec');
    }

    public function testRelation(){

        $result = Booking::first();
        $stuff = Booking::first()->event->article;
        dd($stuff);
    }
}
