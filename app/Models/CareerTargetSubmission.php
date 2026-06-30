<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerTargetSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'education_student_id',
        'career_target_context_id',
        'score',
        'notes',
    ];

    public function student()
    {
        return $this->belongsTo(EducationStudent::class, 'education_student_id');
    }

    public function context()
    {
        return $this->belongsTo(CareerTargetContext::class, 'career_target_context_id');
    }

    public function values()
    {
        return $this->hasMany(CareerTargetSubmissionValue::class, 'career_target_submission_id');
    }
}
