<?php

namespace App\Models\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationSeaImportDataEntryCont extends Model
{
    use HasFactory;

    protected $fillable = [
        'cont_hbl',
        'container_no',
        'size',
        'seal_no',
        'gross_weight',
        'cbm',
        'refer',
        'fcl_lcl',
        'total_package',
        'cargo_type',
        'detent_date',
        'freedays_cont',
        'ground_date',
        'ground_days',
        'imo_code',
        'uno_no',
        'tp_icd',
        'soc_yn',
        'disposal',
        'remarks',
        'printed',
        'selected',
        'sector',
        'previous_days',

        'company_id',
        'uuid',
        'sea_imp_ent_id',
    ];

    public function seaImport()
    {
        return $this->belongsTo(OperationSeaImport::class, 'sea_imp_ent_id');
    }
}
