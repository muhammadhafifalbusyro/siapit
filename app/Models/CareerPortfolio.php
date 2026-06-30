<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerPortfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'career_student_id',
        'title',
        'project_url',
        'repo_url',
        'description',
    ];

    public function student()
    {
        return $this->belongsTo(CareerStudent::class, 'career_student_id');
    }
}
