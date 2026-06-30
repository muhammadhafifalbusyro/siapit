<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerTargetSubmissionValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'career_target_submission_id',
        'career_target_field_id',
        'value',
    ];

    public function submission()
    {
        return $this->belongsTo(CareerTargetSubmission::class, 'career_target_submission_id');
    }

    public function field()
    {
        return $this->belongsTo(CareerTargetField::class, 'career_target_field_id');
    }
}
