<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ['title', 'link'];
    
    /**
     * Get all of the picture's links.
    **/
    public function picture() {
        return $this->morphMany('App\Picture', 'imageable');
    }
}
