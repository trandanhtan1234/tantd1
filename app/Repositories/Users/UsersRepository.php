<?php

namespace App\Repositories\Users;

use App\Repositories\Users\UsersRepositoryInterface;
use App\Models\models\users;

class UsersRepository implements UsersRepositoryInterface
{
    public function getList()
    {
        $getList = users::get();
        
        return $getList;
    }

    public function getUserInfo($id)
    {
        $userInfo = users::find($id);

        return $userInfo;
    }
}