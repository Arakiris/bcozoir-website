<?php

namespace App\Http\Controllers\Admin;

use App\Http\Traits\CommonTrait;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Http\Controllers\Controller;
use App\Tournament;
use App\Podium;
use App\TournamentType;
use App\Member;
use App\Team;

use App\Picture;

/**
 * Mainly for administration tournaments
 */
class TournamentsController extends Controller
{
    use CommonTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tournaments = Tournament::with('type')->orderBy('date', 'desc')->get();

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
            'type_id' => 'bail|required|numeric',
            'start_season' => 'bail|required|numeric|min:2000',
            'date' => 'bail|required|date',
            'title' => 'bail|required',
            'is_accredited' => 'bail|required|boolean',
            'is_rules_pdf' => 'bail|required|numeric',
            'rules_url' => 'bail|nullable|url',
            'place' => 'bail|required',
            'lexer_url' => 'bail|nullable|url',
            'report' => 'bail|nullable',
            'additional_information' => 'bail|nullable',
            'formation' => 'required|boolean'
        ]);

        $validatedPodium = request()->validate([
            'is_ranking' => 'required|boolean'
        ]);

        $validatedPDF = request()->validate([
            'is_finished' => 'bail|nullable',
            "listing" => 'bail|nullable|image',
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
            // $podium = Podium::create(['tournament_id' => $tournament->id, 'date' => $tournament->date ]);
            $podium = new Podium();
            $podium->tournament_id = $tournament->id;
            $podium->date = $tournament->date;
            $podium->slug = str_slug($tournament->title . ' ' . $podium->id, '-');
            $podium->is_ranking = $validatedPodium['is_ranking'];

            $tournament->podium()->save($podium);
        }

        if($validatedTournament['is_rules_pdf'] == 1){        
            if($file = $request->file('rules_pdf')){
                $path = request()->file('rules_pdf')->store('public/upload/images/tournaments/' . $tournament->id );
                $tournament->rules_pdf = substr($path, 6);
            }
        }

        if($request->hasFile('listing')){
            $path = request()->file('listing')->store('public/upload/medias/tournaments/' . $tournament->id );
            $tournament->listing = substr($path, 6);
        }
        $tournament->slug = str_slug($tournament->title . ' ' . $tournament->id, '-');
        $tournament->save();

        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'Le tournoi a bien été enregistré');

        switch($request->submitbutton){
            case 'save':
                return redirect('/administration/tournois'); 
                break;
            case 'saveAddTeams':
                return redirect()->action('Admin\TeamsController@create', ['idTournament' => $tournament->id]);
                break;
            case 'saveManagePlayers':
                return redirect()->action('Admin\TournamentsController@editPlayers', ['id' => $tournament->id]);
                break;
        }
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
        $tournament = Tournament::with(['type'])->findOrFail($id);
        $tournamentTypes = TournamentType::all();
        $teams = Team::with('members')->where('tournament_id', $id)->get();
        
        return view('admin.tournaments.edit', compact('tournament', 'teams', 'tournamentTypes'));
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
            'type_id' => 'bail|required|numeric',
            'start_season' => 'bail|required|numeric|min:2000',
            'date' => 'bail|required|date',
            'title' => 'bail|required',
            'is_accredited' => 'bail|required|boolean',
            'is_rules_pdf' => 'bail|required|numeric',
            'rules_url' => 'bail|nullable|url',
            'place' => 'bail|required',
            'lexer_url' => 'bail|nullable|url',
            'report' => 'bail|nullable',
            'additional_information' => 'bail|nullable',
            'formation' => 'required|boolean'
        ]);

        $validatedPodium = request()->validate([
            'is_ranking' => 'required|boolean'
        ]);

        $validatedImagePDF = request()->validate([
            'is_finished' => 'bail|nullable',
            "listing" => 'bail|nullable|image',
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
            $podium->is_ranking = $validatedPodium['is_ranking'];
            $podium->slug = str_slug($tournament->title . ' ' . $podium->id, '-');
            $podium->save();
        }

        if($validatedTournament['is_rules_pdf'] == 0 || $validatedTournament['is_rules_pdf'] == 2){    
            if(!is_null($tournament->rules_pdf)){
                unlink(storage_path('app/public' . $tournament->rules_pdf));
                $tournament->rules_pdf = null;
            }
        }
        elseif($validatedTournament['is_rules_pdf'] == 1){    
            if($request->hasFile('rules_pdf')){
                if(!is_null($tournament->rules_pdf)){
                    unlink(storage_path('app/public' . $tournament->rules_pdf));
                }
                $path = request()->file('rules_pdf')->store('public/upload/medias/tournaments/' . $tournament->id );
                $tournament->rules_pdf = substr($path, 6);
            }
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


        switch($request->submitbutton){
            case 'save':
                return redirect('/administration/tournois'); 
                break;
            case 'saveAddTeams':
                return redirect()->action('Admin\TeamsController@create', ['idTournament' => $tournament->id]);
                break;
            case 'saveManagePlayers':
                return redirect()->action('Admin\TournamentsController@editPlayers', ['id' => $tournament->id]);
                break;
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
        if(isset($tournament->podium) && $tournament->podium->count()) {
            if($tournament->podium->pictures->count()) {
                foreach($tournament->podium->pictures as $picture){
                    unlink(storage_path('app/public' . $picture->path));
                    $picture->delete();
                }
            }
            $tournament->podium->delete();
        }

        if(isset($tournament->pictures) && $tournament->pictures->count()){
            foreach($tournament->pictures as $picture){
                unlink(storage_path('app/public' . $picture->path));
                $picture->delete();
            }
        }

        if(isset($tournament->videos) && $tournament->videos->count()){
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

    /**
     * Edit players from tournament
     */
    public function editPlayers($id){
        $tournament = Tournament::with('members')->findOrFail($id);
        $members = Member::all();
        
        return view('admin.tournaments.editPlayers', compact('tournament', 'members'));
    }

    public function updatePlayers(Request $request, $id){
        $validatedmembers = request()->validate([
            'members.*.id' => 'nullable|numeric',
            'members.*.rank' => 'nullable|string'
        ]);

        $tournament = Tournament::findOrFail($id);
        if(isset($validatedmembers["members"])){
            $memberpick;
            foreach($validatedmembers["members"] as $member){
                $memberpick[$member['id']] = ['rank' => $member['rank']];
            }
            $tournament->members()->sync($memberpick);
        }
        else {
            $tournament->members()->detach();
        }

        $team = Team::where('tournament_id', '=', $id)->first();
        if($team) {
            $team->members()->detach();
        }
        
        session()->flash('notification_management_admin', 'Les membres ont bien été ajoutés au tournoi');
        return redirect()->route('admin.tournois.edit', [$id]);
    }
}
