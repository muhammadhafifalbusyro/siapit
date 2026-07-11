<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'education_period_id',
        'name',
    ];

    public function period()
    {
        return $this->belongsTo(EducationPeriod::class, 'education_period_id');
    }

    public function aspects()
    {
        return $this->hasMany(EducationAspect::class, 'education_skill_id');
    }
}
