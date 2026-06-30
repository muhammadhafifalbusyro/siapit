<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerPlacement extends Model
{
    use HasFactory;

    protected $fillable = [
        'career_period_id',
        'name',
        'mentor_name',
        'mentor_contact',
        'description',
    ];

    public function period()
    {
        return $this->belongsTo(CareerPeriod::class, 'career_period_id');
    }

    public function students()
    {
        return $this->hasMany(EducationStudent::class, 'career_placement_id');
    }
}
