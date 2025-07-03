<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportEnquiryController extends Controller
{
    public function first(){
        return view('admin-main.admin.reportEnquiry.index');
    }

    public function index(){
        return view('admin-main.admin.reportEnquiry.index');
    }

    public function create(){
        return view('admin-main.admin.reportEnquiry.create');
    }

    public function edit(){
        return view('admin-main.admin.reportEnquiry.edit');
    }
}
