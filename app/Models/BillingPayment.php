<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'billing_category_id',
        'installment_index',
        'amount',
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function category()
    {
        return $this->belongsTo(BillingCategory::class, 'billing_category_id');
    }
}
