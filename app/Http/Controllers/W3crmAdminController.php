<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Http\Request;

class W3crmAdminController extends Controller
{
    public function dashboard_2(){
        // $A = Auth::user()->email;
        return view('w3crm.dashboard.index_2');
    }

    public function dashboard(){
		$page_title = 'Dashboard';
        $page_description = 'Some description for the page';
		return view('w3crm.dashboard.index', compact('page_title', 'page_description'));
	}

    public function page_login (){
        $page_title = 'Login';
        $page_description = 'Some description for the page';
        return view('w3crm.page.login', compact('page_title', 'page_description'));
    }
    
    public function login(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (!$user) {
            return back()->withErrors(['email' => 'Email not found']);
        }
    
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Incorrect password']);
        }
    
        Auth::login($user); 
    
        // return redirect()->intended('/admin/dashboard');
        return redirect()->route('dashboard')->with('success', "user successgfully....!");
    }
    
    // public function logout(Request $request)
    // {
    //     $user = auth()->user();
    //     $this->guard()->logout();

    //     $request->session()->invalidate();
    //     if (module_enabled('Subdomain')) {
    //         if ($user->super_admin == 1) {
    //             return $this->loggedOut($request) ?: redirect(route('front.super-admin-login'));
    //         }
    //     }

    //      return $this->loggedOut($request) ?: redirect('/');
    // }
    
    public function logout(Request $request)
    {
        Auth::logout();
    
        return redirect('/');
    }

    
    public function page_register(){
        $page_title = 'Register';
        $page_description = 'Some description for the page';
        return view('w3crm.page.register', compact('page_title', 'page_description'));
    }
    public function page_forgot_password(){
        $page_title = 'Forgot Password';
        $page_description = 'Some description for the page';
        return view('w3crm.page.forgot_password', compact('page_title', 'page_description'));
    }

    public function page_error_400(){
        $page_title = 'Error 400';
        $page_description = 'Some description for the page';
        return view('w3crm.page.error_400', compact('page_title', 'page_description'));
    }
    public function page_error_403(){
        $page_title = 'Error 403';
        $page_description = 'Some description for the page';
        return view('w3crm.page.error_403', compact('page_title', 'page_description'));
    }
    public function page_error_404(){
        $page_title = 'Error 404';
        $page_description = 'Some description for the page';
        return view('w3crm.page.error_404', compact('page_title', 'page_description'));
    }
    public function page_error_500(){
        $page_title = 'Error 500';
        $page_description = 'Some description for the page';
        return view('w3crm.page.error_500', compact('page_title', 'page_description'));
    }
    public function page_error_503(){
        $page_title = 'Error 503';
        $page_description = 'Some description for the page';
        return view('w3crm.page.error_503', compact('page_title', 'page_description'));
    }
}
