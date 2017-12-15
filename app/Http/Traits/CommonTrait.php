<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Session;

use App\Statistic;
use Carbon\Carbon;

use App\Warning;
use App\Tournament;
use App\Picture;
use App\Contact;
use App\Guest;

trait CommonTrait {

    public function guestInformation() {
        $ip = \Request::ip();
        $guest = Guest::where('guest_ip', $ip)->first();
        $now = Carbon::now();
        if(!$guest){
            $guest = new Guest;
            $guest->guest_ip = $ip;
            
            $this->updateStat();
        }
        else {
            $before = $now->subMinutes(20);
            if($guest->last_activity->lte($before)){
                $this->updateStat();
            }
        }
        $guest->last_activity = Carbon::now();
        $guest->save();
    }

    public function updateStatisticDate() {
        $stat = Statistic::firstOrCreate(['id' => 1]);

        $stat->last_update = Carbon::now();
        $stat->save();
    }

    public function mainSharingFunctionality() {
        $randompictures = Picture::firstsrandompicture()->get();
        $warnings = Warning::showwarning()->get();
        $ozoirTounaments = Tournament::ozoirfuturetournament()->get();
        $otherTournaments = Tournament::otherfuturetournament()->get();
        // $onlineguest = Guest::onlineguest();
        // $stat =  Statistic::first();
		return array('randompictures' => $randompictures, 'warnings' => $warnings, 'ozoirTounaments' => $ozoirTounaments, 'otherTournaments' => $otherTournaments);
    }

    private function updateStat() {
        $stat = Statistic::first();
        $stat->daily_visits += 1;
        $stat->month_visits += 1;
        $stat->since_creation_visits += 1;
        $stat->save();
    }

}