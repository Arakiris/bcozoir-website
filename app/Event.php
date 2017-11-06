<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['name', 'place', 'date'];
    protected $dates = [
        'created_at',
        'updated_at',
        'date'
    ];
    /**
     * Get all of the picture's events.
    **/
    public function pictures() {
        return $this->morphMany('App\Picture', 'imageable');
    }

    /**
     * Get all of the video's events.
    **/
    public function videos() {
        return $this->morphMany('App\Video', 'videoable');
    }

    public function scopeShowevents($query) {
        return $query->orderBy('date', 'desc');
    }
}
