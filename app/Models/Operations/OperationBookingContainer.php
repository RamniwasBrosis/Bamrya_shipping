<?php

namespace App\Models\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationBookingContainer extends Model
{
    use HasFactory;
    
    protected $table = 'operation_booking_containers';
    
    protected $fillable = [
        'company_id',
        'uuid',
        'booking_id',
        'container_category',
        'size',
        'container_no',
        'seal_no',
        'do_no'
    ];

    public function booking()
    {
        return $this->belongsTo(OperationBooking::class, 'booking_id');
    }
}
