<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Users\UsersRepositoryInterface;
use App\Http\Requests\AddUserRequest;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(
        UsersRepositoryInterface $userRepo
    ) {
        $this->userRepo = $userRepo;
    }

    public function getListUsers()
    {
        $data['users'] = $this->userRepo->getList();

        return view('backend.user.listuser', $data);
    }

    public function getAddUser()
    {
        return view('backend.user.adduser');
    }

    public function postAddUser(AddUserRequest $r)
    {
        $addUser = $this->userRepo->addUser($r);

        if ($addUser['code'] == 200) {
            return redirect('/admin/user')->with('success', $addUser['msg']);
        } else {
            return redirect('/admin/user')->with('failed', $addUser['msg']);
        }
    }

    public function getEditUser($id)
    {
        $data['user'] = $this->userRepo->getUserInfo($id);

        return view('backend.user.edituser', $data);
    }
}
