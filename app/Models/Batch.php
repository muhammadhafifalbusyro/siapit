<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'academic_year_id', 'is_active'])]
class Batch extends Model
{
    use HasFactory;

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
