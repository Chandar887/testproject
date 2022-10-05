<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegister extends Component
{
    public $users, $email, $password, $name;
    public $registerForm = false;

    public function render()
    {
        return view('livewire.login-register');
    }

    private function resetInputFields(){
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    public function login()
    {
        $validatedDate = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if(Auth::attempt(array('email' => $this->email, 'password' => $this->password))){
                return redirect('/dashboard');
        } else {
            session()->flash('error', 'email and password are wrong.');
        }
    }

    public function register()
    {
        $this->registerForm = !$this->registerForm;
    }

    public function registerStore()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $hashedPassword = Hash::make($this->password); 

        User::create(['name' => $this->name, 'email' => $this->email,'password' => $hashedPassword]);

        if(Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect('/dashboard');
        } else {
            session()->flash('error', 'Something went wrong, Please try again.');
        }

        $this->resetInputFields();
    }
}
