<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\MasterImportParty;
use App\Models\MasterBank;

class AccountPaymentAmount extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'company_id',
        'uuid',
        'party_id',
        'sales_date',
        'amount',
        'round_of_amount',
        'bank_id',
    ];
    
    public function partyName(){
        return $this->belongsTo(MasterImportParty::class, 'party_id');
    }
    
    public function bankDetail(){
        return $this->belongsTo(MasterBank::class, 'bank_id');
    }
}
