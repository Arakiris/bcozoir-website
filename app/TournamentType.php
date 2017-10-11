<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TournamentType extends Model
{
    protected $fillable = ['title'];

    /**
     * Get all the tournaments that belong to the type.
     */
     public function tournaments()
     {
         return $this->hasMany('App\Tournament');
     }
}
