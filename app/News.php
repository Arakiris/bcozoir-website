<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title', 'body'];

    /**
     * Get all of the picture's news.
    **/
    public function pictures() {
        return $this->morphMany('App\Picture', 'imageable');
    }

    /**
     * Get all of the video's news.
    **/
    public function videos() {
        return $this->morphMany('App\Video', 'videoable');
    }
}
