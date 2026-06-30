<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherKpiItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_kpi_period_id',
        'teacher_kpi_jobdesc_id',
        'name',
        'weight',
    ];

    public function period()
    {
        return $this->belongsTo(TeacherKpiPeriod::class, 'teacher_kpi_period_id');
    }

    public function jobdesc()
    {
        return $this->belongsTo(TeacherKpiJobdesc::class, 'teacher_kpi_jobdesc_id');
    }

    public function logs()
    {
        return $this->hasMany(TeacherKpiLog::class);
    }
}
