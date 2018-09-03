<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $banks = Bank::with(['transactions'])
            ->orderBy('region', 'ASC')
            ->orderBy('name', 'ASC')
            ->orderBy('faction', 'ASC')
            ->get();

        return view('banks.index', compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'realm' => 'required|string|min:5|max:30',
            'faction' => 'required|string|max:10',
            'region' => 'required||string|max:2',
            'balance' => 'nullable|integer',
        ]);

        $bank = new Bank;
        $bank->name = $request->input('realm');
        $bank->faction = $request->input('faction');
        $bank->region = $request->input('region');
        $bank->balance = (int)$request->input('balance');
        $creation = $bank->save();
        if($creation){
            Session::flash('flash_message', 'Bank successfully created');
        }
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show($bank)
    {

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
