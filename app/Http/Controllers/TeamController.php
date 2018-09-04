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
            'name'        => 'required|string|min:10|max:128',
            'tank'        => 'required|integer|min:1|max:2',
            'healer'      => 'required|integer|min:3|max:6',
            'mdps'        => 'required|integer|min:4|max:11',
            'rdps'        => 'required|integer|min:4|max:11',
            'description' => 'nullable|string|max:255'
        ]);

        $team = new Team;
        $team->name = $request->input('name');
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
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
            'name'        => 'required|string|min:10|max:128',
            'tank'        => 'required|integer|min:1|max:2',
            'healer'      => 'required|integer|min:3|max:6',
            'mdps'        => 'required|integer|min:4|max:11',
            'rdps'        => 'required|integer|min:4|max:11',
            'description' => 'nullable|string|max:255'
        ]);

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
