<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProformaInvoiceController extends Controller
{
    public function index(){
        return view('admin-main.admin.proformaInvoice.index');
    }

    public function create(){
        return view('admin-main.admin.proformaInvoice.create');
    }

    public function edit(){
        return view('admin-main.admin.proformaInvoice.edit');
    }
}
