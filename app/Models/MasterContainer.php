<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class MasterContainer extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'container_no',
        'size',
        'category',
        'status','user_id'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
