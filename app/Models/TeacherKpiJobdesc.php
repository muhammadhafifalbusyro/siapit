<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherKpiJobdesc extends Model
{
    use HasFactory;

    protected $table = 'teacher_kpi_jobdescs';

    protected $fillable = [
        'name',
    ];

    public function items()
    {
        return $this->hasMany(TeacherKpiItem::class, 'teacher_kpi_jobdesc_id');
    }
}
