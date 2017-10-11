<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $fillable = ['name', 'address'];

    /**
     * Get the members of the club.
     */
     public function members()
     {
         return $this->hasMany('App\Member');
     }
}
