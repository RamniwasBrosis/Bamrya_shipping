<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchasePaymentController extends Controller
{
    public function index(){
        return view('admin-main.admin.purchasePayment.index');
    }

    public function create(){
        return view('admin-main.admin.purchasePayment.create');
    }

    public function edit(){
        return view('admin-main.admin.purchasePayment.edit');
    }
}
