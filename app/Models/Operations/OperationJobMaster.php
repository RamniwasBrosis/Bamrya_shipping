<?php

namespace App\Models\Operations;

use App\Models\MasterImportParty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OperationJobMaster extends Model
{
    use HasFactory;

    protected $table = 'operation_job_masters';


    protected $fillable = [
        'company_id',
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
        'pickup_date'
    ];

    public function job_party()
    {
        return $this->belongsTo(MasterImportParty::class, 'job_party_id');
    }
}
