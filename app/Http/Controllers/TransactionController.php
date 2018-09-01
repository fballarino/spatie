<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        dd(request()->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validateRequest = [
            'code' => 'required|integer',
            'recipient' => 'required|integer',
            'amount' => 'integer|min:-9999999|max:9999999',
            'note' => 'nullable|string|max:255',
        ];
        //dd($request->all());
        $this->validate($request, $validateRequest);
        //dd($request->input('amount'));
        $transaction = new Transaction;
        $transaction->bank_id = $request->input('bank');
        $transaction->user_id = $request->input('recipient');
        $transaction->operator_id = Auth::user()->id;
        $transaction->operation = $this->processOperation($request->input('code'));
        $transaction->amount = $request->input('amount');
        $transaction->note = $request->input('note');
        $transaction->save();

        Session::flash('flash_message', "Transaction Inserted");
        return redirect()->to('banks');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $recipient = User::where('id', $transaction->user_id)->first();
        $operator = User::where('id', $transaction->operator_id)->first();
        return view('transactions.show', compact('transaction', 'recipient', 'operator'));
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

    public function addMovement($id)
    {
        $userlist = User::orderBy('name', 'ASC')->get();
        return view('transactions.create', compact('userlist', 'id'));
    }

    public function processOperation($code){
        foreach (config('globals.operationsTransaction') as $key => $value){
            if($code == $key){
                return $value;
            }
        }
    }

}
