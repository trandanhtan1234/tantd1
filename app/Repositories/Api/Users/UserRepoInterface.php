<?php

namespace App\Repositories\Api\Users;

interface UserRepoInterface
{
    public function getUsers();

    public function findId($id);

    public function destroy($id);
}