<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonTrait;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Tournament;
use App\Podium;
use App\TournamentType;
use App\Member;

use App\Picture;


class TournamentsController extends Controller
{
    use CommonTrait;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
         $this->middleware('auth', ['except' => ['showone', 'eventcalendar', 'ozoirTournaments',
         'privateTournaments', 'championships', 'report', 'tournamentpictures', 'tournamentvideos',
         'tournamentlisting' , 'showpodiums', 'archiveschoice', 'oldOzoirTournaments', 'oldPrivateTournaments',
          'oldChampionships', 'podiumpictures']]);
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tournaments = Tournament::with('type')->get();

        return view('admin.tournaments.index', compact('tournaments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tournamentTypes = TournamentType::all();
        
        return view('admin.tournaments.create', compact('tournamentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedTournament = request()->validate([
            'type_id' => 'required|numeric',
            'start_season' => 'required|numeric|min:2000',
            'date' => 'required|date',
            'title' => 'required',
            'is_accredited' => 'required|boolean',
            'is_rules_pdf' => 'required|boolean',
            'rules_url' => 'nullable|url',
            'place' => 'required',
            'lexer_url' => 'nullable|url',
            'report' => ''
        ]);

        $validatedPDF = request()->validate([
            'is_finished' => 'nullable',
            "listing" => 'nullable|image',
            'rules_pdf' => 'nullable|mimes:pdf|max:10000'
        ]);

        TournamentType::findOrFail($validatedTournament['type_id']);
        
        $year = intval($validatedTournament['start_season']);

        $validatedTournament['start_season'] = Carbon::createFromDate($year, 9, 1, 0, 0, 0);
        $validatedTournament['end_season'] = Carbon::createFromDate($year + 1, 8, 31, 0, 0, 0);

        if(isset($validatedPDF['is_finished'])){
            $validatedTournament['is_finished'] = 1;
        }

        $tournament = Tournament::create($validatedTournament);

        if(isset($validatedPDF['is_finished'])){
            $podium = Podium::create(['tournament_id' => $tournament->id, 'date' => $tournament->date ]);
            $podium->slug = str_slug($tournament->title . ' ' . $podium->id, '-');
            $podium->save();
        }

        if($file = $request->file('rules_pdf')){
            $path = request()->file('rules_pdf')->store('public/upload/images/tournaments/' . $tournament->id );
            $tournament->rules_pdf = substr($path, 6);
        }

        if($request->hasFile('listing')){
            $path = request()->file('listing')->store('public/upload/medias/tournaments/' . $tournament->id );
            $tournament->listing = substr($path, 6);
        }
        $tournament->slug = str_slug($tournament->title . ' ' . $tournament->id, '-');
        $tournament->save();

        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'Le tournoi a bien été enregistré');

        return redirect('/administration/tournois');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tournament = Tournament::with('type')->findOrFail($id);
        $tournamentTypes = TournamentType::all();
        
        return view('admin.tournaments.edit', compact('tournament', 'tournamentTypes'));
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
        $validatedTournament = request()->validate([
            'type_id' => 'required|numeric',
            'start_season' => 'required|numeric|min:2000',
            'date' => 'required|date',
            'title' => 'required',
            'is_accredited' => 'required|boolean',
            'is_rules_pdf' => 'required|boolean',
            'rules_url' => 'nullable|url',
            'place' => 'required',
            'lexer_url' => 'nullable|url',
            'report' => ''
        ]);

        $validatedImagePDF = request()->validate([
            'is_finished' => 'nullable',
            "listing" => 'nullable|image',
            'rules_pdf' => 'nullable|mimes:pdf|max:10000'
        ]);
        
        TournamentType::findOrFail($validatedTournament['type_id']);
        
        $year = intval($validatedTournament['start_season']);

        $validatedTournament['start_season'] = Carbon::createFromDate($year, 9, 1, 0, 0, 0);
        $validatedTournament['end_season'] = Carbon::createFromDate($year + 1, 8, 31, 0, 0, 0);

        if(isset($validatedImagePDF['is_finished'])){
            $validatedTournament['is_finished'] = 1;
        }
        else {
            $validatedTournament['is_finished'] = 0;
        }

        $tournament = Tournament::findOrFail($id);
        $tournament->update($validatedTournament);

        if(isset($validatedImagePDF['is_finished']) ){

            if(!isset($tournament->podium)){
                $podium = Podium::create(['tournament_id' => $tournament->id, 'date' => $tournament->date]);
            }
            else {
                $tournament->podium->date = $tournament->date;
                $tournament->podium->save();
                $podium = $tournament->podium;
            }
            $podium->slug = str_slug($tournament->title . ' ' . $podium->id, '-');
            $podium->save();
        }


        if($request->hasFile('rules_pdf')){
            if(!is_null($tournament->rules_pdf)){
                unlink(storage_path('app/public' . $tournament->rules_pdf));
            }
            $path = request()->file('rules_pdf')->store('public/upload/medias/tournaments/' . $tournament->id );
            $tournament->rules_pdf = substr($path, 6);
        }

        if($request->hasFile('listing')){
            if(!is_null($tournament->listing)){
                unlink(storage_path('app/public' . $tournament->listing));
            }
            $path = request()->file('listing')->store('public/upload/medias/tournaments/' . $tournament->id );
            $tournament->listing = substr($path, 6);
        }
        $tournament->slug = str_slug($tournament->title . ' ' . $tournament->id, '-');
        $tournament->save();
        $this->updateStatisticDate();
        
        session()->flash('notification_management_admin', 'Le tournoi a bien été modifié');

        return redirect('/administration/tournois');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tournament = Tournament::findOrFail($id);
        if($tournament->podium->count()) {
            if($tournament->podium->pictures->count()) {
                foreach($tournament->podium->pictures as $picture){
                    unlink(storage_path('app/public' . $picture->path));
                    $picture->delete();
                }
            }
            $tournament->podium->delete();
        }

        if($tournament->pictures->count()){
            foreach($tournament->pictures as $picture){
                unlink(storage_path('app/public' . $picture->path));
                $picture->delete();
            }
        }

        if($tournament->videos->count()){
            foreach($tournament->videos as $video){
                unlink(storage_path('app/public' . $video->path_mp4));
                unlink(storage_path('app/public' . $video->path_webm));
                $video->delete();
            }
        }

        $tournament->delete();
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'Le tournoi a bien été supprimé');
        return redirect('/administration/tournois');
    }

    public function editPlayers($id){
        $tournament = Tournament::with('members')->findOrFail($id);
        $playerTournament = $tournament->members()->get()->toArray();

        $members = Member::with('club')->get();
        foreach($members as &$member){
            $member->participate = false;
        }
        $members = $members->keyBy('id');

        foreach($tournament->members as $m){
            $members[$m->id]->participate = true;
        }
        
        return view('admin.tournaments.editPlayers', compact('tournament', 'members'));
    }

    public function updatePlayers(Request $request, $id){
        $tournament = Tournament::findOrFail($id);
        $tournament->members()->sync($request['checkBoxArray']);
        return redirect('/administration/tournois');
    }

    public function eventcalendar() {
        $tournaments = Tournament::all();

        $interator = 0;
        $calendarTournaments = [];
        foreach($tournaments as $tournament){
            $calendarTournaments[$interator] = array(
                    'id' => $tournament->id,
                    'title' => $tournament->title,
                    'start' => Carbon::parse($tournament->date)->format('Y-m-d'),
                    'end' => Carbon::parse($tournament->date)->addDay()->format('Y-m-d'),
                    'url' => route('tournois.show', $tournament->slug),
                    'allDay' => true
            );
            $interator++;
        }
        return response()->json($calendarTournaments);
    }

    public function showone($slug) {
        $title;
        $pagination = false;
        $futur = false;
        $tournaments = Tournament::with(['type', 'members' => function($query){
            $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');
        }])->where('slug', $slug)->get();
        switch ($tournaments->first()->type->id) {
            case 1:
                $title = "Tournois BC Ozoir";
                break;
            case 2:
                $title = "Tournois Privés";
                break;
            default:
                $title = "Championnats fédéraux";
        }

        if($tournaments->first()->date->gt(Carbon::now())){
            $futur = true;
        }

        return view('tournaments', compact('title', 'tournaments', 'pagination', 'futur'))->with($this->mainSharingFunctionality());
    }

    public function ozoirTournaments() {
        $title = "Tournois BC Ozoir";
        $pagination = true;
        $tournaments = Tournament::with(['members' => function($query){
            $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');
        }])->ozoirtournament()->paginate(6);

        return view('tournaments', compact('title', 'tournaments', 'pagination'))->with($this->mainSharingFunctionality());
    }

    public function privateTournaments() {
        $title = "Tournois Privés";
        $pagination = true;
        $tournaments = Tournament::with(['members' => function($query){
            $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');
        }])->privatetournament()->paginate(6);

        return view('tournaments', compact('title', 'tournaments', 'pagination'))->with($this->mainSharingFunctionality());
    }

    public function championships() {
        $title = "Championnats Fédéraux";
        $pagination = true;
        $tournaments = Tournament::with(['members' => function($query){
            $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');
        }])->championship()->paginate(6);

        return view('tournaments', compact('title', 'tournaments', 'pagination'))->with($this->mainSharingFunctionality());
    }

    public function tournamentlisting($slug) {
        $title = "Listing tournoi";

        $tournament = Tournament::where('slug', $slug)->first();
        if(!$tournament){
            abort(404);
        }

        return view('listing', compact('title', 'tournament'))->with($this->mainSharingFunctionality());
    }

    public function report($slug) {
        $title = "Compte-rendu";

        $tournament = Tournament::where('slug', $slug)->first();
        if(!$tournament){
            abort(404);
        }

        return view('report', compact('title', 'tournament'))->with($this->mainSharingFunctionality());
    }
    
    public function tournamentpictures($slug) {
        $title = "Photos tournoi";

        $tournament = Tournament::with('pictures')->where('slug', $slug)->first();
        if(!$tournament){
            abort(404);
        }

        $pictures = $tournament
                    ->pictures()
                    ->paginate(42);
        $allpictures = $tournament->pictures;

        return view('photos', compact('title', 'tournament', 'allpictures', 'pictures'))->with($this->mainSharingFunctionality());
    }

    public function tournamentvideos($slug) {
        $title = "Vidéos tournoi";
        
        $tournament = Tournament::with('videos')->where('slug', $slug)->first();
        if(!$tournament){
            abort(404);
        }

        $videos = $tournament->videos()->paginate(4);

        return view('videos', compact('title', 'tournament', 'videos'))->with($this->mainSharingFunctionality());
    }

    public function showpodiums() {
        $podiums = Podium::whereHas('pictures')
                            ->with('tournament')
                            ->orderBy('date', 'desc')->paginate(6);

        return view('podiums', compact('podiums'))->with($this->mainSharingFunctionality());
    }

    public function podiumpictures($slug) {
        $title = "Photos podium";

        $podium = Podium::with(['tournament', 'pictures'])->where('slug', $slug)->first();
        if(!$podium){
            abort(404);
        }

        $tournament = $podium->tournament;
        $allpictures = $podium->pictures()->orderBy('id', 'desc')->get();
        $pictures = $podium
                    ->pictures()
                    ->orderBy('id', 'desc')
                    ->paginate(42);


        return view('photos', compact('title', 'tournament', 'allpictures', 'pictures'))->with($this->mainSharingFunctionality());
    }

    public function archiveschoice() {
        return view('archiveschoice')->with($this->mainSharingFunctionality());
    }

    public function oldOzoirTournaments() {
        $title = "Archives Tournois BC Ozoir";
        $tournamentsByYear = Tournament::with(['members' => function($query){
            $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');
        }])->oldozoirtournament()->get()->groupBy(function($val){
            return Carbon::parse($val->date)->format('Y');
        });

        return view('archivestournaments', compact('title', 'tournamentsByYear'))->with($this->mainSharingFunctionality());
    }

    public function oldPrivateTournaments() {
        $title = "Archives Tournois Privés";
        $tournamentsByYear = Tournament::with(['members' => function($query){
            $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');
        }])->oldprivatetournament()->get()->groupBy(function($val){
            return Carbon::parse($val->date)->format('Y');
        });

        return view('archivestournaments', compact('title', 'tournamentsByYear'))->with($this->mainSharingFunctionality());
    }

    public function oldChampionships() {
        $title = "Archives Championnats Fédéraux";
        $tournamentsByYear = Tournament::with(['members' => function($query){
            $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');
        }])->oldchampionship()->get()->groupBy(function($val){
            return Carbon::parse($val->date)->format('Y');
        });

        return view('archivestournaments', compact('title', 'tournamentsByYear'))->with($this->mainSharingFunctionality());
    }
}
