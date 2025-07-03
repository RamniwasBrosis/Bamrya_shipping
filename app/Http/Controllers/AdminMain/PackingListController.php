<?php

namespace App\Http\Controllers\AdminMain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackingListController extends Controller
{
    public function index(){
        return view('admin-main.admin.packingList.index');
    }

    public function create(){
        return view('admin-main.admin.packingList.create');
    }

    public function edit(){
        return view('admin-main.admin.packingList.edit');
    }
}
