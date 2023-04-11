<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Register extends Component
{
    public function render()
    {
        return view('livewire.register');
    }

    public $users, $email, $password, $name, $password_confirmation, $password_login, $name_login;
    public $registerForm = false;

 

    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

  
    public function register()
    {
        $this->registerForm = !$this->registerForm;
    }

    public function registerStore()
    {
        $v = $this->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);

        $password = md5($this->password);
        $name = $this->name;
        $email = $this->email;
        // dd($email);
        // dd($this->password);
        // $data = [
        //     'name' => $this->name,
        //     'email' => $this->email,
        //     'password' => $this->password
        // ];

        // User::create($data);
        DB::table('users')->insert(
            [
                'name'=>$name,
                'email'=>$email,
                'password'=>$password
                
            ]
        );

        session()->flash('message', 'Sign Up Success.');
        return redirect()->route('welcome');

        $this->resetInputFields();
    }
}