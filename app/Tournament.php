<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $guarded = ['id'];

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
}
