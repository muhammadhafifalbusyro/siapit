<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatriculationAspect extends Model
{
    use HasFactory;

    protected $fillable = [
        'matriculation_period_id',
        'name',
        'weight_percentage',
        'type',
        'input_type',
        'target_weekly',
        'target_monthly',
        'active_days',
    ];

    protected $casts = [
        'active_days' => 'array',
    ];

    public function period()
    {
        return $this->belongsTo(MatriculationPeriod::class, 'matriculation_period_id');
    }

    public function scores()
    {
        return $this->hasMany(MatriculationScore::class);
    }
}
