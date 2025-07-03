<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DSRReportController extends Controller
{
    public function first(){
        return view('admin-main.admin.dsrReport.first');
    }

    public function index(){
        return view('admin-main.admin.dsrReport.index');
    }

    public function create(){
        return view('admin-main.admin.dsrReport.create');
    }

    public function edit(){
        return view('admin-main.admin.dsrReport.edit');
    }
}
