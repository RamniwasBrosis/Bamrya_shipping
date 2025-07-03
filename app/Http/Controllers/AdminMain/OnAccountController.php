<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OnAccountController extends Controller
{
    public function index(){
        return view('admin-main.admin.onAccount.index');
    }

    public function create(){
        return view('admin-main.admin.onAccount.create');
    }

    public function edit(){
        return view('admin-main.admin.onAccount.edit');
    }
}
