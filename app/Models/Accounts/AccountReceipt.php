<?php

namespace App\Models\Accounts;

use App\Models\MasterImportParty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class AccountReceipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id','user_id',
        'uuid',
        'billing_party_id',
        'receipt_date',
        'amount',
        'invoice_type',
        'invoice_no'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function billingParty(){
        return $this->belongsTo(MasterImportParty::class, 'billing_party_id');
    }
}
