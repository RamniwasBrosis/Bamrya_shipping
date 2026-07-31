<?php

namespace App\Models\Operations;

use App\Models\MasterImportParty;
use App\Models\MasterExportParty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Operations\OperationSeaImport;
use App\Models\Operations\OperationSeaExport;
use App\Models\Operations\OperationAirImport;
use App\Models\Operations\OperationAirExport;
use App\Models\User;
use App\Models\CompanyBranch;

class OperationJobMaster extends Model
{
    use HasFactory;

    protected $table = 'operation_job_masters';


    protected $fillable = [
        'uuid',
        'company_id','branch_id',
        'issued_by',
        'job_no',
        'job_date',
        'job_activity',
        'job_party_id',
        'job_remarks',
        'term',
        'enquiry_reference_no',
        'job_activity_type',
        'shipment_type',
        'job_status',
        'insurance',
        'clearance',
        'transportation',
        'booking_date',
        'cargo_ready_date',
        'pickup_date','user_id'
    ];

    public function consigneeName()
    {
        return $this->belongsTo(MasterImportParty::class, 'job_party_id');
    }

    public function shipperName(){
        return $this->belongsTo(MasterExportParty::class, 'job_party_id');
    }

    public function seaExport()
    {
        return $this->hasOne(OperationSeaExport::class, 'job_no', 'id');
    }

    public function seaImport()
    {
        return $this->hasOne(OperationSeaImport::class, 'job_no', 'id');
    }

    public function airExport()
    {
        return $this->hasOne(OperationAirExport::class, 'job_no', 'id');
    }

    public function airImport()
    {
        return $this->hasOne(OperationAirImport::class, 'job_no', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function branch()
    {
        return $this->belongsTo(CompanyBranch::class);
    }

    // public function import_job_party(){
    //     return $this->belongsTo(MasterExportParty::class, 'job_party_id');
    // }

    // public function export_job_party(){
    //     return $this->belongsTo(MasterImportParty::class, 'job_party_id');
    // }
}
