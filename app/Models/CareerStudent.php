<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'career_period_id',
        'registration_id',
        'career_placement_id',
        'status',
        'notes',
    ];

    public function period()
    {
        return $this->belongsTo(CareerPeriod::class, 'career_period_id');
    }

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function placement()
    {
        return $this->belongsTo(CareerPlacement::class, 'career_placement_id');
    }

    public function logs()
    {
        return $this->hasMany(CareerLog::class);
    }

    public function scores()
    {
        return $this->hasMany(CareerScore::class);
    }

    public function portfolios()
    {
        return $this->hasMany(CareerPortfolio::class);
    }
}
