<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatriculationStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'matriculation_period_id',
        'classroom_id',
        'status',
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function period()
    {
        return $this->belongsTo(MatriculationPeriod::class, 'matriculation_period_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function scores()
    {
        return $this->hasMany(MatriculationScore::class);
    }
}
