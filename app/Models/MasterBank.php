<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBank extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'bank_name',
        'beneficiary_name',
        'branch_name',
        'account_no',
        'ifsc_code',
        'account_type',
        'swift_code',
        'gstin_no_company',
        'company_pan',
        'company_name',
        'branch_company_address1',
        'branch_company_address2',
        'branch_company_address3',
        'contact_no',
        'notes1',
        'notes2',
        'notes3',
        'notes4',
        'notes5',
        'notes6',
        'notes7',
        'notes8',
        'notes9',
        'notes10',
    ];

}
