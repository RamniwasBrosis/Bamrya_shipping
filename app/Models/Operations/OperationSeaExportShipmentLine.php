<?php

namespace App\Models\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MasterImportParty;
use App\Models\Operations\OperationSeaExportCont;
use App\Models\Operations\OperationSeaExport;

class OperationSeaExportShipmentLine extends Model
{
    use HasFactory;

    protected $table = 'operation_sea_export_shipment_lines';

    protected $guarded = [];

    public function consignee()
    {
        return $this->belongsTo(
            MasterImportParty::class,
            'consignee_id'
        );
    }

    public function container()
    {
        return $this->belongsTo(
            OperationSeaExportCont::class,
            'sea_export_cont_id'
        );
    }

    public function seaExport()
    {
        return $this->belongsTo(
            OperationSeaExport::class,
            'sea_export_id'
        );
    }
}
