<?php

namespace App\Models\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Operations\OperationSalesPerson;

use App\Models\MasterPort;
use App\Models\MasterImportParty;
use App\Models\MasterExportParty;
use App\Models\MasterShipping;
use App\Models\MasterForwarder;
use App\Models\MasterPackage;
use App\Models\User;
use App\Models\CompanyBranch;

class OperationAirExport extends Model
{
    use HasFactory;

   protected $guarded = [];

    public function salesPerson(){
        return $this->belongsTo(OperationSalesPerson::class, 'sales_person_id', 'id');
    }

    public function shipperName(){
        return $this->belongsTo(MasterExportParty::class, 'shipper_id');
    }

    public function ChaName(){
        return $this->belongsTo(MasterImportParty::class, 'cha_party_id');
    }

    public function ConsigneeName(){
        return $this->belongsTo(MasterImportParty::class, 'consignee_id');
    }

    public function notify(){
        return $this->belongsTo(MasterImportParty::class, 'notify_id');
    }

    public function LataAgentName(){
        return $this->belongsTo(MasterImportParty::class, 'lata_agent', 'id');
    }

    // ports
    public function loadingPortName(){
        return $this->belongsTo(MasterPort::class, 'loading_port_id', 'id');
    }
    public function receiptPortName(){
        return $this->belongsTo(MasterPort::class, 'receipt_port_id', 'id');
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

    public function packageName()
    {
        return $this->belongsTo(MasterPackage::class, 'package_id', 'id');
    }

    // public function shippingLine(){
    //     return $this->belongsTo(MasterShipping::class, 'sales_person_id');
    // }

    public function partyName()
    {
        return $this->belongsTo(MasterImportParty::class, 'billing_party_id');
    }
    public function jobMaster()
    {
        return $this->belongsTo(OperationJobMaster::class, 'job_no', 'id');
    }
    public function Forwarder(){
        return $this->belongsTo(MasterForwarder::class, 'forwarder_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function branch()
    {
        return $this->belongsTo(CompanyBranch::class);
    }
}
