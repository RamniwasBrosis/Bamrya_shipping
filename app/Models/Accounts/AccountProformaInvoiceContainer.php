<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\MasterCharge;
use App\Models\User;
use App\Models\Accounts\AccountProformaInvoice;
use App\Models\Operations\OperationJobMaster;

class AccountProformaInvoiceContainer extends Model
{
    use HasFactory;

    protected $table = 'account_proforma_invoices_container';

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
        'proforma_invoice_id',
        'tds',
        'tds_amount',
        'total_unit'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function charge()
    {
        return $this->belongsTo(MasterCharge::class, 'charge_id');
    }
    
    public function operationJob(){
        return $this->belongsTo(OperationJobMaster::class, 'job_no', 'id');
    }

    public function purchaseInvoice()
    {
        return $this->belongsTo(AccountProformaInvoice::class, 'proforma_invoice_id');
    }
    
}
