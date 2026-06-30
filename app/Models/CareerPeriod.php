<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerPeriod extends Model
{
    use HasFactory;

    protected $fillable = [
        'academic_year_id',
        'batch_id',
        'name',
        'start_date',
        'end_date',
        'status',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function placements()
    {
        return $this->hasMany(CareerPlacement::class);
    }

    public function students()
    {
        return $this->hasMany(CareerStudent::class);
    }
}
