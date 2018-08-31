<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
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
        // Display transaction per bank, requires a bank via hidden param
        $transactions = Transaction::with(['user', 'bank'])
                                    ->where('bank_id',1)
                                    ->limit(10)
                                    ->get();
        //dd($transactions);
        return view('transactions.index', compact('transactions'));
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
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    /**
     * Adds a quick deposit to a Bank
     *
     * @param  \
     * @return
     */
    public function showBankTransactions($id)
    {
        $transactions = Transaction::with(['user', 'bank'])
            ->where('bank_id', $id)
            ->limit(100)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('transactions.index', compact('transactions'));

    }

    public function addDeposit()
    {
        //
    }

    /**
     * Adds a quick deposit to a Bank
     *
     * @param
     * @return
     */
    public function subPayment()
    {
        //
    }
}
