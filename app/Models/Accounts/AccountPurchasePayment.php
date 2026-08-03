<?php

namespace App\Models\Accounts;

use App\Models\MasterImportParty;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CompanyBranch;

class AccountPurchasePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id','user_id','branch_id',
        'uuid',
        'billing_party_id',
        'purchase_date',
        'amount',
        'invoice_type',
        'invoice_no'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function partyName(){
        return $this->belongsTo(MasterImportParty::class, 'billing_party_id');
    }

    public function branch(){
        return $this->belongsTo(CompanyBranch::class, 'branch_id');
    }
}
