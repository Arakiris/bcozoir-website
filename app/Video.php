<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    /**
     * Get all of the owning videoable models.
     */
     public function videoable()
     {
         return $this->morphTo();
     }
}
