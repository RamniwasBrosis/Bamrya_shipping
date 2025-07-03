<?php

namespace App\Models\Operations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationAllFileUpload extends Model
{
    use HasFactory;

    Protected $fillable = ['company_id', 'uuid', 'file_name', 'file_path', 'file_type', 'file_related'];
}
