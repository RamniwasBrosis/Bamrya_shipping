<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseOutstandingController extends Controller
{
    public function first(){
        return view('admin-main.admin.purchaseOutstanding.first');
    }

    public function index(){
        return view('admin-main.admin.purchaseOutstanding.index');
    }

    public function create(){
        return view('admin-main.admin.purchaseOutstanding.create');
    }

    public function edit(){
        return view('admin-main.admin.purchaseOutstanding.edit');
    }
}
