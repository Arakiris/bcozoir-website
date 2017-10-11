<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warning extends Model
{
    protected $fillable=['body', 'date_disappear'];

    protected $dates = [
        'created_at',
        'updated_at',
        'date_disappear'
    ];

}
