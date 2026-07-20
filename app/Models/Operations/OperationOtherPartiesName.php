<?php

namespace App\Models\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MasterParty;

class OperationOtherPartiesName extends Model
{
    use HasFactory;
    
    protected $table = 'operation_other_parties_names';
    
    protected $fillable = [
            'party_code', 'party_name', 'tally_ledger', 'address_line1', 'address_line2', 'address_line3', 'city', 'pincode', 'party_type', 'contact_person', 'tel_no',
            'email', 'gstin', 'cin_no', 'pan_no', 'credit_days', 'tds_percent'
        ];
        
    public function otherParty()
    {
        return $this->belongsTo(MasterParty::class, 'party_type');
    }
}
