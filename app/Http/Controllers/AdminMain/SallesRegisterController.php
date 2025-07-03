<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SallesRegisterController extends Controller
{
    public function first(){
        return view('admin-main.admin.sallesRegister.first');
    }

    public function index(){
        return view('admin-main.admin.sallesRegister.index');
    }

    public function create(){
        return view('admin-main.admin.sallesRegister.create');
    }

    public function edit(){
        return view('admin-main.admin.sallesRegister.edit');
    }
}
