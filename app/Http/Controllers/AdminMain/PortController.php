<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PortController extends Controller
{
    public function index(){
        return view('admin-main.admin.ports.index');
    }

    public function create(){
        return view('admin-main.admin.ports.create');
    }

    public function edit(){
        return view('admin-main.admin.ports.edit');
    }
}
