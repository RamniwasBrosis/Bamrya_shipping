<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function index(){
        return view('admin-main.admin.receipt.index');
    }

    public function create(){
        return view('admin-main.admin.receipt.create');
    }

    public function edit(){
        return view('admin-main.admin.receipt.edit');
    }
}
