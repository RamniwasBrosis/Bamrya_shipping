<?php

namespace App\Models\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationUploadedFile extends Model
{
    use HasFactory;

    protected $fillable = ['file_name', 'file_path', 'company_id', 'uuid'];
}
