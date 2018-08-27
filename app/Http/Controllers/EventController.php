<?php

namespace App\Http\Controllers;

use App\Event;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class EventController extends Controller
{

    protected $fillable=['product_name', 'difficulty', 'buyers', 'boosters', 'overbooking',
        'run_at', 'visible_at', 'note', 'reference'];

    protected $arrayProducts = [
        'ULDR' => 'Uldir',
        'MODG' => 'Mythic Dungeon',
        'MPDG' => 'Mythic Plus Dungeon',
        'ISXP' => 'Island Expedition',
    ];

    protected $arrayDifficulties = [
        'NM' => 'Normal',
        'HC' => 'Heroic',
        'MY' => 'Mythic',
    ];

    protected $arrayStatuses = [
        0 => "Open",
        1 => "Full",
        2 => "Overbooked",
        3 => "In Progress",
        4 => "Completed",
        5 => "Pending Att.",
        6 => "Archived",
    ];

    protected $eventDifficulty =
        ['Uldir'                   => ['Normal', 'Heroic', 'Mythic'],
         'Mythic Dungeon'          => [0],
         'Mythic Plus Dungeon'     => [],
         'Island Expedition'       => ['Normal', 'Heroic', 'Mythic'],
        ];

    public function __construct()
    {
        $this->middleware(['auth', 'event'])->except('index');
    }

    public function index()
    {
        $allEvents = Event::all();
        $allUsers = User::all('id', 'name');
        return view('events.index', compact('allEvents', 'allUsers'));
    }

    public function create()
    {
        $this->mplusLevels(env('MPLUSMAX'));
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
        $newEvent->status = $this->arrayStatuses[0];
        $newEvent->user_id = Auth::user()->id;
        $newEvent->save();

        return redirect()->route('events.index')
            ->with('flash_message', 'Event:
             '. request()->input('product_name').' created');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
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

    protected function mplusLevels($maxlevel){
        for($i = 0; $i<= $maxlevel; $i++) {
            $this->eventDifficulty['Mythic Plus Dungeon'][] = $i;
            $this->arrayDifficulties[$i] = $i;
        }
    }

    protected function setEventReference($productName, $eventDifficulty, $eventDate){
        $this->mplusLevels(30);
        $firstPart = array_search($productName, $this->arrayProducts);
        $secondPart = array_search($eventDifficulty, $this->arrayDifficulties);
        if (is_numeric($secondPart) && $secondPart<10)
        {
            $secondPart = "0".$secondPart;
        }
        $thirdPart = substr($this->parseDate($eventDate),5,2);
        $fourthPart = substr($this->parseDate($eventDate),8,2);
        $fifthPart = str_replace(":", "",substr($this->parseDate($eventDate),11,5));
        $seed = random_int(1000,1999);

        return ($firstPart."-".$secondPart."/".$fourthPart.$thirdPart."-".$fifthPart."-".$seed);
    }
}
