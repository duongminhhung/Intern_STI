<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginContrller extends Controller
{
    public function viewlogin()
    {
        return view('admin.login');
    }
    public function viewregister(){
        return view('admin.register');
    }
}