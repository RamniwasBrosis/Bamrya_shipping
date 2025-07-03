<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterImportParty extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'party_code',
        'party_name',
        'tally_ledger',
        'address_line1',
        'address_line2',
        'address_line3',
        'city',
        'pincode',
        'party_type',
        'contact_person',
        'tel_no',
        'email',
        'gstin',
        'pan_no',
        'cin_no',
        'credit_days',
        'tds_percent',
        'status',
    ];

}
