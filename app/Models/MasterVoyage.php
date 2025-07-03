<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterVoyage extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'voyage_code',
        'voyage_number',
        'm_vessel_id',
        'arrival_date',
        'igm_number',
        'igm_date',
        'shipping_line_id',
        'f_voyage_no',
        'f_vessel_id',
        'mumbai_igm_no',
        'mumbai_igm_date',
        'overseas_agent_id',
        'status',
    ];
}
