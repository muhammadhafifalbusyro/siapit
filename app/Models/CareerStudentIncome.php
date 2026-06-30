<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerStudentIncome extends Model
{
    use HasFactory;

    protected $fillable = [
        'education_student_id',
        'amount',
        'source',
        'date',
        'notes',
        'is_approved',
    ];

    public function educationStudent()
    {
        return $this->belongsTo(EducationStudent::class, 'education_student_id');
    }
}
