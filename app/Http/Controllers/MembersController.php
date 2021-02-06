<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonTrait;

use Illuminate\Http\Request;

use App\Member;
use App\Tournament;
use App\Club;
use App\Category;
use App\Picture;

use Carbon\Carbon;


class MembersController extends Controller
{
    use CommonTrait;

    public function showall() {
        $members = Member::with(['category', 'club', 'picture', 'score'])->getmembers()->get();

        return view('members', compact('members'));
    }

    public function tournamentAndPrize($id){
        $member = Member::findOrFail($id);
        // $yearsBefore = Carbon::now()->subYears(5);

        // $tournaments1 = Tournament::join('member_tournament', 'tournaments.id', '=', 'member_tournament.tournament_id')
        //                             ->join('members', 'member_tournament.member_id', '=', 'members.id')
        //                             ->where('members.id', '=', $id)
        //                             ->whereDate('tournaments.date', '>', $yearsBefore)
        //                             ->select('tournaments.*', 'members.id as memberID', 'members.first_name', 'members.last_name', 'member_tournament.rank');

        // $tournaments = Tournament::join('teams', 'tournaments.id', '=', 'teams.tournament_id')
        //                             ->join('member_team', 'teams.id', '=', 'member_team.team_id')
        //                             ->join('members', 'member_team.member_id', '=', 'members.id')
        //                             ->where('members.id', '=', $id)
        //                             ->whereDate('tournaments.date', '>', $yearsBefore)
        //                             ->select('tournaments.*', 'members.id as memberID', 'members.first_name', 'members.last_name', 'member_team.rank')
        //                             ->union($tournaments1)
        //                             ->orderBy('date', 'desc')
        //                             ->with('type')
        //                             ->get();

        $tournaments = Tournament::join('teams', 'tournaments.id', '=', 'teams.tournament_id')
                                    ->join('member_team', 'teams.id', '=', 'member_team.team_id')
                                    ->join('members', 'member_team.member_id', '=', 'members.id')
                                    ->where('members.id', '=', $id)
                                    ->select('tournaments.*', 'members.id as memberID', 'members.first_name', 'members.last_name', 'member_team.rank')
                                    ->orderBy('date', 'desc')
                                    ->with('type')
                                    ->get();

        return view('membertournaments', compact('member', 'tournaments'));
    } 
}
