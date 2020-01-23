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
use App\Partner;
use App\ContentInformation;

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

    private function updateStat() {
        $stat = Statistic::first();
        $stat->daily_visits += 1;
        $stat->month_visits += 1;
        $stat->since_creation_visits += 1;
        $stat->save();
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