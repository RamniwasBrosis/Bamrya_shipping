<?php

namespace App\Models\Accounts;

use App\Models\MasterImportParty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountReceipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'uuid',
        'neft_details',
        'neft_date',
        'bank_name',
        'total_amount_received',
        'received_from_party',
        'billing_party_id',
        'invoice_f_year',
        'receipt_date',
        'inv_no',
        'inv_type',
    ];

    public function billingParty(){
        return $this->belongsTo(MasterImportParty::class, 'billing_party_id');
    }
}
