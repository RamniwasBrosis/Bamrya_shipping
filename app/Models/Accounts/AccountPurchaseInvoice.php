<?php

namespace App\Models\Accounts;

use App\Models\Accounts\MasterImportParty;
use App\Models\Accounts\AccountPurchaseInvoiceContainer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Operations\OperationJobMaster;
use App\Models\Accounts\PurchaseParties;
use App\Models\User;

class AccountPurchaseInvoice extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function partyName(){
        return $this->belongsTo(PurchaseParties::class, 'billing_party_id');
    }
    
    public function operationJob(){
        return $this->belongsTo(OperationJobMaster::class, 'job_no', 'id');
    }
    
    public function chargesContainer(){
        return $this->hasMany(AccountPurchaseInvoiceContainer::class, 'purchase_invoice_id');
    }
}
