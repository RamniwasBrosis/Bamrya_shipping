<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Company extends Authenticatable
{

    protected $fillable = [
        'company_name',
        'company_email',
        'company_phone',
        'address',
        'website'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function companyBranch()
    {
        return $this->hasOne(CompanyBranch::class);
    }
    
    public function companySetting()
    {
        return $this->hasOne(CompanySetting::class);
    }

}