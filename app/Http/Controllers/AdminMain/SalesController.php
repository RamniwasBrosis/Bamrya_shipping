<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function first(){
        return view('admin-main.admin.sales.first');
    }

    public function index(){
        return view('admin-main.admin.sales.index');
    }

    public function create(){
        return view('admin-main.admin.sales.create');
    }

    public function edit(){
        return view('admin-main.admin.sales.edit');
    }
}
