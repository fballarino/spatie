<?php

namespace App\Http\Controllers;

use App\Goldtrack;
use Illuminate\Http\Request;

class GoldtrackController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'goldtrack']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Goldtrack  $goldtrack
     * @return \Illuminate\Http\Response
     */
    public function show(Goldtrack $goldtrack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Goldtrack  $goldtrack
     * @return \Illuminate\Http\Response
     */
    public function edit(Goldtrack $goldtrack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Goldtrack  $goldtrack
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Goldtrack $goldtrack)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Goldtrack  $goldtrack
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goldtrack $goldtrack)
    {
        //
    }
}
