<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getListUsers()
    {
        return view('backend.user.listuser');
    }

    public function getAddUser()
    {
        return view('backend.user.adduser');
    }

    public function getEditUser()
    {
        return view('backend.user.edituser');
    }
}
