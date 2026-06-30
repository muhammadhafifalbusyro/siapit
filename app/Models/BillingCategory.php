<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'total_amount',
        'installment_count',
    ];

    public function payments()
    {
        return $this->hasMany(BillingPayment::class);
    }
}
