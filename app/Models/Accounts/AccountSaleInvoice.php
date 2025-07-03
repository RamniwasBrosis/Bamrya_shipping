<?php

namespace App\Models\Accounts;

use App\Models\MasterBank;
use App\Models\MasterImportParty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountSaleInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'uuid',
        'Inv_cat',
        'job_no',
        'voyage_code',
        'pod',
        'container',
        'consignee',
        'cbm',
        'gross_weight',
        'chargeable_weight',
        'party_type',
        'billing_party_id',
        'invoice_no',
        'invoice_type',
        'overseas_exchange_rate',
        'gst_type',
        'invoice_date',
        'full_invoice_no',
        'bank_id',

        'charge_name',
        'gst',
        'currency',
        'prepaid_coll',
        'rate_basis',
        'gst_applicable',
        'per_unit',
        'exchange_rate',
        'rate_per_unit',
        'freight',
        'amount',
        'charge_full_invoice_no',
        'remarks',

        'caf_percent',
        'caf_amount',
        'baf_percent',
        'baf_amount',
        'cc_percent',
        'cc_amount',

        'cc_apply',
        'caf_apply',

        'gstin',
        'sac_code',

        'cgst',
        'sgst',
        'igst',
        'total',
    ];

    public function partyName(){
        return $this->belongsTo(MasterImportParty::class, 'billing_party_id');
    }

    public function accountNumber(){
        return $this->belongsTo(MasterBank::class, 'bank_id');
    }
}
