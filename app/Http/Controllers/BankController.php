<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Transaction;
use Illuminate\Http\Request;

class BankController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'bank']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::orderBy('region', 'ASC')->orderBy('name', 'ASC')->orderBy('faction', 'ASC')->get();
        $totalBalance = Bank::sum('balance');
        return view('banks.index', compact('banks', 'totalBalance'));
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
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show($bank)
    {
        /*
        $transactions = Transaction::join('users as usersR', 'usersR.id', '=', 'user_id')
                        ->join('users as usersA', 'usersA.id', '=', 'operator_id')
                        ->select('transactions.id','transactions.amount', 'usersR.name as Recipient', 'usersA.name as Accountant')
                        ->where('bank_id',$bank)
                        ->limit(10)
                        ->orderBy('transactions.id','ASC')
                        ->get();
        $tras = Bank::find($bank)->transactions()->limit(5)->get();

        /*$transactions = \App\Transaction::with('banks', 'users')
            ->where('bank_id', $bank)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        foreach ($transactions as $transaction) {

            echo $transaction->amount . "<br>";

            echo $transaction->users;

            //$transaction->banks->name;
            //$transaction->banks->region;

        }*/
        /*
        $bank = Bank::find($bank)->transactions()
            ->orderBy('created_at','DESC')
            ->get();

        foreach($bank->users as $user) {
            echo $user->name;
            echo $user->pivot->amount;
        }*/


        //return view('banks.show', compact('transactions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        //
    }

}
