<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Member;
use App\League;

use App\Advert;
use App\Warning;
use App\Picture;
use App\Tournament;


class LeaguesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
         $this->middleware('auth', ['except' => ['show', 'showall']]);
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leagues = League::all();
        return view('admin.leagues.index', compact('leagues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.leagues.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedLeague = request()->validate([
            'name' => 'required',
            'start_season' => 'required|numeric|min:2000',
            'day_of_week' => 'required',
            'is_accredited' => 'required|boolean',
            'place' => 'required',
            'team_name' => 'required',
            'result' => 'required|url'
        ]);
        
        $year = intval($validatedLeague['start_season']);

        $validatedLeague['start_season'] = Carbon::createFromDate($year, 9, 1, 0, 0, 0);
        $validatedLeague['end_season'] = Carbon::createFromDate($year + 1, 8, 31, 0, 0, 0);

        $ligue = League::create($validatedLeague);

        session()->flash('notification_management_admin', 'Le ligue a bien été créé');

        return redirect('/admin/ligues');
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
        $league = League::findOrFail($id);
        return view('admin.leagues.edit', compact('league'));
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
        $validatedLeague = request()->validate([
            'name' => 'required',
            'start_season' => 'required|numeric|min:2000',
            'day_of_week' => 'required',
            'is_accredited' => 'required|boolean',
            'place' => 'required',
            'team_name' => 'required',
            'result' => 'required|url'
        ]);
        
        $year = intval($validatedLeague['start_season']);

        $validatedLeague['start_season'] = Carbon::createFromDate($year, 9, 1, 0, 0, 0);
        $validatedLeague['end_season'] = Carbon::createFromDate($year + 1, 8, 31, 0, 0, 0);

        $league = League::findOrFail($id);
        $league->update($validatedLeague);

        session()->flash('notification_management_admin', 'Le ligue a bien été mise-à-jour');

        return redirect('/admin/ligues');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $league = League::findOrFail($id);
        $league->delete();
        session()->flash('notification_management_admin', 'La ligue a bien été supprimée');
        return redirect('/admin/ligues');
    }

    public function editPlayers($id){
        $league = League::with('members')->findOrFail($id);
        $playerLeague = $league->members()->get()->toArray();

        $members = Member::with('club')->get();
        foreach($members as &$member){
            $member->participate = false;
        }
        $members = $members->keyBy('id');

        foreach($league->members as $m){
            $members[$m->id]->participate = true;
        }
        
        return view('admin.leagues.editPlayers', compact('league', 'members'));
    }

    public function updatePlayers(Request $request, $id){
        $league = League::findOrFail($id);
        $league->members()->sync($request['checkBoxArray']);
        return redirect('/admin/ligues');
    }

    public function showall() {
        $leagues = League::paginate(6);
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
        $randompictures = Picture::firstsrandompicture()->get();

        return view('leagues', compact('leagues', 'warnings', 'ozoirTounaments', 'otherTournaments', 'randompictures'));
    }

    public function archivesleagues() {
        $title = "Archives des ligues BC Ozoir";
        $leaguesByYear = League::archivesleagues()->get()->groupBy(function($val){
            return Carbon::parse($val->start_season)->format('Y');
        });
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
        $randompictures = Picture::firstsrandompicture()->get();

        return view('archivesleagues', compact('title', 'leaguesByYear', 'warnings', 'ozoirTounaments', 'otherTournaments', 'randompictures'));
    }
}
