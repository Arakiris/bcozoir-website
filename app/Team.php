<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name'];

    /**
     * Get the tournament where this team is participating.
     */
    public function tournament()
    {
        return $this->belongsTo('App\Tournament', 'tournament_id', 'id');
    }

    /**
     * The members that belong to the team.
     */
    public function members()
    {
        return $this->belongsToMany(Member::class)->withPivot('rank');
    }
}
