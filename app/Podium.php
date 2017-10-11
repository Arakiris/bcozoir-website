<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Podium extends Model
{
    protected $fillable = ['tournament_id'];

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
}
