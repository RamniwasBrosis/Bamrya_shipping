<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class PurchaseParties extends Model
{
    use HasFactory;
    
    protected $table = 'master_purchase_parties';
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}


