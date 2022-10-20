<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    public function referees()
    {
        return $this->hasMany(Referee::class);
    }

    public function refereeEvents()
    {
        return $this->hasMany(RefereeEvent::class, 'referee_id');
    }

    public function coaches()
    {
        return $this->hasMany(Coach::class);
    }

    public function coachesEvents()
    {
        return $this->hasMany(coachesEvents::class, 'coach_id');
    }
}
