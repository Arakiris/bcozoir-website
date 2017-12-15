<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $fillable = ['daily_visits', 'month_visits', 'since_creation_visits', 'last_update'];

    protected $dates = [
        'created_at',
        'updated_at',
        'last_update'
    ];

    
}
