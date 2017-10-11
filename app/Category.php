<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title'];
    /**
     * Get all the members of the category.
     */
     public function members()
     {
         return $this->hasMany('App\Member');
     }
}
