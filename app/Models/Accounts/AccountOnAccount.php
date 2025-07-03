<?php

namespace App\Models\Accounts;

use App\Models\MasterImportParty;
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
        'balance_amout',
    ];

    public function partyName(){
        return $this->belongsTo(MasterImportParty::class, 'party_id');
    }
}
