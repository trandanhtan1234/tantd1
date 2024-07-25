<?php

namespace App\Repositories\Users;

interface UsersRepositoryInterface
{
    public function getList();

    public function getUserInfo($id);
}