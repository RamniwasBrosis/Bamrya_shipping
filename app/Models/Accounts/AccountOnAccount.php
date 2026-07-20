<?php

namespace App\Models\Accounts;

use App\Models\MasterImportParty;
use App\Models\MasterBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountOnAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'uuid',
        'sales_date',
        'party_id',
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
