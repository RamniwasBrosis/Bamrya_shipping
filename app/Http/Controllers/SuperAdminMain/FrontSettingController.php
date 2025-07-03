<?php


namespace App\Http\Controllers\superadminmain;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontSettingController extends Controller
{
    public function contactsetting(){
        return view('super-admin-main.super-admin.front-setting.contact_setting');
    }

    public function footersetting(){
        return view('super-admin-main.super-admin.front-setting.footer_setting');
    }
}
