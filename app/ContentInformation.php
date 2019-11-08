<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentInformation extends Model
{
    /**
     * 1. presentation
     * 2. adresses
     * 3. version
     * 4. mentions légales
     */
    protected $fillable = ['name', 'description', 'path'];
}
