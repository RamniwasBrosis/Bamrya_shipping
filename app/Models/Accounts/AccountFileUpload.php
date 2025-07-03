<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountFileUpload extends Model
{
    use HasFactory;

    Protected $fillable = ['company_id', 'uuid', 'file_name', 'file_path', 'file_type', 'file_related'];
}
