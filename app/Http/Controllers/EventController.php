<?php

namespace App\Http\Controllers;

use App\Event;
use App\Product;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $eventDifficulty = ['Normal', 'Heroic', 'Mythic', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
            '10', '11', '12', '13', '14', '15',  '16', '17', '18', '19', '20', '21', '22', '23', '24', '25',
            '26',  '27',  '28',  '29',  '30',
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
        return Event::all();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
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
            'run_at'       => 'required|date',
            'visible_at'   => 'required|date',
            'note'         => 'max:100',
        ]);
        //dd(request()->input());
        echo $this->parseDate(request()->input('run_at'));
        echo $this->parseDate(request()->input('visible_at'));

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
}
