<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ADMIN_TYPE = 'admin';
    const DEFAULT_TYPE = 'default';

    protected $fillable = [ "name" ];

    /**
     * Get all the users for this role .
     */
    public function users(){
        return $this->hasMany("App\User");
    }
}
