<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'registration_id', 'billing_category_id', 'is_billed'
])]
class BillingStudentBill extends Model
{
    use HasFactory;

    protected $casts = [
        'is_billed' => 'boolean',
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function billingCategory()
    {
        return $this->belongsTo(BillingCategory::class);
    }
}
