<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'education_period_id',
        'classroom_id',
        'status',
        'career_start_date',
        'career_end_date',
        'career_placement_id',
        'career_status',
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function period()
    {
        return $this->belongsTo(EducationPeriod::class, 'education_period_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function scores()
    {
        return $this->hasMany(EducationScore::class);
    }

    public function careerPlacement()
    {
        return $this->belongsTo(CareerPlacement::class, 'career_placement_id');
    }
}
