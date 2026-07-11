<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatriculationSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'matriculation_period_id',
        'name',
    ];

    public function period()
    {
        return $this->belongsTo(MatriculationPeriod::class, 'matriculation_period_id');
    }

    public function aspects()
    {
        return $this->hasMany(MatriculationAspect::class, 'matriculation_skill_id');
    }
}
