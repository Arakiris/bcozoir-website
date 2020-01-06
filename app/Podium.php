<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Podium extends Model
{
    protected $fillable = ['tournament_id', 'date'];

    protected $dates = [
        'created_at',
        'updated_at',
        'date'
    ];


    /**
     * Get the tournament of the podium.
     */
     public function tournament()
     {
         return $this->belongsTo('App\Tournament');
     }

    /**
     * Get all of the picture's podiums.
    **/
    public function pictures() {
        return $this->morphMany('App\Picture', 'imageable');
    }

    /**
     * Get all of the teams for this podium.
     */
    public function teams(){
        return Team
            ::join('tournaments', 'teams.tournament_id', '=', 'tournaments.id')
            ->join('podia', 'podia.tournament_id', '=', 'tournaments.id')
            ->where('podia.id', $this->id);
    }

    /**
     * Get all podium order by date
     */
    public function scopeShowpodium($query) {
        return $query->join('tournaments', 'podia.tournament_id', '=', 'tournaments.id')->orderBy('podia.date', 'desc')->select('podia.*');
    }

    /**
     * Get podium of this season
     */
    public function scopeCurrentpodia($query){
        return $query->where([['is_ranking', '=', '1'], ['date', '>=', Carbon::create($this->yearSeason(), 9, 1, 0, 0, 0)], ['date', '<=', Carbon::now()]])->orderBy('date', 'desc');
    }

    /**
     * Get podium of old season
     */
    public function scopeOldpodia($query) {
        return $query->where([['is_ranking', '=', '1'], ['date', '<', Carbon::create($this->yearSeason(), 9, 1, 0, 0, 0)]])->orderBy('date', 'desc');
    }

    /**
     * Get podium by year
     */
    public function scopePreviousseason($query){
        return $query->where([['is_ranking', '=', '1'],  ['date', '>=', Carbon::create($this->yearSeason(), 1, 1, 0, 0, 0)], ['date', '<', Carbon::create($this->yearSeason(), 9, 1, 0, 0, 0)]])->orderBy('date', 'desc');
    }

    /**
     * Get podium by year
     */
    public function scopePodiayear($query, $year) {
        $now = Carbon::now();
        
        if($year == $now->year)
            $endDate = $now;
        else
            $endDate = Carbon::create(intval($year) + 1, 8, 31, 0, 0, 0);

        return $query->where([['is_ranking', '=', '1'], ['date', '>=', Carbon::create($year, 1, 1, 0, 0, 0)], ['date', '<=', $endDate]])->orderBy('date', 'desc');
    }
    


    /**
     * Get current year of this season
     */
    private function yearSeason() {
        $beginningSeason = Carbon::create(null, 9, 1);
        $now = Carbon::now();
        if($now->lt($beginningSeason)) {
            return $now->subYear()->year;
        }
        return  $now->year;
    }
}
