<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Tournament;
use App\Podium;
use App\TournamentType;
use App\Member;

class TournamentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
         $this->middleware('auth');
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
        Podium::create(['tournament_id' => $tournament->id]);

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

        if($request->hasFile('rules_pdf')){
            if(is_null($tournament->rules_pdf)){
                unlink(storage_path('app/public' . $tournament->rules_pdf));
            }
            $path = request()->file('rules_pdf')->store('public/upload/medias/tournaments/' . $tournament->id );
            $tournament->rules_pdf = substr($path, 6);
        }

        if($request->hasFile('listing')){
            if(is_null($tournament->listing)){
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
}
