<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCharge extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'charge_code',
        'charge_name',
        'tally_ledger_name',
        'currency',
        'charge_type',
        'gst_applicable',
        'gst_percentage',
        'has_formula',
        'limit',
        'percentage',
        'sac_code',
        'status',
    ];
}
