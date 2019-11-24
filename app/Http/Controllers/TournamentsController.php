<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonTrait;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Tournament;
use App\Podium;
use App\TournamentType;
use App\Team;
use App\Member;

use App\Picture;

/**
 * Mainly for administration tournaments
 */
class TournamentsController extends Controller
{
    use CommonTrait;

    /**
     * Api for the javascript calendar
     */
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

    /**
     * Api for javascript ranking podia
     */
    public function rankingYear(Request $request){
        $validatedYear = $request->validate(['id' => 'required|numeric']);
        $year = $validatedYear['id'];

        $rankingYear = Podium::with(['tournament',
                                        'tournament.teams' => function($query){ $query->orderBy('order_display', 'asc');},
                                        'tournament.teams.members',
                                        'tournament.teams.members.picture',
                                        'tournament.teams.members.club' => function($query){ $query->select(['id','name']); },
                                        'tournament.teams.members.category' => function($query){ $query->select(['id','title']);},
                                        'tournament.members' => function($query){ $query->orderBy('order_display', 'asc');},
                                        'tournament.members.picture',
                                        'tournament.members.club' => function($query){ $query->select(['id','name']); },
                                        'tournament.members.category' => function($query){ $query->select(['id','title']);}
                                    ])->podiayear($year)->get();

        return $rankingYear->toJson();
    }

    /**
     * Api for javascript bc oczoir tournament by selecting year
     */
    public function bcOzoirYear(Request $request){
        $validatedYear = $request->validate(['id' => 'required|numeric']);
        $year = $validatedYear['id'];

        $TournamentsYear = Tournament::with(['members' => function($query){ $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');},
                                             'members.picture',
                                             'members.club' => function($query){ $query->select(['id','name']); },
                                             'members.category' => function($query){ $query->select(['id','title']);},
                                             'teams' => function($query){ $query->orderBy("name", 'asc');},
                                             'teams.members.picture',
                                             'teams.members.club' => function($query){ $query->select(['id','name']); },
                                             'teams.members.category' => function($query){ $query->select(['id','title']);},
                                             ])
                                        ->tournamentsyear(1, $year)->get();

        return $TournamentsYear->toJson();
    }

    /**
     * Api for javascript bc private tournament by selecting year
     */
    public function privateYear(Request $request){
        $validatedYear = $request->validate(['id' => 'required|numeric']);
        $year = $validatedYear['id'];

        $TournamentsYear = Tournament::with(['members' => function($query){ $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');},
                                             'members.picture',
                                             'members.club' => function($query){ $query->select(['id','name']); },
                                             'members.category' => function($query){ $query->select(['id','title']);},
                                             'teams' => function($query){ $query->orderBy("name", 'asc');},
                                             'teams.members.picture',
                                             'teams.members.club' => function($query){ $query->select(['id','name']); },
                                             'teams.members.category' => function($query){ $query->select(['id','title']);},
                                             ])
                                        ->tournamentsyear(2, $year)->get();

        return $TournamentsYear->toJson();
    }

        /**
     * Api for javascript bc championship by selecting year
     */
    public function championshipYear(Request $request){
        $validatedYear = $request->validate(['id' => 'required|numeric']);
        $year = $validatedYear['id'];

        $TournamentsYear = Tournament::with(['members' => function($query){ $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');},
                                             'members.picture',
                                             'members.club' => function($query){ $query->select(['id','name']); },
                                             'members.category' => function($query){ $query->select(['id','title']);},
                                             'teams' => function($query){ $query->orderBy("name", 'asc');},
                                             'teams.members.picture',
                                             'teams.members.club' => function($query){ $query->select(['id','name']); },
                                             'teams.members.category' => function($query){ $query->select(['id','title']);},
                                             ])
                                        ->tournamentsyear(3, $year)->get();

        return $TournamentsYear->toJson();
    }

    /**
     * Select one tournament in main website
     */
    public function showone($slug) {
        $title;
        $pagination = false;
        $futur = false;
        $tournaments = Tournament::with(['type',
                                         'members' => function($query){ $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');},
                                         'teams' => function($query){ $query->orderBy("name", 'asc');},
                                         'teams.members' => function($query){ $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');}])
                                    ->where('slug', $slug)->get();
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

    /**
     * Select tournaments from type ozoir
     */
    public function ozoirTournaments() {
        $title = "Tournois BC Ozoir";
        $pagination = true;
        $futur = false;
        $tournaments = Tournament::with(['members' => function($query){ $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');},
                                         'teams' => function($query){ $query->orderBy("name", 'asc');},
                                         'teams.members' => function($query){ $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');} ])
                                    ->ozoirtournament()->paginate(6);

        return view('tournaments', compact('title', 'tournaments', 'pagination', 'futur'))->with($this->mainSharingFunctionality());
    }

    /**
     * Select tournaments from type private
     */
    public function privateTournaments() {
        $title = "Tournois Privés";
        $pagination = true;
        $futur = false;
        $tournaments = Tournament::with(['members' => function($query){ $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');},
                                         'teams' => function($query){ $query->orderBy("name", 'asc');},
                                         'teams.members' => function($query){ $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');}])
                                    ->privatetournament()->paginate(6);

        return view('tournaments', compact('title', 'tournaments', 'pagination', 'futur'))->with($this->mainSharingFunctionality());
    }

    /**
     * Select tournaments from type championships
     */
    public function championships() {
        $title = "Championnats Fédéraux";
        $pagination = true;
        $futur = false;
        $tournaments = Tournament::with(['members' => function($query){ $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');},
                                         'teams' => function($query){ $query->orderBy("name", 'asc');},
                                         'teams.members' => function($query){ $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');}])
                                    ->championship()->paginate(6);

        return view('tournaments', compact('title', 'tournaments', 'pagination', 'futur'))->with($this->mainSharingFunctionality());
    }

    /**
     * Give listing of the tournament
     */
    public function tournamentlisting($slug) {
        $title = "Listing tournoi";

        $tournament = Tournament::where('slug', $slug)->first();
        if(!$tournament){
            abort(404);
        }

        return view('listing', compact('title', 'tournament'))->with($this->mainSharingFunctionality());
    }

    /**
     * Give the report of the tournament
     */
    public function report($slug) {
        $title = "Compte-rendu";

        $tournament = Tournament::where('slug', $slug)->first();
        if(!$tournament){
            abort(404);
        }

        return view('report', compact('title', 'tournament'))->with($this->mainSharingFunctionality());
    }
    
    /**
     * Galery of picture of the tournament
     */
    public function tournamentpictures($slug) {
        $title = "Photos tournoi";

        $tournament = Tournament::with(['pictures' => function($query) { $query->orderby('created_at', 'asc'); }])->where('slug', $slug)->first();

        if(!$tournament){
            abort(404);
        }

        $pictures = $tournament->pictures()->get();
                    // ->paginate(42);
        $allpictures = $tournament->pictures;

        return view('photos', compact('title', 'tournament', 'allpictures', 'pictures'))->with($this->mainSharingFunctionality());
    }

    /**
     * Galery of video of the tournament
     */
    public function tournamentvideos($slug) {
        $title = "Vidéos tournoi";
        
        $tournament = Tournament::with('videos')->where('slug', $slug)->first();
        if(!$tournament){
            abort(404);
        }

        // $videos = $tournament->videos()->paginate(4);
        $videos = $tournament->videos()->get();

        return view('videos', compact('title', 'tournament', 'videos'))->with($this->mainSharingFunctionality());
    }

    /**
     * Select podium of the tournament
     */
    public function showpodiums() {
        $podiums = Podium::whereHas('pictures')
                            ->with('tournament')
                            ->orderBy('date', 'desc')->paginate(6);

        return view('podiums', compact('podiums'))->with($this->mainSharingFunctionality());
    }

    /**
     * Galery of picture of the podium
     */
    public function podiumpictures($slug) {
        $title = "Photos podium";

        $podium = Podium::with(['tournament', 'pictures' => function($query) { $query->orderby('created_at', 'asc'); }])
                            ->where('slug', $slug)->first();
        
        if(!$podium){
            abort(404);
        }

        $tournament = $podium->tournament;
        $allpictures = $podium->pictures()->orderBy('id', 'desc')->get();
        $pictures = $podium
                    ->pictures()
                    ->orderBy('id', 'desc')
                    ->get();


        return view('photos', compact('title', 'tournament', 'allpictures', 'pictures'))->with($this->mainSharingFunctionality());
    }

    /**
     * Choose archives
     */
    public function archiveschoice() {
        return view('archiveschoice')->with($this->mainSharingFunctionality());
    }

    /**
     * Old tournament from Ozoir
     */
    public function oldOzoirTournaments() {
        $title = "Archives Tournois BC Ozoir";
        $years = Tournament::selectRaw("YEAR(date) as year")
                                ->where('type_id', '=', 1)
                                ->where('date', '<', Carbon::create($this->yearSeason(), 9, 1, 0, 0, 0))
                                ->distinct()
                                ->orderBy('date', 'desc')->get();

        if(!$years->isEmpty()){
        $lastYear = $years->shift()->year;
            if($lastYear == $this->yearSeason())
                $tournaments = Tournament::previousseason(1)->get();
            else
                $tournaments = Tournament::tournamentsyear(1 ,$lastYear)->get();
        }
        else {
            $leagues = null;
        }

        $type = 1;

        return view('archivestournaments', compact('title', 'tournaments', 'years', 'type'))->with($this->mainSharingFunctionality());
    }

    /**
     * Old private tournament
     */
    public function oldPrivateTournaments() {
        $title = "Archives Tournois Privés";
        $years = Tournament::selectRaw("YEAR(date) as year")
                        ->where('type_id', '=', 2)
                        ->where('date', '<', Carbon::create($this->yearSeason(), 9, 1, 0, 0, 0))
                        ->distinct()
                        ->orderBy('date', 'desc')->get();

        if(!$years->isEmpty()){
        $lastYear = $years->shift()->year;
            if($lastYear == $this->yearSeason())
                $tournaments = Tournament::previousseason(2)->get();
            else
                $tournaments = Tournament::tournamentsyear(2 ,$lastYear)->get();
        }
        else {
            $leagues = null;
        }

        $type = 2;

        return view('archivestournaments', compact('title', 'tournaments', 'years', 'type'))->with($this->mainSharingFunctionality());
    }

    /**
     * Old championships tournament
     */
    public function oldChampionships() {
        $title = "Archives Championnats Fédéraux";
        $years = Tournament::selectRaw("YEAR(date) as year")
                ->where('type_id', '=', 3)
                ->where('date', '<', Carbon::create($this->yearSeason(), 9, 1, 0, 0, 0))
                ->distinct()
                ->orderBy('date', 'desc')->get();

        if(!$years->isEmpty()){
        $lastYear = $years->shift()->year;
            if($lastYear == $this->yearSeason())
                $tournaments = Tournament::previousseason(3)->get();
            else
                $tournaments = Tournament::tournamentsyear(3 ,$lastYear)->get();
        }
        else {
            $leagues = null;
        }

        $type = 3;

        return view('archivestournaments', compact('title', 'tournaments', 'years', 'type'))->with($this->mainSharingFunctionality());
    }

    /**
     * Ranking of podia if they exists
     */
    public function rankingPodia(){
        $podia = Podium::with(['tournament.teams' => function($query){ $query->orderBy('order_display', 'asc');},
                               'tournament.teams.members',
                               'tournament.members' => function($query){ $query->orderBy('order_display', 'asc');}
                               ])->currentpodia()->paginate(8);

        return view('rankingpodia', compact('podia'))->with($this->mainSharingFunctionality());
    }

    /**
     * Old ranking of podia if they exists
     */
    public function oldRankingPodia(){
        $years = Podium::selectRaw("YEAR(date) as year")
                            ->where('is_ranking', '=', '1')
                            ->where('date', '<', Carbon::create($this->yearSeason(), 9, 1, 0, 0, 0))
                            ->distinct()
                            ->orderBy('date', 'desc')->get();
        
        if(!$years->isEmpty()){
            $lastYear = $years->shift()->year;

            if($lastYear == $this->yearSeason()){
                $podia = Podium::with(['tournament',
                                        'tournament.teams' => function($query){ $query->orderBy('order_display', 'asc');},
                                        'tournament.teams.members',
                                        'tournament.members' => function($query){ $query->orderBy('order_display', 'asc');}
                                    ])->previousseason()->get();
            }
            else{
                $podia = Podium::with(['tournament',
                                                'tournament.teams' => function($query){ $query->orderBy('order_display', 'asc');},
                                                'tournament.teams.members',
                                                'tournament.members' => function($query){ $query->orderBy('order_display', 'asc');}
                                            ])->podiayear($lastYear)->get();
            }
        }
        else {
            $podia = null;
        }

        return view('archivesrankingpodia', compact('podia', 'years'))->with($this->mainSharingFunctionality());
    }

    private function yearSeason() {
        $beginningSeason = Carbon::create(null, 9, 1);
        $now = Carbon::now();
        if($now->lt($beginningSeason)) {
            return $now->subYear()->year;
        }
        return  $year = $now->year;
    }
}
