<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JobOpencloseController extends Controller
{
    public function index(){
        return view('admin-main.admin.jobOpenClose.index');
    }

    public function create(){
        return view('admin-main.admin.jobOpenClose.create');
    }

    public function edit(){
        return view('admin-main.admin.jobOpenClose.edit');
    }
}
