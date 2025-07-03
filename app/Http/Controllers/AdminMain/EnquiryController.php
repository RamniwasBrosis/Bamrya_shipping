<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index(){
        return view('admin-main.admin.enquiry.index');
    }

    public function create(){
        return view('admin-main.admin.enquiry.create');
    }

    public function edit(){
        return view('admin-main.admin.enquiry.edit');
    }
}
