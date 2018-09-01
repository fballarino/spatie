<?php

namespace App\Http\Controllers;

use App\Balance;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function show(Balance $balance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function edit(Balance $balance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Balance $balance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Balance $balance)
    {
        //
    }
}
