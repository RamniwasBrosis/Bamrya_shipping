<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountPurchasePaymentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'uuid',
        'purchase_id',
        'inv_type',
        'inv_no',
        'payment_type',
        'percentage',
        'tds_amount',
        'payment_amount',
        'actual_amount',
    ];
}
