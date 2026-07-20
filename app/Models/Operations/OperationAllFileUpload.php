<?php

namespace App\Models\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Operations\OperationAirExport;
use App\Models\Operations\OperationAirImport;
use App\Models\Operations\OperationSeaExport;
use App\Models\Operations\OperationJobMaster;

class OperationAllFileUpload extends Model
{
    use HasFactory;

    Protected $fillable = ['company_id', 'uuid', 'file_name', 'file_path', 'file_type', 'file_related', 'job_no'];
    
    public function jobMasterFile()
    {
        return $this->belongsTo(OperationJobMaster::class, 'job_no', 'id');
    }

}
