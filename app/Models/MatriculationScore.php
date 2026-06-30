<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatriculationScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'matriculation_student_id',
        'matriculation_aspect_id',
        'score',
        'evaluation_date',
        'notes',
    ];

    public function student()
    {
        return $this->belongsTo(MatriculationStudent::class, 'matriculation_student_id');
    }

    public function aspect()
    {
        return $this->belongsTo(MatriculationAspect::class, 'matriculation_aspect_id');
    }
}
