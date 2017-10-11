<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
