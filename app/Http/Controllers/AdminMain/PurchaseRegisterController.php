<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseRegisterController extends Controller
{
    public function first(){
        return view('admin-main.admin.purchaseRegister.first');
    }

    public function index(){
        return view('admin-main.admin.purchaseRegister.index');
    }

    public function create(){
        return view('admin-main.admin.purchaseRegister.create');
    }

    public function edit(){
        return view('admin-main.admin.purchaseRegister.edit');
    }
}
