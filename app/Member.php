<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Member extends Model
{
    protected $fillable = [
        'club_id', 'category_id', 'first_name', 'last_name', 'sex',
        'birth_date', 'is_licensee', 'id_licensee',
        'handicap', 'bonus', 'is_active', 'historical_path', 'listing_url'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'birth_date'
    ];

    /**
     * Get the club of the member.
     */
    public function club()
    {
        return $this->belongsTo('App\Club', 'club_id', 'id');
    }

    /**
     * Get the category of the member.
     */
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    /**
     * Get all the score of the member.
     */
    public function score()
    {
        return $this->hasOne('App\Score', 'member_id');
    }


    /**
     * The members that belong to the league.
     */
    public function leagues()
    {
        return $this->belongsToMany(League::class);
    }

    /**
     * The members that belong to the tournament.
     */
    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class)->withPivot('rank');
    }

    /**
     * Teams where the member is playing.
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class)->withPivot('rank');
    }

    /**
     * Get the picture of this member.
    **/
    public function picture() {
        return $this->morphMany('App\Picture', 'imageable');
    }

    public function getIsLicenseeAttribute($value)
    {
        if ($value == 0)
            return 'Adhérent';
        elseif ($value == 1)
            return 'Licencié';
        else 
            return 'Loisir';
    }

    public function scopeGetmembers($query) {
        return $query->where('club_id', '1')->where('is_licensee', '<>' , '2')->orderBy('last_name', 'ASC')->orderBy('first_name', 'ASC');
    }

    public function scopeLicenseemember($query) {
        return $query->where('club_id', '1')->where('is_licensee', '1')->orderBy('last_name', 'ASC')->orderBy('first_name', 'ASC');
    }
}
