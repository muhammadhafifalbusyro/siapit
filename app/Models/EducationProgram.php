<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'description', 'duration_years'])]
class EducationProgram extends Model
{
    use HasFactory;

    public function majors()
    {
        return $this->hasMany(Major::class);
    }
}
