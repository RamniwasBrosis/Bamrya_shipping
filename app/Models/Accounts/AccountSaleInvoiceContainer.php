<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MasterCharge;
use App\Models\Accounts\AccountSaleInvoice;
use App\Models\User;

class AccountSaleInvoiceContainer extends Model
{
    use HasFactory;
    
    protected $table = 'account_sales_invoice_container';
    
    protected $fillable = [
        'uuid',
        'company_id','user_id',
        'sales_invoice_id',
        'charge_id',
        'currency',
        'rate_basis',
        'gst',
        'gst_applicable',
        'per_unit',
        'total_unit',
        'exchange_rate',
        'rate_per_unit',
        'freight',
        'amount',
        'tds',
        'tds_amount',
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
        'prepaid_coll',
        'gstin',
        'sac_code',
        'cgst',
        'sgst',
        'igst',
        'total', 'charge_desc'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function chargeName()
    {
        return $this->belongsTo(MasterCharge::class, 'charge_id', 'id');
    }

    
    public function salesInvoice(){
        return $this->belongsTo(AccountSaleInvoice::class, 'sales_invoice_id', 'id');
    }
}
