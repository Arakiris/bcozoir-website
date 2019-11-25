<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tournament extends Model
{
    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at', 'start_season',
                        'end_season', 'date'];


    /**
     * Get the type of the tournament.
     */
     public function type()
     {
         return $this->belongsTo('App\TournamentType');
     }

    /**
     * Get the podium of the tournament.
     */
     public function podium()
     {
         return $this->hasOne('App\Podium');
     }

    /**
     * The tournaments that belong to the member.
     */
     public function members()
     {
         return $this->belongsToMany(Member::class)->withPivot('rank');
     }

    /**
     * Get all of the picture's tournaments.
    **/
    public function pictures() {
        return $this->morphMany('App\Picture', 'imageable');
    }

    /**
     * Get all of the team's tournaments.
    **/
    public function teams() {
        return $this->hasMany(Team::class);
    }

    /**
     * Get all of the video's tournaments.
    **/
    public function videos() {
        return $this->morphMany('App\Video', 'videoable');
    }

    public function scopeOzoirfuturetournament($query) {
        return $query->where([['type_id', '=', 1], ['date', '>', Carbon::now()]])->orderBy('date', 'ASC');
    }

    public function scopeOtherfuturetournament($query) {
        return $query->where([['type_id', '<>', 1], ['date', '>', Carbon::now()]])->orderBy('date', 'ASC');
    }

    /**
     * BC Ozoir
     */
    public function scopeOzoirtournament($query) {
        return $query->where([['type_id', '=', 1], ['date', '>=', Carbon::create($this->yearSeason(), 9, 1, 0, 0, 0)], ['date', '<=', Carbon::now()]])->orderBy('date', 'desc');
    }

    public function scopeOldozoirtournament($query) {
        return $query->where([['type_id', '=', 1], ['date', '<', Carbon::create($this->yearSeason(), 9, 1, 0, 0, 0)]])->orderBy('date', 'desc');
    }

    /**
     * Private tournament
     */
    public function scopePrivatetournament($query) {
        return $query->where([['type_id', '=', 2], ['date', '>=', Carbon::create($this->yearSeason(), 9, 1, 0, 0, 0)], ['date', '<=', Carbon::now()]])->orderBy('date', 'desc');
    }

    public function scopeOldprivatetournament($query) {
        return $query->where([['type_id', '=', 2], ['date', '<', Carbon::create($this->yearSeason(), 9, 1, 0, 0, 0)]])->orderBy('date', 'desc');
    }

    /**
     * Championship
     */
    public function scopeChampionship($query) {
        return $query->where([['type_id', '=', 3], ['date', '>=', Carbon::create($this->yearSeason(), 9, 1, 0, 0, 0)], ['date', '<=', Carbon::now()]])->orderBy('date', 'desc');
    }

    public function scopeOldchampionship($query) {
        return $query->where([['type_id', '=', 3], ['date', '<', Carbon::create($this->yearSeason(), 9, 1, 0, 0, 0)]])->orderBy('date', 'desc');
    }

    /**
     * All of them
     */
    public function scopePreviousseason($query, $type){
        return $query->where([['type_id', '=', $type],  ['start_season', '>=', Carbon::create($this->yearSeason(), 1, 1, 0, 0, 0)], ['start_season', '<', Carbon::create($this->yearSeason(), 9, 1, 0, 0, 0)]])->orderBy('date', 'desc');
        // return $query->where([['type_id', '=', $type],  ['date', '>=', Carbon::create($this->yearSeason() - 1, 9, 1, 0, 0, 0)], ['date', '<', Carbon::create($this->yearSeason(), 9, 1, 0, 0, 0)]])->orderBy('date', 'desc');
    }

    public function scopeTournamentsyear($query, $type, $year) {
        $now = Carbon::now();
        
        if($year == $now->year)
            $endDate = $now;
        else
            $endDate = Carbon::create(intval($year), 10, 1, 0, 0, 0);

        return $query->where([['type_id', '=', $type], ['start_season', '>=', Carbon::create($year, 1, 1, 0, 0, 0)], ['start_season', '<', $endDate]])->orderBy('date', 'desc');
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
