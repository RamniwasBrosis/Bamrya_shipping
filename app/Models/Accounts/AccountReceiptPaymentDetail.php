<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountReceiptPaymentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'uuid',
        'receipt_id',
        'inv_type',
        'inv_no',
        'payment_type',
        'percentage',
        'tds_amount',
        'received_amount',
        'actual',
    ];
}
