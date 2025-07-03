<?php

namespace App\Http\Controllers\superadminmain;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompaniesController extends Controller
{
    public function index(){
        return view('super-admin-main.super-admin.companies.index');
    }

    public function create(){
        return view('super-admin-main.super-admin.companies.create');
    }

    public function edit(){
        return view('super-admin-main.super-admin.companies.edit');
    }
}
