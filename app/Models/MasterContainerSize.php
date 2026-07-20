<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class MasterContainerSize extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'cont_type',
        'description',
        'iso_code',
        'status','user_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
