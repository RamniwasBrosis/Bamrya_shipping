<?php

namespace App\Models\Accounts;

use App\Models\MasterImportParty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountPurchasePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'uuid',
        'billing_party_id',
        'invoice_f_year',
        'pp_date',
        'radio_type',
        'neft_details',
        'neft_date',
        'bank_name',
        'total_amount_payable',
        'billing_party',
    ];

    public function partyName(){
        return $this->belongsTo(MasterImportParty::class, 'billing_party_id');
    }

}
