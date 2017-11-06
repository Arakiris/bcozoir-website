<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advert;
use App\Warning;
use App\Tournament;
use App\Picture;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index(){
        $ads = Advert::showad()->get();
        $randompictures = Picture::firstsrandompicture()->get();
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
		return view('welcome', compact('ads', 'randompictures', 'warnings', 'ozoirTounaments', 'otherTournaments'));
	}

	public function version(){
        $randompictures = Picture::firstsrandompicture()->get();
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
		return view('version', compact('randompictures', 'warnings', 'ozoirTounaments', 'otherTournaments'));
	}

	public function generalconditions(){
        $randompictures = Picture::firstsrandompicture()->get();
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
		return view('generalconditions', compact('randompictures', 'warnings', 'ozoirTounaments', 'otherTournaments'));
	}

	public function proposal(){
        $randompictures = Picture::firstsrandompicture()->get();
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
		return view('proposal', compact('randompictures', 'warnings', 'ozoirTounaments', 'otherTournaments'));
	}

	public function map(){
        $randompictures = Picture::firstsrandompicture()->get();
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
		return view('map', compact('randompictures', 'warnings', 'ozoirTounaments', 'otherTournaments'));
    }

    public function bcozoir() {
        $randompictures = Picture::firstsrandompicture()->get();
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
		return view('bcozoir', compact('randompictures', 'warnings', 'ozoirTounaments', 'otherTournaments'));
    }
    
    public function office() {
        $randompictures = Picture::firstsrandompicture()->get();
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
		return view('office', compact('randompictures', 'warnings', 'ozoirTounaments', 'otherTournaments'));
    }

    public function addresses() {
        $randompictures = Picture::firstsrandompicture()->get();
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
		return view('addresses', compact('randompictures', 'warnings', 'ozoirTounaments', 'otherTournaments'));
    }

    public function contact() {
        $randompictures = Picture::firstsrandompicture()->get();
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
		return view('contact', compact('randompictures', 'warnings', 'ozoirTounaments', 'otherTournaments'));
    }

    public function sendmail(request $request) {
        $beginningSeason = Carbon::create(null, 9, 1);
        $now = Carbon::create(2017, 7, 1);
        if($now->lt($beginningSeason)) {
            $year = $now->subYear()->year;
        }
        elseif($now->gte($beginningSeason)){
            $year = $now->year;
        }
        dd($year);
        return redirect('contact');
    }
}