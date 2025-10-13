<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email = '';
    public $password = '';

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    protected $messages = [
        'email.required' => 'Enter your email address.',
        'email.email' => 'Email is invalid',
        'password.required' => 'This field is required'
    ];

    public function login()
    {
        $credentials = [
            'email' => $this->email,
            'password' => $this->password
        ];

        if (Auth::guard('web')->attempt($credentials)) {
            session(['login_time' => now()]);

            /** @var App\Models\models\Users $user */
            $user = Auth::user();
            $user->last_login = \Carbon\Carbon::now();
            $user->save();
            
            return redirect('/admin');
        } else {
            return redirect('login')->withInput()->with('failed', 'Email or Password is incorrect!');
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
