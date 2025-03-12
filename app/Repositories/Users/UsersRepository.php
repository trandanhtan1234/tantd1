<?php

namespace App\Repositories\Users;

use App\Repositories\Users\UsersRepositoryInterface;
use Illuminate\Support\Facades\Log;
use App\Models\models\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterUser;
use Illuminate\Pagination\LengthAwarePaginator;

class UsersRepository implements UsersRepositoryInterface
{
    const failed_msg = 'Something went wrong, please try again later!';

    public function getList($params)
    {
        $filters = $params->only(['full','email']);
        $filters = array_filter($filters);

        if ($filters != $params->query()) {
            return redirect()->route('user', $filters);
        }

        $query = Users::query();
        if (!empty($filters['full'])) {
            $query->where('full','like','%'.$filters['full'].'%');
        }
        if (!empty($filters['email'])) {
            $query->where('email','like','%'.$filters['email'].'%');
        }
        
        return view('backend.user.listuser', [
            'users' => $query->orderBy('id', 'DESC')->paginate(5)->appends($filters)
        ]);
    }

    public function getAll()
    {
        $getAll = Users::get();

        return $getAll;
    }

    public function getUserInfo($id)
    {
        $userInfo = Users::find($id);

        return $userInfo;
    }

    public function addUser($params)
    {
        try {
            DB::beginTransaction();
            $user = new Users();
            $user->email = $params['email'];
            $user->password = Hash::make($params['password']);
            $user->full = $params['full'];
            $user->address = $params['address'];
            $user->phone = $params['phone'];
            $user->level = $params['level'];
            $user->save();

            Mail::to($params['email'])->send(new RegisterUser($params->all()));
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
                'msg' => static::failed_msg
            ];
            return $result;
        }
    }

    public function editUser($id, $params)
    {
        try {
            DB::beginTransaction();
            $user = Users::find($id);
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
                'msg' => static::failed_msg
            ];
            return $result;
        }
    }

    public function delUser($id)
    {
        try {
            DB::beginTransaction();
            Users::destroy($id);
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
                'msg' => static::failed_msg
            ];

            return $result;
        }
    }
}