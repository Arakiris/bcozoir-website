<?php

namespace App;

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

    public function scopeShowpodium($query) {
        return $query->join('tournaments', 'podia.tournament_id', '=', 'tournaments.id')->orderBy('tournaments.date', 'desc')->select('podia.*');
    }
}
