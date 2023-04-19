<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
// use Session;
class LoginContrller extends Controller
{
    public function viewlogin()
    {
        return view('admin.login');
    }
    public function viewregister(){
        return view('admin.register');
    }
    public function viewlogin_en(){
        return view('admin.login_en');
    }
    public function logout(){
        if(session()->has('username')){
            Session::forget('username'); 
            return redirect()->route('login');
        }else{
            return redirect()->route('login1');
        }
    }

}