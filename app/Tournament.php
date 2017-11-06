<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tournament extends Model
{
    protected $guarded = ['id'];

    protected $dates = [
        'created_at',
        'updated_at',
        'date'
    ];


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
         return $this->belongsToMany(Member::class);
     }

    /**
     * Get all of the picture's tournaments.
    **/
    public function pictures() {
        return $this->morphMany('App\Picture', 'imageable');
    }

    /**
     * Get all of the video's tournaments.
    **/
    public function videos() {
        return $this->morphMany('App\Video', 'videoable');
    }

    public function scopeOzoirfuturetournament($query) {
        return $query->where([['type_id', '=', 1], ['date', '>', Carbon::now()]]);
    }

    public function scopeOtherfuturetournament($query) {
        return $query->where([['type_id', '<>', 1], ['date', '>', Carbon::now()]]);
    }

    public function scopeOzoirtournament($query) {
        return $query->where([['type_id', '=', 1], ['date', '>=', Carbon::createFromDate($this->yearSeason(), 9, 1)]])->orderBy('date', 'desc');
    }

    public function scopePrivatetournament($query) {
        return $query->where([['type_id', '=', 2], ['date', '>=', Carbon::createFromDate($this->yearSeason(), 9, 1)]])->orderBy('date', 'desc');
    }

    public function scopeChampionship($query) {
        return $query->where([['type_id', '=', 3], ['date', '>=', Carbon::createFromDate($this->yearSeason(), 9, 1)]])->orderBy('date', 'desc');
    }

    public function scopeOldozoirtournament($query) {
        return $query->where([['type_id', '=', 1], ['date', '<', Carbon::createFromDate($this->yearSeason(), 9, 1)]])->orderBy('date', 'desc');
    }

    public function scopeOldprivatetournament($query) {
        return $query->where([['type_id', '=', 2], ['date', '<', Carbon::createFromDate($this->yearSeason(), 9, 1)]])->orderBy('date', 'desc');
    }

    public function scopeOldchampionship($query) {
        return $query->where([['type_id', '=', 3], ['date', '<', Carbon::createFromDate($this->yearSeason(), 9, 1)]])->orderBy('date', 'desc');
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
