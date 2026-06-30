<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'is_active'])]
class AcademicYear extends Model
{
    use HasFactory;

    public function batches()
    {
        return $this->hasMany(Batch::class);
    }
}
