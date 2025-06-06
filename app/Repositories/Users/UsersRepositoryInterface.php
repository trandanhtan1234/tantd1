<?php

namespace App\Repositories\Users;

interface UsersRepositoryInterface
{
    public function getList($params);

    public function getAll();

    public function getUserInfo($id);

    public function addUser($params);

    public function editUser($id, $params);

    public function delUser($id);
}