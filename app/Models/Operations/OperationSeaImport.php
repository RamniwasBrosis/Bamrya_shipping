<?php

namespace App\Models\Operations;

use App\Models\MasterImportParty;
use App\Models\MasterExportParty;
use App\Models\MasterForwarder;
use App\Models\MasterShipping;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Operations\OperationSalesPerson;

use App\Models\MasterPort;
use App\Models\MasterBlType;
use App\Models\MasterPackage;
use App\Models\User;

class OperationSeaImport extends Model
{
    use HasFactory;

     protected $fillable = [
        'company_id', 'uuid', 'bl_issue_by',
        'job_no', 'cargo_type', 'mbl_no', 'mbl_date', 'hbl_no', 'hbl_date','booking_no','amount','inv_ref_no',
        'igm_no', 'igm_date', 'item_no', 'sub_item_no', 'voyage_no', 'arrival_date',
        'vessel_name', 'eta_date', 'etd_date', 'quantity', 'package_id', 'freight',
        'gross_weight', 'cbm', 'cargo', 'is_hazardous', 'delivery_type', 'imo_cd',
        'uno_cd', 'free_days', 'hbl_type', 'fpa_amount', 'transportation_details',
        'bill_of_entry', 'delivery_order_date', 'loading_port_id', 'discharge_port_id','ex_work',
        'delivery_port_id', 'destination_port_id', 'shipping_line_id', 'agent_id', 'forwarder_id','delivery_agent_id',
        'cfs_yard_id', 'empty_yard_id', 'sales_person_id', 'coloader_id', 'shipper_id', 'agentSealNo', 'cust_seal_no', 'movement','sob_date', 'reg_no','user_id',
        
        'consignee_id', 'notify_id', 'notify2_id','cha_id', 'enquiry_reference_no','booking_date','net_weight','receipt_port_id',
        'obl_no', 'obl_date', 'ref_no',  'surveyor_id', 'validity_date','insurance','transportation','clearance','sub_job_no','remarks','username','prealert_date','inv_no_full', 
    ];

    public function shipperName(){
        return $this->belongsTo(MasterExportParty::class, 'shipper_id');
    }
    
    public function consignee(){
        return $this->belongsTo(MasterImportParty::class, 'consignee_id');
    }
    public function cfsYardName(){
        return $this->belongsTo(MasterImportParty::class, 'cfs_yard_id');
    }
    
    public function notifyName(){
        return $this->belongsTo(MasterImportParty::class, 'notify_id');
    }
    
    public function notify2(){
        return $this->belongsTo(MasterImportParty::class, 'notify2_id');
    }

    public function container(){
        return $this->hasMany(OperationSeaImportCont::class, 'sea_import_id');
    }
    
    
    public function salesPerson()
    {
        return $this->belongsTo(OperationSalesPerson::class, 'sales_person_id', 'id');
    }
    
    public function ConsigneeName(){
        return $this->belongsTo(MasterImportParty::class, 'consignee_id');
    }
    
    public function Forwarder(){
        return $this->belongsTo(MasterForwarder::class, 'forwarder_id');
    }
    
    
    // ports
    public function loadingPortName(){
        return $this->belongsTo(MasterPort::class, 'loading_port_id');
    }
    
    public function receiptPortName(){
        return $this->belongsTo(MasterPort::class, 'receipt_port_id');
    }
    
    public function destinationPortName(){
        return $this->belongsTo(MasterPort::class, 'destination_port_id', 'id');
    }
    
    public function dischargePortName(){
        return $this->belongsTo(MasterPort::class, 'discharge_port_id', 'id');
    }
    public function deliveryPortName(){
        return $this->belongsTo(MasterPort::class, 'delivery_port_id', 'id');
    }
    
    public function ChaName(){
        return $this->belongsTo(MasterImportParty::class, 'cha_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function shippingLine(){
        return $this->belongsTo(MasterShipping::class, 'shipping_line_id');
    }
    
    public function partyName()
    {
        return $this->belongsTo(MasterImportParty::class, 'billing_party_id');
    }
    
    public function jobMaster()
    {
        return $this->belongsTo(OperationJobMaster::class, 'job_no', 'id');
    }
    
    public function packageName()
    {
        return $this->belongsTo(MasterPackage::class, 'package_id', 'id');
    }
    
    
    
    public function agentName()
    {
        return $this->belongsTo(MasterImportParty::class, 'agent_id', 'id');
    }
    
    
    
    public function deliveryAgentName()
    {
        return $this->belongsTo(MasterImportParty::class, 'delivery_agent_id', 'id');
    }
    public function blType()
    {
        return $this->belongsTo(MasterBlType::class, 'hbl_type', 'id');
    }
    
}
