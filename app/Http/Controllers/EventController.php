<?php

namespace App\Http\Controllers;

use App\Event;
use App\Product;
use Illuminate\Http\Request;

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allEvents = Event::all();
        return view('events.index', compact('allEvents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->mplusLevels(env('MPLUSMAX'));
        $eventDiff = $this->eventDifficulty;
        return view('events.create', compact('products', 'eventDiff'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required|string',
            'difficulty'   => 'required|string',
            'buyers'       => 'required|integer',
            'boosters'     => 'required|integer',
            'overbooking'  => 'required|integer',
            'run_at'       => 'required',
            'visible_at'   => 'required',
            'note'         => 'max:100',
        ]);
        //dd($this->parseDate(request()->input('run_at')));
        //echo $this->parseDate(request()->input('run_at'));
        //echo $this->parseDate(request()->input('visible_at'));
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
        $newEvent->pot = 100;
        $newEvent->save();

        //dd($eventData);

        return redirect()->route('events.index')
            ->with('flash_message', 'Event:
             '. request()->input('product_name').' created');

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

    protected function parseDate($dateFormat)
    {
        $run_at = trim($dateFormat);
        $run_at_time = substr($run_at,0,5);
        $run_at_date = substr($run_at, 6, 10);
        $run_at_date_array = explode("/", $run_at_date );
        return ($run_at_date_array[2]."-".$run_at_date_array[0]."-".$run_at_date_array[1] . " " . $run_at_time . ":00");
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
