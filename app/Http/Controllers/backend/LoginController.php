<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('backend.login.login');
    }

    public function postLogin(LoginRequest $r)
    {
        $credentials = $r->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/admin');
        } else {
            return redirect('login')->withInput()->with('failed', 'Email or Password is incorrect!');
        }
    }
}
