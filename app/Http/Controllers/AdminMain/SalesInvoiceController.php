<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesInvoiceController extends Controller
{
    public function index(){
        return view('admin-main.admin.salesInvoice.index');
    }

    public function create(){
        return view('admin-main.admin.salesInvoice.create');
    }

    public function edit(){
        return view('admin-main.admin.salesInvoice.edit');
    }
}
