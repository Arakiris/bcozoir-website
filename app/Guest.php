<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Guest extends Model
{
    protected $fillable = ['guest_ip', 'last_activity'];

    protected $dates = [
        'created_at',
        'updated_at',
        'last_activity'
    ];

    public function scopeOnlineguest($query) {
        return $query->where('last_activity', '>', Carbon::now()->subMinutes(5))->count();
    }
}
