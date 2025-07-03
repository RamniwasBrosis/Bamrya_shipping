<?php

namespace App\Models\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationSeaExportCont extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 'uuid', 'sea_export_id',
        'cont_hbl', 'gross_weight', 'total_package', 'ground_date', 'temp',
        'remarks', 'cont_job_no', 'container_no', 'cbm', 'cargo_type',
        'vgm_wt', 'soc', 'commodity', 'size', 'refer', 'agent_seal_no',
        'imo_code', 'disposal', 'sector', 'cust_seal_no', 'fcl_lcl',
        'net_weight', 'uno_no', 'detent_date', 'prev_days'
    ];

    public function seaExport(){
        return $this->belongsTo(OperationSeaExport::class, 'sea_export_id');
    }
}
