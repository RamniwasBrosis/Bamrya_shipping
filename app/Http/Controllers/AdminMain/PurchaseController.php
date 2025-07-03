<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function first(){
        return view('admin-main.admin.purchase.first');
    }

    public function index(){
        return view('admin-main.admin.purchase.index');
    }

    public function create(){
        return view('admin-main.admin.purchase.create');
    }

    public function edit(){
        return view('admin-main.admin.purchase.edit');
    }
}
