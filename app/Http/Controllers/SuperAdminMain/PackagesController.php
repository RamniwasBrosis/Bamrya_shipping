<?php

namespace App\Http\Controllers\superadminmain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    public function index(){
        return view('super-admin-main.super-admin.packages.index'); 
    }

    public function create(){
        return view('super-admin-main.super-admin.packages.create');
    }

    public function edit(){
        return view('super-admin-main.super-admin.packages.edit');
    }
}