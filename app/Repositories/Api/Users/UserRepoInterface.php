<?php

namespace App\Repositories\Api\Users;

interface UserRepoInterface
{
    public function getUsers($data);

    public function storeUser($params);

    public function show($id);

    public function updateUser($params, $id);

    public function destroy($id);
}