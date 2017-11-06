<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Tournament;
use App\Podium;
use App\TournamentType;
use App\Member;

use App\Warning;
use App\Picture;


class TournamentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
         $this->middleware('auth', ['except' => ['show', 'eventcalendar', 'ozoirTournaments',
         'privateTournaments', 'championships', 'report', 'tournamentpictures', 'tournamentvideos'
         , 'tournamentlisting' , 'showpodiums', 'oldOzoirTournaments', 'oldPrivateTournaments', 'oldChampionships']]);
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

        if(isset($validatedImagePDF['is_finished'])){
            $validatedTournament['is_finished'] = 1;
        }

        $tournament = Tournament::create($validatedTournament);

        if(isset($validatedPDF['is_finished'])){
            Podium::create(['tournament_id' => $tournament->id, 'date' => $tournament->date ]);
        }
        

        if($file = $request->file('rules_pdf')){
            $path = request()->file('rules_pdf')->store('public/upload/images/tournaments/' . $tournament->id );
            $tournament->rules_pdf = substr($path, 6);

            $tournament->save();
        }

        return redirect('/admin/tournois');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title;
        $pagination = false;
        $tournaments = Tournament::with('type')->where('id', $id)->get();
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
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
        $randompictures = Picture::firstsrandompicture()->get();

        return view('tournaments', compact('title', 'tournaments', 'warnings', 'ozoirTounaments', 'otherTournaments', 'pagination', 'randompictures'));
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

        $tournament = Tournament::findOrFail($id);
        $tournament->update($validatedTournament);

        if(isset($validatedImagePDF['is_finished']) ){
            if(!isset($tournament->podium)){
                Podium::create(['tournament_id' => $tournament->id, 'date' => $tournament->date]);
            }
            else {
                $tournament->podium->date = $tournament->date;
                $tournament->podium->save();
            }
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
        $tournament->save();

        if($request->submitbutton == 'save'){
            return redirect('/admin/tournois');
        }
        else {
            $type = 'tournoi';
            $data = $tournament;
            return view('admin.pictures.create', compact('type', 'data'));
        }
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
        $tournament->delete();
        session()->flash('notification_management_admin', 'Le tournoi a bien été supprimé');
        return redirect('/admin/tournois');
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
        return redirect('/admin/tournois');
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
                    'url' => route('tournois.show', $tournament->id),
                    'allDay' => true
            );
            $interator++;
        }
        return response()->json($calendarTournaments);
    }

    public function ozoirTournaments() {
        $title = "Tournois BC Ozoir";
        $pagination = true;
        $tournaments = Tournament::ozoirtournament()->paginate(6);
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
        $randompictures = Picture::firstsrandompicture()->get();

        return view('tournaments', compact('title', 'tournaments', 'warnings', 'ozoirTounaments', 'otherTournaments', 'pagination', 'randompictures'));
    }

    public function privateTournaments() {
        $title = "Tournois Privés";
        $pagination = true;
        $tournaments = Tournament::privatetournament()->paginate(6);
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
        $randompictures = Picture::firstsrandompicture()->get();

        return view('tournaments', compact('title', 'tournaments', 'warnings', 'ozoirTounaments', 'otherTournaments', 'pagination', 'randompictures'));
    }

    public function championships() {
        $title = "Championnats Fédéraux";
        $pagination = true;
        $tournaments = Tournament::championship()->paginate(6);
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
        $randompictures = Picture::firstsrandompicture()->get();

        return view('tournaments', compact('title', 'tournaments', 'warnings', 'ozoirTounaments', 'otherTournaments', 'pagination', 'randompictures'));
    }

    public function tournamentlisting($id) {
        $title = "Listing tournoi";
        $tournament = Tournament::findOrFail($id);
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
        $randompictures = Picture::firstsrandompicture()->get();

        return view('listing', compact('title', 'tournament', 'warnings', 'ozoirTounaments', 'otherTournaments', 'randompictures'));
    }

    public function report($id) {
        $title = "Résultat du tournoi";
        $tournament = Tournament::findOrFail($id);
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
        $randompictures = Picture::firstsrandompicture()->get();

        return view('report', compact('title', 'tournament', 'warnings', 'ozoirTounaments', 'otherTournaments', 'randompictures'));
    }
    
    public function tournamentpictures($id) {
        $title = "Photos tournoi";
        $tournament = Tournament::with('pictures')->findOrFail($id);
        $pictures = $tournament->pictures()->paginate(30);
        $allpictures = $tournament->pictures;
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
        $randompictures = Picture::firstsrandompicture()->get();

        return view('photos', compact('title', 'tournament', 'allpictures','pictures', 'warnings', 'ozoirTounaments', 'otherTournaments', 'randompictures'));
    }

    public function tournamentvideos($id) {
        $title = "Videos tournoi";
        $tournament = Tournament::with('videos')->findOrFail($id);
        $videos = $tournament->videos()->paginate(4);
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
        $randompictures = Picture::firstsrandompicture()->get();

        return view('videos', compact('title', 'tournament','videos', 'warnings', 'ozoirTounaments', 'otherTournaments', 'randompictures'));
    }

    public function showpodiums() {
        $podiums = Podium::with('tournament')->orderBy('date', 'desc')->paginate(6);
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
        $randompictures = Picture::firstsrandompicture()->get();

        return view('podiums', compact('podiums', 'warnings', 'ozoirTounaments', 'otherTournaments', 'randompictures'));
    }

    public function podiumpictures ($id) {
        $title = "Photos podium";
        $podium = Podium::with(['tournament', 'pictures'])->findOrFail($id);
        $tournament = $podium->tournament;
        $pictures = $podium->pictures()->paginate(30);
        $allpictures = $podium->pictures;
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
        $randompictures = Picture::firstsrandompicture()->get();

        return view('photos', compact('title', 'tournament', 'allpictures','pictures', 'warnings', 'ozoirTounaments', 'otherTournaments', 'randompictures'));
    }

    public function oldOzoirTournaments() {
        $title = "Archives Tournois BC Ozoir";
        $tournamentsByYear = Tournament::oldozoirtournament()->get()->groupBy(function($val){
            return Carbon::parse($val->date)->format('Y');
        });
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
        $randompictures = Picture::firstsrandompicture()->get();

        return view('archivestournaments', compact('title', 'tournamentsByYear', 'warnings', 'ozoirTounaments', 'otherTournaments', 'randompictures'));
    }

    public function oldPrivateTournaments() {
        $title = "Archives Tournois Privés";
        $tournamentsByYear = Tournament::oldprivatetournament()->get()->groupBy(function($val){
            return Carbon::parse($val->date)->format('Y');
        });
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
        $randompictures = Picture::firstsrandompicture()->get();

        return view('archivestournaments', compact('title', 'tournamentsByYear', 'warnings', 'ozoirTounaments', 'otherTournaments', 'randompictures'));
    }

    public function oldChampionships() {
        $title = "Archives Championnats Fédéraux";
        $tournamentsByYear = Tournament::oldchampionship()->get()->groupBy(function($val){
            return Carbon::parse($val->date)->format('Y');
        });
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
        $randompictures = Picture::firstsrandompicture()->get();

        return view('archivestournaments', compact('title', 'tournamentsByYear', 'warnings', 'ozoirTounaments', 'otherTournaments', 'randompictures'));
    }


}
