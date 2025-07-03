<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GstPayableReportController extends Controller
{
    public function first(){
        return view('admin-main.admin.gstPayableReport.first');
    }

    public function index(){
        return view('admin-main.admin.gstPayableReport.index');
    }

    public function create(){
        return view('admin-main.admin.gstPayableReport.create');
    }

    public function edit(){
        return view('admin-main.admin.gstPayableReport.edit');
    }
}
