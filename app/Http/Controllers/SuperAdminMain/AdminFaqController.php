<?php

namespace App\Http\Controllers\superadminmain;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminFaqController extends Controller
{
    public function index(){
        return view('super-admin-main.super-admin.admin-faq.index');
    }

    public function create(){
        return view('super-admin-main.super-admin.admin-faq.create');
    }

    public function edit(){
        return view('super-admin-main.super-admin.admin-faq.edit');
    }
}
