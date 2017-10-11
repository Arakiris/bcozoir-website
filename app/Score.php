<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = ['average', 'month'];
    /**
     * Get the member of this score.
     */
     public function member()
     {
         return $this->belongsTo('App\Member', 'member_id');
     }
}
