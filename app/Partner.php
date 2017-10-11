<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = ['address'];
    /**
     * Get all of the picture's partners.
    **/
    public function picture() {
        return $this->morphMany('App\Picture', 'imageable');
    }
}
