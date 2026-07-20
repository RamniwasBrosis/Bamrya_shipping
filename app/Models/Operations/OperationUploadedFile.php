<?php

namespace App\Models\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class OperationUploadedFile extends Model
{
    use HasFactory;

    protected $fillable = ['file_name', 'file_path', 'company_id', 'uuid', 'user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
