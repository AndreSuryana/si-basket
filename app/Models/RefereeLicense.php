<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefereeLicense extends Model
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

    public function gameType()
    {
        return $this->belongsTo(GameType::class);
    }

    public function licenseLevel()
    {
        return $this->belongsTo(LicenseLevel::class);
    }
}
