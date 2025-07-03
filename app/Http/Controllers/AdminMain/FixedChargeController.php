<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FixedChargeController extends Controller
{
    public function index(){
        return view('admin-main.admin.fixedCharge.index');
    }

    public function create(){
        return view('admin-main.admin.fixedCharge.create');
    }

    public function edit(){
        return view('admin-main.admin.fixedCharge.edit');
    }
}
