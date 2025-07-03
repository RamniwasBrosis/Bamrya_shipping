<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterVessel extends Model
{
    use HasFactory;

    protected $fillable=[
        'company_id',
        'vessel_name',
        'call_sign',
        'imo_code',
        'status'
    ];
}
