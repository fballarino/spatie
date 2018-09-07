<?php

namespace App\Http\Controllers;

use App\Character;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CharacterController extends Controller
{

    protected $fillable = ['name', 'realm','class', 'mainspec', 'wowprogress', 'gear', 'user_id'];

    protected $classSpec = [];

    public function __construct() {
        $this->middleware(['auth', 'character'])->except('index');
        $this->populateClassSpec();
    }

    public function index()
    {
        $allCharacters = User::find(Auth::user()->id)->characters;
        return view('characters.index', compact('allCharacters'));
    }

    public function create()
    {
        $classSpec = $this->classSpec;
        return view('characters.create', compact('classSpec'));
    }

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

        //return redirect()->to('characters/create');
        return $this->index();

    }

    public function show($id)
    {
        dd(Character::find($id));
    }

    public function edit($id)
    {
        $character = Character::findOrFail($id);
        $classSpec = $this->classSpec;
        return view('characters.edit', compact('character', 'classSpec'));
    }

    public function update(Request $request, $id)
    {
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

        $currentCharacter = Character::findOrFail($id);
        $currentCharacter->name        = $request->input('name');
        $currentCharacter->realm       = $request->input('realm');
        $currentCharacter->class       = $request->input('class');
        $currentCharacter->mainspec    = $request->input('mainspec');
        $currentCharacter->wowprogress = $request->input('wowprogress');
        $currentCharacter->gear        = $request->input('gear');
        $currentCharacter->main        = $request->input('main');
        $currentCharacter->save();

        return $this->index();
    }

    public function destroy($id)
    {
        $character = Character::findOrFail($id);
        Character::destroy($id);
        return redirect()->to('characters')->with('flash_message', 'Character:
                                        '.$character->name.' successfully deleted');
    }

    public function changeStatus($character)
    {
        $characterMain = Character::findOrFail($character);
        if($characterMain){
            $characterMain->main = request()->input('main');
            $characterMain->save();
        }

        return redirect()->route('characters.index')
                         ->with('flash_message', 'Status of: <b>'
                             . $characterMain->name."-".$characterMain->realm.'</b> updated');
    }

    private function populateClassSpec(){
        $this->classSpec = config('globals.classSpec');
    }
}
