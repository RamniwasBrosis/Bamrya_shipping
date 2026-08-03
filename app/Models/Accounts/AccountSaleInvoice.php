<?php

namespace App\Models\Accounts;

use App\Models\MasterBank;
use App\Models\MasterImportParty;
use App\Models\MasterPort;
use App\Models\User;
use App\Models\MasterCharge;
use App\Models\Accounts\AccountSaleInvoiceContainer;
use App\Models\Operations\OperationJobMaster;  //gajendra
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\CompanyBranch;

class AccountSaleInvoice extends Model
{
    use HasFactory;

    protected $table = 'account_sale_invoices';

    protected $fillable = [
        'company_id','user_id','branch_id',
        'uuid',
        'Inv_cat',
        'job_no',
        'full_job_no',
        'voyage_code',
        'pod','pol','pkgType',
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
        'vessel_name',
        'awb_bl_no',
        'sale_purchase','container_qty',
        'shipping_no',
        'remarks','packages','bl_no','hawb_no','job_date','invoice_due_date','shipper_name','eta_date','etd_date','freight_terms','mawb_no','hbl_no','sales_person',

        'invoice_amount',
        'recieved_amount',
        'outstanding_amount',
        'invoice_amount_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function partyName()
    {
        return $this->belongsTo(MasterImportParty::class, 'billing_party_id', 'id');
    }

    public function accountNumber(){
        return $this->belongsTo(MasterBank::class, 'bank_id');
    }

    public function operationJob(){
        return $this->belongsTo(OperationJobMaster::class, 'job_no', 'id');
    }

    public function chargeName(){
        return $this->belongsTo(MasterCharge::class, 'charge_name', 'id');
    }

    public function chargesContainer(){
        return $this->hasMany(AccountSaleInvoiceContainer::class, 'sales_invoice_id');
    }

    public function branch(){
        return $this->belongsTo(CompanyBranch::class, 'branch_id', 'id');
    }
}
