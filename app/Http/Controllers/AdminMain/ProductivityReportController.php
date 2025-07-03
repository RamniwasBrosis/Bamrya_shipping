<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductivityReportController extends Controller
{
    public function first(){
        return view('admin-main.admin.productivityReport.first');
    }

    public function index(){
        return view('admin-main.admin.productivityReport.index');
    }

    public function create(){
        return view('admin-main.admin.productivityReport.create');
    }

    public function edit(){
        return view('admin-main.admin.productivityReport.edit');
    }
}
