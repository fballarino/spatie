<?php

namespace App\Http\Controllers;

use App\Character;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CharacterController extends Controller
{

    protected $fillable = ['name', 'realm','class', 'mainspec', 'wowprogress', 'gear', 'user_id'];

    protected $classSpec = [
        'Death Knight' => ['Any','Blood','Frost','Unholy'],
        'Demon Hunter' => ['Any','Havoc','Vengeance'],
        'Druid' => ['Any','Balance','Feral','Guardian', 'Restoration'],
        'Hunter' => ['Any','Beast Mastery','Marskmanship','Survival'],
        'Mage' => ['Any','Arcane','Fire','Frost'],
        'Monk' => ['Any','Brewmaster','Mistweaver','Windwalker'],
        'Paladin' => ['Any','Holy','Protection','Retribution'],
        'Priest' => ['Any','Discipline','Holy','Shadow'],
        'Rogue' => ['Any','Assassination','Outlaw','Subtlety'],
        'Shaman' => ['Any','Elemental','Enhancement','Restoration'],
        'Warlock' => ['Any','Affliction','Demonology','Destruction'],
        'Warrior' => ['Any','Arms','Fury','Protection'],
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allCharacters = User::find(Auth::user()->id)->characters;
        return view('characters.index', compact('allCharacters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classSpec = $this->classSpec;
        return view('characters.create', compact('classSpec'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd(request()->input());
        $validateRequest = [
            'name'        => 'required|string|max:20',
            'realm'       => 'required|string|max:40',
            'class'       => 'required|string',
            'mainspec'    => 'required|string|min:4',
            'wowprogress' => 'required|string',
            'gear'        => 'required|integer|min:340',
            'main'        => 'required|integer|min:0|max:1',
        ];
        $this->validate($request, $validateRequest);

        $newCharacter = new Character;
        $newCharacter->name        = $request->input('name');
        $newCharacter->realm       = $request->input('realm');
        $newCharacter->class       = $request->input('class');
        $newCharacter->mainspec    = $request->input('mainspec');
        $newCharacter->wowprogress = $request->input('wowprogress');
        $newCharacter->gear        = $request->input('gear');
        $newCharacter->main        = $request->input('main');
        $newCharacter->user_id     = Auth::user()->id;
        $newCharacter->save();

        return redirect()->to('characters/create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeStatus($character)
    {
        $characterMain = Character::findOrFail($character);
        if($characterMain){
            $characterMain->main = request()->input('main');
            $characterMain->save();
        }
        return redirect(route('characters.index'));
    }
}
