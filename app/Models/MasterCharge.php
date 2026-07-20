<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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
        'tds_percentage',
        'sac_code',
        'status','user_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
