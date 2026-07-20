<?php

namespace App\Models\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationBookingFileUploads extends Model
{
    use HasFactory;
    
    protected $table = 'operation_booking_file_uploads';
    
    protected $fillable = [
            'company_id', 'uuid', 'file_name', 'file_path', 'booking_no'
        ];
        
    public function booking()
    {
        //
    }
}
