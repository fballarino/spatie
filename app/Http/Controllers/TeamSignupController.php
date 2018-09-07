<?php

namespace App\Http\Controllers;

use App\Character;
use App\Part;
use App\Team;
use App\TeamSignup;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class TeamSignupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();
        $characters = Character::with('teams','user')
            ->where('user_id', Auth::user()->id)
            ->get();
        $characters2 = $characters;
        //dd($characters);
        /*foreach($characters as $character){
            foreach($character->teams as $element){
                echo($element->id .'<br>');
            };
        };*/
        $parts = Part::all();
        return view('teamsignups.index', compact('teams', 'characters', 'parts', 'characters2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*$results = Team::with('characters')->find(1);
        foreach($results->characters as $character){
            echo $character->pivot->part;
        };*/

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $counter = 0;
        $teams= Input::get('team');
        $characters= Input::get('character');
        $parts= Input::get('part');

        $data = [];

        //dd($characters);
        foreach($characters as $key => $value){
            if($value != 0){
                $data[] = [
                    'team_id' => $teams[$key],
                    'character_id' => $value,
                    'part' => $parts[$key],
                    'user_id' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }

        foreach($data as $signup){
            //dd($signup);
            $result = DB::table('character_team')
                ->where('team_id', $signup['team_id'])
                ->where('user_id', Auth::user()->id)
                ->first();
            //dd($result);
            if($result)
            {
                return redirect()->to('teamsignups')->with('flash_message', "Already signed up for that team!");
            }
            else{
                DB::table('character_team')->insert($signup);
                $counter++;
            }
        }
        return redirect()->to('teamsignups')->with('flash_message', $counter." Signups successfully created");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TeamSignup  $teamSignup
     * @return \Illuminate\Http\Response
     */
    public function show(TeamSignup $teamSignup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TeamSignup  $teamSignup
     * @return \Illuminate\Http\Response
     */
    public function edit(TeamSignup $teamSignup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TeamSignup  $teamSignup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeamSignup $teamSignup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TeamSignup  $teamSignup
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeamSignup $teamSignup)
    {
        //
    }
}
