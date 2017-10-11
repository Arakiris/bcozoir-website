<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    protected $fillable = ['start_display', 'end_display'];

    protected $dates = [
        'created_at',
        'updated_at',
        'start_display',
        'end_display'
    ];

    /**
     * Get all of the picture's adverts.
    **/
    public function picture() {
        return $this->morphMany('App\Picture', 'imageable');
    }
    
}
