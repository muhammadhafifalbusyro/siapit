<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['education_program_id', 'name', 'description'])]
class Major extends Model
{
    use HasFactory;

    public function educationProgram()
    {
        return $this->belongsTo(EducationProgram::class);
    }
}
