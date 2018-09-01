<?php

namespace App\Http\Controllers;

use App\Event;
use App\Character;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class EventController extends Controller
{

    protected $fillable=['product_name', 'difficulty', 'buyers', 'boosters', 'overbooking',
        'run_at', 'visible_at', 'note', 'reference'];

    protected $arrayProducts = [];

    protected $arrayDifficulties = [];

    protected $arrayStatuses = [];

    protected $eventDifficulty = [];


    public function __construct()
    {
        $this->middleware(['auth', 'event'])->except('index');
        $this->initializeArrays();
    }

    public function index()
    {
        $allEvents = Event::where('visible_at','<=', Carbon::now())
                        ->where('run_at', '>=', Carbon::now())
                        ->get();
        $allUsers = User::all('id', 'name');
        return view('events.index', compact('allEvents', 'allUsers'));
    }

    public function create()
    {
        $eventDiff = $this->eventDifficulty;
        return view('events.create', compact('products', 'eventDiff'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required|string',
            'difficulty'   => 'required|string',
            'buyers'       => 'required|integer',
            'boosters'     => 'required|integer',
            'overbooking'  => 'required|integer',
            'leader_cut'   => 'nullable|integer',
            'run_at'       => 'required|date',
            'visible_at'   => 'required|date',
            'note'         => 'max:100',
        ]);

        $newEvent = new Event;
        $newEvent->product_name = request()->input('product_name');
        $newEvent->difficulty = request()->input('difficulty');
        $newEvent->buyers = request()->input('buyers');
        $newEvent->boosters = request()->input('boosters');
        $newEvent->overbooking = request()->input('overbooking');
        $newEvent->run_at = $this->parseDate(request()->input('run_at'));
        $newEvent->visible_at = $this->parseDate(request()->input('visible_at'));
        $newEvent->note = request()->input('note');
        $newEvent->reference = $this->setEventReference(request()->input('product_name'),
            request()->input('difficulty'), request()->input('run_at'));
        $newEvent->pot = 0;
        $newEvent->leader_cut = request()->input('leader_cut');
        $newEvent->status = $this->arrayStatuses[0];
        $newEvent->user_id = Auth::user()->id;
        $newEvent->save();

        return redirect()->route('events.index')
            ->with('flash_message', 'Event:
             '. request()->input('product_name').' created');

    }

    public function show($id)
    {
        $eventData = Event::find($id);
        $signups = Character::join('signups as S','characters.id', '=', 'S.character_id')
                    ->where('S.event_id', $id)
                    ->where('S.deleted_at', null)
                    ->orderBy('S.created_at','DESC')
                    ->get();
        //dd($signups);

        return view('events.show', compact('eventData','signups'));
    }

    public function edit($id)
    {
        $arrayProducts = $this->arrayProducts;
        $eventDifficulty = $this->eventDifficulty;
        $eventProgress = $this->arrayStatuses;
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event','arrayProducts', 'eventDifficulty', 'eventProgress'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product_name' => 'required|string',
            'difficulty'   => 'required|string',
            'buyers'       => 'required|integer',
            'boosters'     => 'required|integer',
            'overbooking'  => 'required|integer',
            'run_at'       => 'required|date',
            'visible_at'   => 'required|date',
            'note'         => 'max:100',
        ]);

        $event = Event::findOrFail($id);
        $event->product_name = $request->input('product_name');
        $event->difficulty = $request->input('difficulty');
        $event->buyers = $request->input('buyers');
        $event->boosters = $request->input('boosters');
        $event->overbooking = $request->input('overbooking');
        $event->run_at = $this->parseDate(request()->input('run_at'));
        $event->visible_at= $this->parseDate(request()->input('visible_at'));
        $event->note = $request->input('note');
        $event->status = $this->arrayStatuses[$request->input('status')];
        $event->reference = $this->setEventReference(request()->input('product_name'),
        request()->input('difficulty'), request()->input('run_at'));
        $event->save();

        return $this->index();
    }

    public function destroy($id)
    {
        //
    }

    protected function parseDate($dateToProcess)
    {
        // $dateToProcess input format: 19:00 08/29/2018
        $dateTemp = DateTime::createFromFormat('H:i m/d/Y', $dateToProcess);
        $dateTemp = $dateTemp->format('Y-m-d H:i:s');

        return $dateTemp;
    }

    protected function setEventReference($productName, $eventDifficulty, $eventDate){
        $firstPart = array_search($productName, $this->arrayProducts);
        $secondPart = array_search($eventDifficulty, $this->arrayDifficulties);
        //dd($this->arrayDifficulties);
        if (is_numeric($secondPart) && $secondPart<10)
        {
            $secondPart = "0".$secondPart;
        }
        $thirdPart = substr($this->parseDate($eventDate),5,2);
        $fourthPart = substr($this->parseDate($eventDate),8,2);
        $fifthPart = str_replace(":", "",substr($this->parseDate($eventDate),11,5));
        $seed = random_int(1000,1999);
        ($firstPart."-".$secondPart."/".$fourthPart.$thirdPart."-".$fifthPart."-".$seed);

        return ($firstPart."-".$secondPart."/".$fourthPart.$thirdPart."-".$fifthPart."-".$seed);
    }

    protected function initializeArrays(){
        $this->arrayStatuses = config('globals.eventProgress');
        $this->arrayProducts = config('globals.arrayProducts');
        $this->arrayDifficulties = config('globals.arrayDifficulties');
        $this->eventDifficulty = config('globals.eventDifficulty');
        //dd($this->arrayDifficulties);
    }
}
