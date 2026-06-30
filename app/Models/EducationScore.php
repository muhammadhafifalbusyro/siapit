<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'education_student_id',
        'education_aspect_id',
        'score',
        'evaluation_date',
        'notes',
    ];

    public function student()
    {
        return $this->belongsTo(EducationStudent::class, 'education_student_id');
    }

    public function aspect()
    {
        return $this->belongsTo(EducationAspect::class, 'education_aspect_id');
    }
}
