<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'career_student_id',
        'log_date',
        'task',
        'progress',
        'obstacles',
        'status',
        'approved_by',
        'approved_at',
    ];

    public function student()
    {
        return $this->belongsTo(CareerStudent::class, 'career_student_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
