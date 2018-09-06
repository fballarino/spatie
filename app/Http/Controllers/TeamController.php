<?php

namespace App\Http\Controllers;

use App\Article;
use App\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'team']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::with('article')->get();
        return view('teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articles = Article::all();
        return view('teams.create', compact('articles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name1'        => 'required|string',
            'name2'        => 'required|string',
            'name3'        => 'required|string',
            'name4'        => 'required',
            'name5'        => 'required',
            'tank'        => 'required|integer|min:1|max:2',
            'healer'      => 'required|integer|min:3|max:6',
            'mdps'        => 'required|integer|min:4|max:11',
            'rdps'        => 'required|integer|min:4|max:11',
            'description' => 'nullable|string|max:255'
        ]);

        try{
            $team = new Team;
            $team->name = ($request->input('name1')." ".
                $request->input('name2')." ".
                $request->input('name3')." ".
                $request->input('name4').":".
                $request->input('name5'));
            $team->article_id = $request->input('article_id');
            $team->tank = $request->input('tank');
            $team->healer = $request->input('healer');
            $team->mdps = $request->input('mdps');
            $team->rdps = $request->input('rdps');
            $team->description = $request->input('description');
            $team->save();

            return redirect()->to('teams')
                ->with('flash_message', 'Team '.$request->input('name').' created successfully' );
        }
        catch(\Exception $e){
            return redirect()->to('teams/create')
                ->with('flash_message', 'Team '.$request->input('name').' duplicated found, not created' );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        $team_data = Team::with('characters')->find($team->id);
        //dd($team_data);
        return view('teams.show', compact('team_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        $articles = Article::all();
        return view('teams.edit', compact('articles', 'team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name'        => 'required|string',
            'tank'        => 'required|integer|min:1|max:2',
            'healer'      => 'required|integer|min:3|max:6',
            'mdps'        => 'required|integer|min:4|max:11',
            'rdps'        => 'required|integer|min:4|max:11',
            'description' => 'nullable|string|max:255'
        ]);

        try{
            $team->name = $request->input('name');
            $team->article_id = $request->input('article_id');
            $team->tank = $request->input('tank');
            $team->healer = $request->input('healer');
            $team->mdps = $request->input('mdps');
            $team->rdps = $request->input('rdps');
            $team->description = $request->input('description');
            $team->save();

            return redirect()->to('teams')
                ->with('flash_message', 'Team '.$request->input('name').' updated successfully' );
        }
        catch(\Exception $e){
            return redirect()->to('teams/create')
                ->with('flash_message', 'Team '.$request->input('name').' could not be updated!' );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->to('teams')
            ->with('flash_message', 'Team '.$team->name.' deleted successfully' );
    }
}
