<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function scopeShowad($query) {
        // return $query->where('start_display', '>=', Carbon::now());
        return $query->where([
            ['start_display', '<=', Carbon::now()],
            ['end_display', '>', Carbon::now()]]
        )
        ->orderBy('id','desc');
    }
    
}
