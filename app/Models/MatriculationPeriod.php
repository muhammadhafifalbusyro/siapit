<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatriculationPeriod extends Model
{
    use HasFactory;

    protected $fillable = [
        'academic_year_id',
        'batch_id',
        'duration_number',
        'duration_unit',
        'start_date',
        'end_date',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function aspects()
    {
        return $this->hasMany(MatriculationAspect::class);
    }

    public function students()
    {
        return $this->hasMany(MatriculationStudent::class);
    }
}
