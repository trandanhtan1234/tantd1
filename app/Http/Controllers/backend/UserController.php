<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Users\UsersRepositoryInterface;
use App\Http\Requests\{AddUserRequest,EditUserRequest};
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

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

    public function postEditUser(EditUserRequest $r, $id)
    {
        $user = $this->userRepo->editUser($id, $r);

        if ($user['code'] == 200) {
            return redirect('/admin/user')->with('success', $user['msg']);
        } else {
            return redirect('/admin/user')->with('failed', $user['msg']);
        }
    }

    public function getDeleteUser($id)
    {
        $delUser = $this->userRepo->delUser($id);
        
        if ($delUser['code'] == 200) {
            return redirect()->back()->with('success', $delUser['msg']);
        } else {
            return redirect()->back()->with('failed', $delUser['msg']);
        }
    }

    public function exportUsers()
    {
        $users = $this->userRepo->getAll();
        
        return Excel::download(new UsersExport($users), 'users.xlsx');
    }
}
