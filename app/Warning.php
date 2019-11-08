<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Warning extends Model
{
    protected $fillable=['body', 'date_begin', 'date_disappear'];

    protected $dates = [
        'created_at',
        'updated_at',
        'date_disappear',
        'date_begin'
    ];

    public function scopeShowwarning($query) {
        return $query->whereNull('date_begin')->where('date_disappear', '>=', Carbon::now())->orderBy('id');
    }

    public function scopeShowwarningbetween($query){
        $now = Carbon::now();
        return $query->where('date_begin', '<=', $now)->where('date_disappear', '>=', $now)->orderBy('id');
    }

}
