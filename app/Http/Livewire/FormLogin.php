<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;


use Illuminate\Validation\Rules\Password;
class FormLogin extends Component
{
    public $users, $email, $password, $name, $password_confirmation, $password_login,$name_login;
    public $registerForm = false;

    public function render()
    {
        return view('livewire.form-login')->layout('layouts.app');

    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    public function login()
    {
        $validatedDate = $this->validate([
            'name_login' => 'required',
            'password_login' => 'required',
        ]);
        $name_login = $this->name_login;
        $password_login = $this->password_login;

        $password_login = md5($password_login);

        // dd($name_login);
        $users = DB::table('users')
        ->where([
            ['name', '=', $name_login],
            ['password', '=', $password_login],
        ])
        ->count();
        if($users == 1){
            return redirect()->route('welcome');


        }else{
            dd(2);
        }

    }

    public function register()
    {
        $this->registerForm = !$this->registerForm;
    }

   
}