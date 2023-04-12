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

    protected $messages = [
        'name.required' => 'Tên đăng nhập chưa được điền.',
        'email.required' => 'Email chưa được điền.',
        'name.unique' => 'Tên đăng nhập đã tồn tại.',
        'email.unique' => 'Email đã tồn tại.',
        'email.email' => 'Email không đúng định dạng.',
        'password.min' => 'Mật khẩu chưa đủ 6 ký tự.',
        'password.same' => 'Mật khẩu phải trùng xác nhận mật khẩu.',
        'password_confirmation.min' => 'Mật khẩu chưa đủ 6 ký tự.',
        
    ];
  
    public function register()
    {
        $this->registerForm = !$this->registerForm;
    }

    public function registerStore()
    {
        $v = $this->validate([
            'name' => 'required|unique:users',
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