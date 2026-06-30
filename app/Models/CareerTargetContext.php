<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerTargetContext extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function fields()
    {
        return $this->hasMany(CareerTargetField::class, 'career_target_context_id');
    }
}
