<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


use Illuminate\Validation\Rules\Password;
class FormLogin extends Component
{
    public $users, $email, $password, $name, $password_confirmation, $password_login,$name_login;
    public $registerForm = false;

    public function render()
    {
        return view('livewire.form-login');

    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }
    protected $rules = [
        'name' => 'required|min:3',
    ];
    protected $messages = [
        'name_login.required' => 'Tên đăng nhập chưa được điền.',
        'password_login.required' => 'Mật khẩu chưa được điền.',
        // 'name.min' => 'The :attribute field must be at least :min characters.',
    ];
   


    public function login(Request $request)
    {
        $validatedDate = $this->validate([
            'name_login' => 'required',
            'password_login' => 'required',
        ]);


        // protected $messages = [
        //     'email.required' => 'The Email Address cannot be empty.',
        //     'email.email' => 'The Email Address format is not valid.',
        // ];
       
        $name_login = $this->name_login;
        $password_login = $this->password_login;

        $password_login = md5($password_login);

        // dd($name_login);
        // dd($password_login);
        // dd(Auth::attempt(['name' => $name_login, 'password' => $password_login,])->toSql());
    //     if(\Auth::attempt(array('name' => $name_login, 'password' => $password_login))){
    //         // session()->flash('message', "You are Login successful.");
    //         dd(1);
    // }else{
    //     // session()->flash('error', 'email and password are wrong.');
    //     dd(2);
    // }
    // dd(\Auth::attempt(array('name' => $name_login, 'password' => $password_login)));
        
        $users = DB::table('users')
        ->where([
            ['name', '=', $name_login],
            ['password', '=', $password_login],
        ])->get();

        // dd($users);
        if(count($users) == 1){
            Session::put('username', $users);
           
            
            return redirect()->route('admin.index');



        }else{
            dd(2);
        }

    }
    

    public function register()
    {
        $this->registerForm = !$this->registerForm;
    }

   
}