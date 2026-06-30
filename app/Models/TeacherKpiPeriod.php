<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherKpiPeriod extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'start_date',
        'end_date',
        'off_days',
    ];

    protected $casts = [
        'off_days' => 'array',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items()
    {
        return $this->hasMany(TeacherKpiItem::class);
    }
}
