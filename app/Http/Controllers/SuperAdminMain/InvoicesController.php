<?php

namespace App\Http\Controllers\superadminmain;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function index(){
        return view('super-admin-main.super-admin.Invoices.index');
    }
}
