<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Traits\CommonTrait;

use Carbon\Carbon;

use App\Member;
use App\League;

/**
 * Controller who manages leagues
 */
class LeaguesController extends Controller
{
    /** Common methods between controller */
    use CommonTrait;

    /**
     * Create a new LeaguesController instance.
     *
     * @return void
     */
     public function __construct()
     {
         $this->middleware('auth', ['except' => ['show', 'showall', 'archivesleagues']]);
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
            'result' => 'nullable|url'
        ]);
        
        $year = intval($validatedLeague['start_season']);

        $validatedLeague['start_season'] = Carbon::createFromDate($year, 9, 1, 0, 0, 0);
        $validatedLeague['end_season'] = Carbon::createFromDate($year + 1, 8, 31, 0, 0, 0);

        $ligue = League::create($validatedLeague);
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'Le ligue a bien été créé');

        return redirect('/administration/ligues');
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
            'result' => 'nullable|url'
        ]);
        
        $year = intval($validatedLeague['start_season']);

        $validatedLeague['start_season'] = Carbon::createFromDate($year, 9, 1, 0, 0, 0);
        $validatedLeague['end_season'] = Carbon::createFromDate($year + 1, 8, 31, 0, 0, 0);

        $league = League::findOrFail($id);
        $league->update($validatedLeague);
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'La ligue a bien été modifiée');

        return redirect('/administration/ligues');
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
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'La ligue a bien été supprimée');

        return redirect('/administration/ligues');
    }

    /**
     * Show the list of players of the specified league.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update players of the specified leagues in storage.
     *
     * @param Request $request
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePlayers(Request $request, $id){
        $league = League::findOrFail($id);
        $league->members()->sync($request['checkBoxArray']);
        $this->updateStatisticDate();

        return redirect('/administration/ligues');
    }

    /**
     * Show the all the leagues of this season
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showall() {
        $yearNow = $this->yearSeason();
        $title = 'Ligue ' . $yearNow . '-' . ($yearNow + 1);
        $leagues = League::with(['members' => function($query){
            $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');
        }])->presentleague()->paginate(6);

        return view('leagues', compact('leagues', 'title'))->with($this->mainSharingFunctionality());
    }

    /**
     * Show the all the leagues of previous season
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function archivesleagues() {
        $title = "Archives ligues";
        $leaguesByYear = League::archivesleagues()->get()->groupBy(function($val){
            return Carbon::parse($val->start_season)->format('Y');
        });
        /*
        $leaguesByYear = League::with(['members' => function($query){
            $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');
        }])->archivesleagues()->get()->groupBy(function($val){
            return Carbon::parse($val->start_season)->format('Y');
        });
        */

        return view('archivesleagues', compact('title', 'leaguesByYear'))->with($this->mainSharingFunctionality());
    }

    /**
     * Return the beginning of the year year of the current season
     *
     * @return int $year
     */
    private function yearSeason() {
        $beginningSeason = Carbon::create(null, 9, 1);
        $now = Carbon::now();
        if($now->lt($beginningSeason)) {
            return $now->subYear()->year;
        }
        return  $year = $now->year;
    }
}
