<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShippingLineController extends Controller
{
    public function index(){
        return view('admin-main.admin.shipping.index');
    }

    public function create(){
        return view('admin-main.admin.shipping.create');
    }

    public function edit(){
        return view('admin-main.admin.shipping.edit');
    }
}
