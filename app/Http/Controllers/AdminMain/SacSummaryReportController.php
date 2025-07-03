<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SacSummaryReportController extends Controller
{
    public function first(){
        return view('admin-main.admin.sacSummaryReport.first');
    }

    public function index(){
        return view('admin-main.admin.sacSummaryReport.index');
    }

    public function create(){
        return view('admin-main.admin.sacSummaryReport.create');
    }

    public function edit(){
        return view('admin-main.admin.sacSummaryReport.edit');
    }
}
