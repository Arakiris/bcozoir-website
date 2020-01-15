<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Traits\CommonTrait;

use Carbon\Carbon;

use App\Member;
use App\League;

class LeaguesController extends Controller
{
    use CommonTrait;

    /**
     * Api for javascript leagues
     */
    public function leaguesYear(Request $request){
        $validatedYear = $request->validate(['id' => 'required|numeric']);
        $year = $validatedYear['id'];

        $leaguesYear = League::leaguesyear($year)->get();

        return $leaguesYear->toJson();
    }

    public function showall() {
        $yearNow = $this->yearSeason();
        $title = 'Ligue ' . $yearNow . '-' . ($yearNow + 1);
        $leagues = League::with(['members' => function($query){
            $query->orderBy('last_name', 'asc')->orderBy('first_name', 'asc');
        }])->presentleague()->paginate(6);

        return view('leagues', compact('leagues', 'title'))->with($this->mainSharingFunctionality());
    }


    public function archivesleagues() {
        $years = League::selectRaw("YEAR(start_season) as year")
                            ->where('start_season', '<', Carbon::create($this->yearSeason(), 9, 1, 0, 0, 0))
                            ->distinct()
                            ->orderBy('start_season', 'desc')->get();
        
        if(!$years->isEmpty()){
            $lastYear = $years->shift()->year;

            if($lastYear == $this->yearSeason())
                $leagues = League::previousseason()->get();
            else
                $leagues = League::leaguesyear($lastYear)->get();
        }
        else {
            $leagues = null;
        }

        $title = "Archives ligues";

        return view('archivesleagues', compact('title', 'leagues', 'years'))->with($this->mainSharingFunctionality());
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
