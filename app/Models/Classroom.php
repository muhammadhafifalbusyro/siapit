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
        'assistant_teacher_id',
        'leader_registration_id',
    ];

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

    public function assistantTeacher()
    {
        return $this->belongsTo(User::class, 'assistant_teacher_id');
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
