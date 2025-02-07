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
            $user = Auth::user();
            $user->last_login = \Carbon\Carbon::now();
            $user->save();
            return redirect('/admin');
        } else {
            return redirect('login')->withInput()->with('failed', 'Email or Password is incorrect!');
        }
    }

    public function getLogout()
    {
        Auth::logout();

        return redirect('/login');
    }
}
