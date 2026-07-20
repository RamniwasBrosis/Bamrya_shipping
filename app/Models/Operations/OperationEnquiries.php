<?php

namespace App\Models\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MasterImportParty;
use App\Models\Operations\OperationSalesPerson;
use App\Models\MasterPort;
use App\Models\MasterShipping;
use App\Models\MasterCharge;
use App\Models\User;

class OperationEnquiries extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function BuyChargeDetails()
    {
        return $this->belongsTo(MasterCharge::class, 'buy_charge_id');
    }

    public function SellingChargeDetails()
    {
        return $this->belongsTo(MasterCharge::class, 'selling_charge_id');
    }
    
    public function shippingLine()
    {
        return $this->belongsTo(MasterShipping::class, 'shipping_line_id');
    }
    
    public function salesPerson()
    {
        return $this->belongsTo(OperationSalesPerson::class, 'sales_person_id');
    }

    public function importPartyDetails()
    {
        return $this->belongsTo(MasterImportParty::class, 'consignee_id');
    }

    public function loadingPortDetails()
    {
        return $this->belongsTo(MasterPort::class, 'loading_port_id');
    }

    public function dischargePortDetails()
    {
        return $this->belongsTo(MasterPort::class, 'discharge_port_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
