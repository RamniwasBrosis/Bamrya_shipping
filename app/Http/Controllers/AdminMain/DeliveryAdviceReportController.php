<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeliveryAdviceReportController extends Controller
{
    public function first(){
        return view('admin-main.admin.deliveryAdviceReport.first');
    }

    public function index(){
        return view('admin-main.admin.deliveryAdviceReport.index');
    }

    public function create(){
        return view('admin-main.admin.deliveryAdviceReport.create');
    }

    public function edit(){
        return view('admin-main.admin.deliveryAdviceReport.edit');
    }
}
