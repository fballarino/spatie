<?php

namespace App\Http\Controllers;

use App\Goldtrack;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        $goldtracks = Goldtrack::with(['user', 'booking', 'event'])
            ->limit(200)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('goldtracks.index', compact('goldtracks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "create method";
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
        return "method show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Goldtrack  $goldtrack
     * @return \Illuminate\Http\Response
     */
    public function edit(Goldtrack $goldtrack)
    {
        $userlist = User::orderBy('name', 'asc')->get();
        return view('goldtracks.edit', compact('goldtrack', 'userlist'));
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
        $validateRequest = [
            'code' => 'nullable',
            'user_id' => 'required|integer',
            'amount' => 'integer|min:-9999999|max:9999999',
        ];
        $this->validate($request, $validateRequest);
        $goldtrack->code = (int)$request->input('code');
        $goldtrack->user_id = $request->input('user_id');
        $goldtrack->amount = (int)$request->input('amount');
        if($request->input('verified') == "on" && $goldtrack->verified == false){
            $goldtrack->verified = true;
            $goldtrack->verified_by = Auth::user()->name;
            $goldtrack->verified_at = Carbon::now();
        }
        else{
            if($request->input('verified') == "" && $goldtrack->verified == true){
                $goldtrack->verified = false;
                $goldtrack->verified_by = null;
                $goldtrack->verified_at = null;
            }
        }
        $result = $goldtrack->save();
        if($result){
            Session::flash('flash_message', "Goldtrack " .$goldtrack->id. " successfully updated");
        }
        return $this->index();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Goldtrack  $goldtrack
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goldtrack $goldtrack)
    {
        $result = $goldtrack->delete();
        if($result){
            Session::flash('flash_message', "Goldtrack " .$goldtrack->id. " successfully soft-deleted");
        }
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Goldtrack  $goldtrack
     * @return \Illuminate\Http\Response
     */
    public function test(Goldtrack $goldtrack)
    {
        return "test method";
    }

    public function verifyMovements(Request $request)
    {
        $counter = 0;
        foreach($request->input() as $key => $value)
        {
            if(is_numeric($key) && $value == "on"){
                Goldtrack::where('id', $key)
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
