<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Warning extends Model
{
    protected $fillable=['body', 'date_disappear'];

    protected $dates = [
        'created_at',
        'updated_at',
        'date_disappear'
    ];

    public function scopeShowwarning($query) {
        return $query->where('date_disappear', '>', Carbon::now());
    }

}
