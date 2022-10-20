<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefereeEvent extends Model
{
    use HasFactory;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    public function referee()
    {
        return $this->belongsTo(Referee::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
