<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

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
        /*$transactions = Transaction::with(['user', 'bank'])
                                    ->where('bank_id',1)
                                    ->limit(10)
                                    ->get();
        //dd($transactions);
        */
        $transactions = Transaction::with('recipient')->with('sender')->get();
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
            'user_id' => 'required|integer',
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
        $transaction->verified = false;
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
        $userlist = User::all();
        return view('transactions.edit', compact('transaction', 'userlist'));
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
        $validateRequest = [
            'code' => 'required|integer',
            'user_id' => 'required|integer',
            'amount' => 'integer|min:-9999999|max:9999999',
            'note' => 'nullable|string|max:255',
        ];
        //dd($request->all());
        $this->validate($request, $validateRequest);

        $transaction->operation = $this->processOperation($request->input('code'));
        $transaction->user_id = $request->input('user_id');
        $transaction->amount = (int)$request->input('amount');
        $transaction->note = $request->input('note');

        $result = $transaction->save();
        if($result){
            Session::flash('flash_message', "Transaction " .$transaction->id. " successfully updated");
        }
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $result = $transaction->delete();
        if($result){
            Session::flash('flash_message', "Transaction ID: " .$transaction->id. " successfully deleted");
        }
        return redirect()->back();
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

    public function custom()
    {

    }

    public function verifyMovements(Request $request)
    {
        $counter = 0;
        foreach($request->input() as $key => $value)
        {
            if(is_numeric($key) && $value == "on"){
                Transaction::where('id', $key)
                    ->update([
                        'verified' => 1,
                        'verified_by' => Auth::user()->name,
                        'verified_at' => Carbon::now(),
                    ]);
                $counter++;
            }
        }
        Session::flash('flash_message', "Successfully verified ".$counter. " record/s");
        return $this->index();
    }

}
