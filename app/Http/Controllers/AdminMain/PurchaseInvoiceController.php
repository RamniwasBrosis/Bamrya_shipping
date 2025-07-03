<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseInvoiceController extends Controller
{
    public function index(){
        return view('admin-main.admin.purchaseInvoice.index');
    }

    public function create(){
        return view('admin-main.admin.purchaseInvoice.create');
    }

    public function edit(){
        return view('admin-main.admin.purchaseInvoice.edit');
    }
}
