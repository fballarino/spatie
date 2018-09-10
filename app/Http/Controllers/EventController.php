<?php

namespace App\Http\Controllers;

use App\Article;
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
        $events_all = Event::with('user', 'article')
            ->where('visible_at','<=', Carbon::now())
            ->where('run_at', '>=', Carbon::now()->subHours(4))
            ->where('faction_id', '=', Auth::user()->faction_id)
            ->get();
        return view('events.index', compact('events_all'));
    }

    public function create()
    {
        $articles = Article::orderBY('description', 'asc')->get();
        return view('events.create', compact('articles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'faction_id'   => 'required|integer',
            'article_id'   => 'required|integer',
            'buyers'       => 'required|integer',
            'boosters'     => 'required|integer',
            'overbooking'  => 'required|integer',
            'leader_cut'   => 'nullable|integer',
            'run_at'       => 'required|date',
            'visible_at'   => 'required|date',
            'note'         => 'max:100',
        ]);

        try {
            $newEvent = new Event;
            $newEvent->faction_id = request()->input('faction_id');
            $newEvent->article_id = request()->input('article_id');
            $newEvent->buyers = request()->input('buyers');
            $newEvent->boosters = request()->input('boosters');
            $newEvent->overbooking = request()->input('overbooking');
            $newEvent->run_at = $this->parseDate(request()->input('run_at'));
            $newEvent->visible_at = $this->parseDate(request()->input('visible_at'));
            $newEvent->note = request()->input('note');
            $newEvent->reference = $this->setEventReference(request()->input('article_id'),
                request()->input('run_at'));
            $newEvent->pot = 0;
            $newEvent->leader_cut = ((request()->input('leader_cut') == "")? 0 : request()->input('leader_cut'));
            $newEvent->status = $this->arrayStatuses[0];
            $newEvent->user_id = Auth::user()->id;
            $newEvent->buyers_booked = 0;
            $newEvent->boosters_booked = 0;
            $newEvent->save();

            return redirect()->route('events.index')
                ->with('flash_message', 'Event successfully created');
        }

        catch(\Exception $e){
            return redirect()->route('events.index')
                ->with('flash_message', 'Event could not be created');
        }

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
        $eventProgress = $this->arrayStatuses;
        $articles = Article::pluck('description','id');
        $event = Event::with('article')->findOrFail($id);
        return view('events.edit', compact('event','articles', 'eventProgress'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'faction_id'   => 'required|integer',
            'article_id'   => 'required|integer',
            'buyers'       => 'required|integer',
            'boosters'     => 'required|integer',
            'overbooking'  => 'required|integer',
            'run_at'       => 'required|date',
            'visible_at'   => 'required|date',
            'note'         => 'max:100',
            'screenshot'   => 'nullable',
        ]);

        try {
            $event = Event::findOrFail($id);
            $event->faction_id = request()->input('faction_id');
            $event->article_id = $request->input('article_id');
            $event->buyers = $request->input('buyers');
            $event->boosters = $request->input('boosters');
            $event->overbooking = $request->input('overbooking');
            $event->run_at = $this->parseDate(request()->input('run_at'));
            $event->visible_at= $this->parseDate(request()->input('visible_at'));
            $event->note = $request->input('note');
            $event->status = $request->input('status');
            $event->reference = $this->setEventReference($request->input('article_id'),
                request()->input('run_at'));

            if ($request->hasFile('screenshot')) {
                $extension = $request->file('screenshot')->getClientOriginalExtension();
                $file= substr($event->reference,0,13).'_'.Carbon::parse($event->run_at)->format('d-m-Y_Hi').'.'.$extension;
                $request->file('screenshot')->storeAs(
                    'events', $file);
                $event->attendance_img = env('APP_URL').'/storage/app/events/'.$file;
            }
            $event->save();

            return redirect()->route('events.index')
                ->with('flash_message', 'Event successfully updated');
        }

        catch(\Exception $e){
            return redirect()->route('events.index')
                ->with('flash_message', 'Event could not be updated');
        }
    }

    public function destroy(Event $event)
    {
        try{
            $event->delete();
            return redirect()->to('tools/evntmngr')
                ->with('flash_message', 'Event '.$event->name. ' deleted successfully' );
        }
        catch(\Exception $e){
            return redirect()->to('tools/evntmngr')
                ->with('flash_message', 'Event '.$event->name. '  was not deleted' );
        }
    }

    protected function parseDate($dateToProcess)
    {
        // $dateToProcess input format: 19:00 08/29/2018
        $dateTemp = DateTime::createFromFormat('H:i m/d/Y', $dateToProcess);
        $dateTemp = $dateTemp->format('Y-m-d H:i:s');

        return $dateTemp;
    }

    protected function setEventReference($article_id, $event_date){
        $article_code = Article::find($article_id)->code;
        $thirdPart = substr($this->parseDate($event_date),5,2);
        $fourthPart = substr($this->parseDate($event_date),8,2);
        $fifthPart = str_replace(":", "", substr($this->parseDate($event_date),11,5));
        $seed = random_int(1000,1999);

        return ($article_code."/".$fourthPart.$thirdPart."-".$fifthPart."-".$seed);
    }

    protected function initializeArrays(){
        $this->arrayStatuses = config('globals.eventProgress');
        $this->arrayProducts = config('globals.arrayProducts');
        $this->arrayDifficulties = config('globals.arrayDifficulties');
        $this->eventDifficulty = config('globals.eventDifficulty');
        //dd($this->arrayDifficulties);
    }
}
