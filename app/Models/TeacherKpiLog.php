<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherKpiLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'teacher_kpi_item_id',
        'date',
        'is_checked',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function item()
    {
        return $this->belongsTo(TeacherKpiItem::class, 'teacher_kpi_item_id');
    }
}
