<?php

namespace App\Repositories\Users;

use App\Repositories\Users\UsersRepositoryInterface;
use Illuminate\Support\Facades\Log;
use App\Models\models\users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;

class UsersRepository implements UsersRepositoryInterface
{
    public function getList()
    {
        $getList = users::orderBy('id', 'DESC')->paginate(5);
        
        return $getList;
    }

    public function getAll()
    {
        $getAll = users::get();

        return $getAll;
    }

    public function getUserInfo($id)
    {
        $userInfo = users::find($id);

        return $userInfo;
    }

    public function addUser($params)
    {
        try {
            DB::beginTransaction();
            $user = new users();
            $user->email = $params['email'];
            $user->password = Hash::make($params['password']);
            $user->full = $params['full'];
            $user->address = $params['address'];
            $user->phone = $params['phone'];
            $user->level = $params['level'];
            $user->save();
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => 'Add User Successfully'
            ];
            return $result;
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());

            $result = [
                'code' => 500,
                'msg' => 'Add User Failed'
            ];
            return $result;
        }
    }

    public function editUser($id, $params)
    {
        try {
            DB::beginTransaction();
            $user = users::find($id);
            $user->full = $params['full'];
            $user->address = $params['address'];
            $user->phone = $params['phone'];
            $user->level = $params['level'];
            $user->save();
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => 'Edit User successfully'
            ];
            return $result;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());

            $result = [
                'code' => 500,
                'msg' => 'Edit User failed'
            ];
            return $result;
        }
    }

    public function delUser($id)
    {
        try {
            DB::beginTransaction();
            $user = users::find($id);
            $user->delete();
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => 'Delete User Successfully'
            ];

            return $result;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());

            $result = [
                'code' => 500,
                'msg' => 'Something went wrong. Please try again later'
            ];

            return $result;
        }
    }
}