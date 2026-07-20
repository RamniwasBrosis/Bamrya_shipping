<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MasterCharge;
use App\Models\Accounts\AccountPurchaseInvoice;
use App\Models\User;

class AccountPurchaseInvoiceContainer extends Model
{
    use HasFactory;

    protected $table = 'account_purchase_invoices_container';

    protected $fillable = [
        'company_id','user_id',
        'uuid',
        'charge_id',
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
        'total_unit',
        'tds',
        'tds_amount',
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
        'purchase_invoice_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function chargeName()
    {
        return $this->belongsTo(MasterCharge::class, 'charge_id');
    }

    public function purchaseInvoice()
    {
        return $this->belongsTo(AccountPurchaseInvoice::class, 'purchase_invoice_id');
    }
}
