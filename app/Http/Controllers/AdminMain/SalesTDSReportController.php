<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesTDSReportController extends Controller
{
    public function first(){
        return view('admin-main.admin.salesTDSReport.first');
    }

    public function index(){
        return view('admin-main.admin.salesTDSReport.index');
    }

    public function create(){
        return view('admin-main.admin.salesTDSReport.create');
    }

    public function edit(){
        return view('admin-main.admin.salesTDSReport.edit');
    }
}
