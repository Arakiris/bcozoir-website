<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaLink extends Model
{
    protected $fillable = ['path', 'url', 'description', 'display'];
}
