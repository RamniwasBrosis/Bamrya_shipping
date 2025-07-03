<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPort extends Model
{
    use HasFactory;

    protected $fillable = [
        'port_code',
        'port_name',
        'edi_code',
        'jnpt_code',
        'nsict_code',
        'nsict_group_code',
        'gti_code',
        'gti_group_code',
        'nsi_gt_code',
        'status',
    ];

}
