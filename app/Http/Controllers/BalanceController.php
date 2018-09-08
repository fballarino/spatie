<?php

namespace App\Http\Controllers;

use App\Balance;
use App\Booking;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ($data = User::with(['bookings', 'attendances', 'goldtracks', 'transactions'])
            ->where('id', Auth::user()->id)
            ->first());
        $deposited = Transaction::where('operator_id', Auth::user()->id)
            ->where('operation', '(001) Collector Deposit' )
            ->get();

        ($fee_amount = $data->bookings->sum('fee'));
        ($attendance_amount = $data->attendances->sum('cut'));
        ($goldtrack_amount = $data->goldtracks->sum('amount'));
        ($deposited_amount = $deposited->sum('amount'));
        ($payroll_amount = abs($data->transactions->sum('amount')));
        $balance = [$fee_amount, $goldtrack_amount, $deposited_amount, $attendance_amount, $payroll_amount];
        return view('balances.index', compact('balance'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Balance $balance)
    {
        //
    }

    public function edit(Balance $balance)
    {
        //
    }

    public function update(Request $request, Balance $balance)
    {
        //
    }

    public function destroy(Balance $balance)
    {
        //
    }

    public function getAdvertiserFees(){

        $fees_advertiser = Booking::with('event')
            ->where('user_id', Auth::user()->id)
            ->get();

        $fees_total = $fees_advertiser->sum('fee');

        return view('balances.fees', compact('fees_advertiser', 'fees_total'));

    }
}
