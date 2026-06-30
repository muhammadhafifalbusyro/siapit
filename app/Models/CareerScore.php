<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'career_student_id',
        'evaluator_id',
        'evaluation_date',
        'soft_skill_communication',
        'soft_skill_teamwork',
        'soft_skill_discipline',
        'hard_skill_quality',
        'hard_skill_speed',
        'hard_skill_problem_solving',
        'notes',
    ];

    public function student()
    {
        return $this->belongsTo(CareerStudent::class, 'career_student_id');
    }

    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }
}
