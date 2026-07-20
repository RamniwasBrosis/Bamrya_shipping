<?php

namespace App\Models\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Operations\OperationTransport;
use App\Models\MasterImportParty;

class TransportContainer extends Model
{
    use HasFactory;
    
    protected $table = 'operation_transport_container';
    
    protected $guarded = [];
    
    public function transport()
    {
        return $this->belongsTo(OperationTransport::class, 'transport_id');
    }
    
    public function transporter()
    {
        return $this->belongsTo(MasterImportParty::class, 'transporter');
    }
    
}
