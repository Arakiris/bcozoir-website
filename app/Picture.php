<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = ['path', 'title'];
    /**
     * Get all of the owning videoable models.
     */
     public function imageable()
     {
         return $this->morphTo();
     }

     public function scopeFirstsrandompicture($query) {
        return $query->whereIn('imageable_type', ['App\Tournament', 'App\Tournament', 'App\Event'])->inRandomOrder()->take(10);
    }
}
