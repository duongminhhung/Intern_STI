<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CheckLoginEmployee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public $role;
    public function handle(Request $request, Closure $next): Response
    {


        if ($request->session()->has('username')) {
          
            foreach (Session::get('username')as $id) {
                $role = $id->role;
                break;
            }
        }
        
        // foreach
        if ($request->session()->has('username') && $role =='0') {
            // dd(1);
            return $next($request);
          
        }else if($request->session()->has('username') && $role =='1'){
            // return 
            return redirect()->route('admin.index');

        }else{
            return redirect('/login');

        }
    }
}
