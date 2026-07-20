<?php

namespace App\Models\TallyPrime;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TallyVoucher extends Model
{
    use HasFactory;
    
    protected $table = 'tally_vouchers';

    protected $fillable = [
        'company_id',
        'uuid',
        'client_id',
        'tally_company_id',
        'voucher_guid',
        'alter_id',
        'voucher_type',
        'voucher_no',
        'voucher_date',
        'party_name',
        'amount',
        'is_deleted',
        'synced_at',
    ];

}
