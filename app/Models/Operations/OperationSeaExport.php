<?php

namespace App\Models\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Operations\OperationSalesPerson;
use App\Models\Operations\OperationSeaExportCont;
use App\Models\Operations\OperationSeaExportShipmentLine;

use App\Models\MasterPort;
use App\Models\MasterImportParty;
use App\Models\MasterExportParty;
use App\Models\MasterShipping;
use App\Models\MasterVessel;
use App\Models\MasterForwarder;
use App\Models\MasterPackage;
use App\Models\MasterBlType;
use App\Models\User;
use App\Models\CompanyBranch;

class OperationSeaExport extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 'uuid', 'entry_by','user_id',
        'job_no', 'full_job_no', 'booking_no', 'booking_date', 'vessel_name', 'voyage_no','branch_id',
        'mbl_no', 'hbl_no', 'enquiry_ref_no', 'quantity', 'package_id', 'freight',
        'freight_charges', 'gross_weight', 'net_weight', 'tare_weight', 'volume_unit',
        'movement', 'cargo_type', 'eta_date', 'etd_date', 'cbm',
        'port_cutoff', 'si_cutoff', 'document_cutoff', 'vgm_cutoff', 'remarks',
        'agent_id', 'bl_type', 'issue_place', 'no_of_origin', 'delivery_agent_id',
        'place_of_acceptance', 'sales_person_id', 'stuffing_point', 'cha_id',
        'shipping_line_id', 'forwarder_id', 'bl_issued_date', 'vgm_issued_date','stuffingDate',  'operation_complate',


        'notify2_id', 'notify_id', 'consignee_id', 'shipper_id', 'delivery_port_id', 'receipt_port_id', 'discharge_port_id', 'loading_port_id',
        'shipping_bill', 'clearance', 'transportation_details', 'transportation', 'fpa_amount',
         'insurance', 'commodity', 'sbill_no', 'customer_inv_no', 'goods_description', 'mark_number', 'leo_date', 'cartining_date','destination_port_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function container(){
        return $this->hasMany(OperationSeaExportCont::class, 'sea_export_id', 'id');
    }

    public function destinationPortName(){
        return $this->belongsTo(MasterPort::class, 'destination_port_id', 'id');
    }

    public function salesPerson(){
        return $this->belongsTo(OperationSalesPerson::class, 'sales_person_id', 'id');
    }

    public function shipperName(){
        return $this->belongsTo(MasterExportParty::class, 'shipper_id', 'id');
    }

    public function ConsigneeName(){
        return $this->belongsTo(MasterImportParty::class, 'consignee_id');
    }

    public function notify(){
        return $this->belongsTo(MasterImportParty::class, 'notify_id');
    }

    public function Forwarder(){
        return $this->belongsTo(MasterForwarder::class, 'forwarder_id');
    }

    public function loadingPortName(){
        return $this->belongsTo(MasterPort::class, 'loading_port_id');
    }

    public function dischargePortName(){
        return $this->belongsTo(MasterPort::class, 'discharge_port_id', 'id');
    }

    public function receiptPortName(){
        return $this->belongsTo(MasterPort::class, 'receipt_port_id', 'id');
    }

    public function deliveryPortName(){
        return $this->belongsTo(MasterPort::class, 'delivery_port_id', 'id');
    }

    public function shippingLine(){
        return $this->belongsTo(MasterShipping::class, 'shipping_line_id');
    }

    public function ChaName(){
        return $this->belongsTo(MasterImportParty::class, 'cha_id');
    }

    public function vesselName(){
        return $this->belongsTo(MasterVessel::class, 'vessel_id');
    }

    public function partyName()
    {
        return $this->belongsTo(MasterImportParty::class, 'billing_party_id');
    }

    public function jobMaster()
    {
        return $this->belongsTo(OperationJobMaster::class, 'job_no', 'id');
    }

    public function agentName()
    {
        return $this->belongsTo(MasterImportParty::class, 'agent_id', 'id');
    }

    public function deliveryAgentName()
    {
        return $this->belongsTo(MasterImportParty::class, 'delivery_agent_id', 'id');
    }

    public function packageName()
    {
        return $this->belongsTo(MasterPackage::class, 'package_id', 'id');
    }

    public function blType()
    {
        return $this->belongsTo(MasterBlType::class, 'bl_type', 'id');
    }

    public function shipmentLines()
    {
        return $this->hasMany(
            OperationSeaExportShipmentLine::class,
            'sea_export_id'
        );
    }
    public function branch()
    {
        return $this->belongsTo(CompanyBranch::class);
    }

}
