<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class MasterShipping extends Model
{
    use HasFactory;
    
    protected $table = 'master_shippings';

    protected $fillable = [
        'company_id',
        'shipping_line_code',
        'shipping_line_name',
        'address_line_1',
        'address_line_2',
        'agent_code',
        'line_code',
        'shipping_line_type',
        'status','user_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
