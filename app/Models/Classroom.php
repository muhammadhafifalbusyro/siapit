<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'academic_year_id',
        'batch_id',
        'name',
        'homeroom_teacher_id',
        'leader_registration_id',
        'matriculation_skill_id',
        'education_skill_id',
    ];

    public function matriculationSkill()
    {
        return $this->belongsTo(MatriculationSkill::class, 'matriculation_skill_id');
    }

    public function educationSkill()
    {
        return $this->belongsTo(EducationSkill::class, 'education_skill_id');
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function homeroomTeacher()
    {
        return $this->belongsTo(User::class, 'homeroom_teacher_id');
    }

    /**
     * Multiple assistant teachers via pivot table (Many-to-Many).
     */
    public function assistantTeachers()
    {
        return $this->belongsToMany(User::class, 'classroom_assistant_teachers');
    }

    public function leaderRegistration()
    {
        return $this->belongsTo(Registration::class, 'leader_registration_id');
    }

    public function matriculationStudents()
    {
        return $this->hasMany(MatriculationStudent::class);
    }
}
