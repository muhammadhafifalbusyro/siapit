<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerTargetField extends Model
{
    use HasFactory;

    protected $fillable = [
        'career_target_context_id',
        'label',
        'placeholder',
        'type',
    ];

    public function context()
    {
        return $this->belongsTo(CareerTargetContext::class, 'career_target_context_id');
    }
}
