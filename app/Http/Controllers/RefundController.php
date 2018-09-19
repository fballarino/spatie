<?php

namespace App\Http\Controllers;

use App\Event;
use App\Goldtrack;
use App\Refund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefundController extends Controller
{

    public function index()
    {
        $refunds = Refund::all();
        $reasons = array_values(config('globals.refund_reasons'));
        return view('refunds.index', compact('refunds', 'reasons'));
    }

    public function create(Request $request)
    {
        dd($request->input());
    }

    public function store(Request $request)
    {
        //dd($request->input());
        $this->validate($request, [
            'full_refund' => 'required|integer',
            'amount'      => 'nullable|integer',
            'reason_id'   => 'required|integer',
            'note'        => 'nullable|string|max:255'
        ]);

        $goldtrack = Goldtrack::find($request->input('goldtrack_id'));

        if($request->input('full_refund')){
            try {
                $goldtrack->delete();
                $message = 'Refund successfully created, goldtrack deleted';
                $amount = $goldtrack->amount;
            }
            catch(\Exception $e) {
                $message = 'Could not perform the operations requested';
            }
        }
        else {
            try {
                $goldtrack->amount -= $request->input('amount');
                $amount = $request->input('amount');
                $goldtrack->save();
                $message = 'Refund successfully created, Goldtrack updated';
            }
            catch(\Exception $e) {
                $message = 'Could not perform the operations requested';
            }

        }

        try {
            $refund = new Refund;
            $refund->booking_id = $request->input('booking_id');
            $refund->goldtrack_id = $request->input('goldtrack_id');
            $refund->user_id = Auth::user()->id;
            $refund->reason_id = $request->input('reason_id');
            $refund->amount = $amount;
            $refund->note = $request->input('note');
            $refund->save();

            $event = Event::find($request->input('event_id'));
            $event->pot -= $amount;
            $event->save();

            $message .= ', Event pot updated';
        }
        catch(\Exception $e) {
            $message = 'Could not perform the operations requested';
        }

        return redirect()->route('goldtracks.index')
            ->with('flash_message', $message);
    }

    public function show(Refund $refund)
    {
        //
    }

    public function edit(Refund $refund)
    {
        //
    }

    public function update(Request $request, Refund $refund)
    {
        //
    }

    public function destroy(Refund $refund)
    {
        //
    }

    public function createRefund(Goldtrack $goldtrack){
        //dd($goldtrack->booking->id);
        return view ('refunds.create', compact('goldtrack'));
    }
}
