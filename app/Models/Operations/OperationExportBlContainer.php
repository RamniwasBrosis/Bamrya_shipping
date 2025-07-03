<?php

namespace App\Models\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationExportBlContainer extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'booking_no',
        'cont_hbl',
        'container_no',
        'size',
        'cust_seal_no',
        'gross_weight',
        'cbm',
        'refer',
        'fcl_lcl',
        'total_package',
        'cargo_type',
        'agent_seal_no',
        'net_weight',
        'ground_date',
        'vgm_weight',
        'imo_code',
        'uno_no',
        'temperature',
        'soc',
        'disposal',
        'detention_date',
        'remarks',
        'commodity',
        'sector',
        'previous_days',
        'cont_job_no',
    ];
}
