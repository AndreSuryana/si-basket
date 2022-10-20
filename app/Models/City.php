<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function refereeEvents()
    {
        return $this->hasMany(RefereeEvent::class, 'city_id');
    }

    // public function coachEvents()
    // {
    //     return $this->hasMany(CoachEvent::class, 'city_id');
    // }

    // public function coachClubDetails()
    // {
    //     return $this->hasMany(CoachClubDetail::class, 'city_id');
    // }
}
