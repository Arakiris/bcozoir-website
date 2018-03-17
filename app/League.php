<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class League extends Model
{
    protected $fillable = ['name', 'start_season', 'end_season', 'day_of_week', 'is_accredited', 
    'place', 'team_name', 'result'];

    /**
     * The leagues that belong to the member.
     */
    public function Members()
    {
        return $this->belongsToMany(Member::class);
    }

    public function scopePresentleague($query){

        return $query->where('start_season', '>=', Carbon::create($this->yearSeason(), 9, 1, 0, 0, 0))->orderBy('place', 'asc')->orderBy('team_name', 'asc');
    }

    public function scopeArchivesleagues($query) {
        return $query->where('start_season', '<', Carbon::create($this->yearSeason(), 9, 1, 0, 0, 0))->orderBy('start_season', 'desc');
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
