<?php

namespace App\Models\Accounts;

use App\Models\MasterBank;
use App\Models\MasterCharge;
use App\Models\User;
use App\Models\MasterBillingParty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Operations\OperationJobMaster;
use App\Models\Operations\OperationSalesPerson;
use App\Models\CompanyBranch;
use App\Models\MasterImportParty;

class AccountProformaInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id','branch_id',
        'uuid','job_date','shipper_name',
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
        'bank_id',
        'gst_type',
        'invoice_date',
        'full_job_no',
        'doe_date',

        'vessel_name',
        'awb_bl_no',
        'sale_purchase',
        'sales_person_id',

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
        'amount','bl_no',

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
        'vessel_name',
        'awb_bl_no',
        'sale_purchase',
        'pol',
        'pkgType',
        'packages',
        'shipping_no',
        'shipping_bill_date',
        'shipper_invoice_no','user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function partyName(){
        return $this->belongsTo(MasterImportParty::class, 'billing_party_id');
    }

    public function accountNumber(){
        return $this->belongsTo(MasterBank::class, 'bank_id');
    }

    public function salesPerson(){
        return $this->belongsTo(OperationSalesPerson::class, 'sales_person_id');
    }

    public function operationJob(){
        return $this->belongsTo(OperationJobMaster::class, 'job_no', 'id');
    }

    public function chargeName(){
        return $this->belongsTo(MasterCharge::class, 'charge_name', 'id');
    }
    public function branch(){
        return $this->belongsTo(CompanyBranch::class, 'branch_id', 'id');
    }

    public function chargesContainer(){
        return $this->hasMany(AccountProformaInvoiceContainer::class, 'proforma_invoice_id');
    }
}
