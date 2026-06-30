<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'name', 'email', 'whatsapp', 'birthplace', 'birthdate', 'gender', 'age', 'region', 'address', 'last_education', 
    'guardian_name', 'guardian_relationship', 'guardian_whatsapp', 'guardian_occupation', 'education_program_id', 'major_id', 
    'academic_year_id', 'batch_id',
    'status', 'photo', 'goals', 'hobbies', 'instagram', 'facebook', 'organization_experience', 'school_name', 
    'school_major', 'achievements', 'parents_condition', 'parent_income', 'sibling_count', 'has_laptop', 
    'quran_memorization', 'favorite_ustadz', 'has_relationship', 'source_info', 'has_bpjs', 'idol', 
    'is_smoking', 'learned_before', 'it_skills', 'favorite_subjects',
    'payment_status', 'midtrans_order_id', 'snap_token'
])]
class Registration extends Model
{
    use HasFactory;

    public function educationProgram()
    {
        return $this->belongsTo(EducationProgram::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}
