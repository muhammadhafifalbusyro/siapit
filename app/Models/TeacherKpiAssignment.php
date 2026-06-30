<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherKpiAssignment extends Model
{
    use HasFactory;

    protected $table = 'teacher_kpi_assignments';

    protected $fillable = [
        'user_id',
        'teacher_kpi_period_id',
        'teacher_kpi_item_id',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function period()
    {
        return $this->belongsTo(TeacherKpiPeriod::class, 'teacher_kpi_period_id');
    }

    public function item()
    {
        return $this->belongsTo(TeacherKpiItem::class, 'teacher_kpi_item_id');
    }
}
