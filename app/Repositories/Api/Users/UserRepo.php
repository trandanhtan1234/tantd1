<?php

namespace App\Repositories\Api\Users;

use App\Repositories\Api\Users\UserRepoInterface;
use App\Models\models\users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserRepo implements UserRepoInterface
{
    public function getUsers($data)
    {
        $limit = isset($data['limit']) && ctype_digit($data['limit']) ? (int)$data['limit'] : 10;
        $listUsers = users::paginate($limit);

        return response()->json([
            config('constparam.code') => 200,
            config('constparam.msg') => config('constparam.success_msg'),
            config('constparam.result') => $listUsers
        ],200);
    }

    public function storeUser($params)
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
            $user->created_at = \Carbon\Carbon::now();
            $user->updated_at = \Carbon\Carbon::now();
            $user->save();
            DB::commit();

            return response()->json([
                config('constparam.code') => 200,
                config('constparam.msg') => config('constparam.success_msg')
            ],200);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                config('constparam.code') => 500,
                config('constparam.msg') => config('constparam.error_msg')
            ],500);
        }
    }

    public function findId($id)
    {
        $user = users::find($id);
        
        if (count($user)==0) {
            return response()->json([
                config('constparam.code') => 404,
                config('constparam.msg') => config('constparam.not_found')
            ],404);
        }
        return response()->json([
            config('constparam.code') => 200,
            config('constparam.msg') => config('constparam.success_msg'),
            config('constparam.result') => $user
        ],200);
    }

    public function updateUser($params, $id)
    {
        try {
            DB::beginTransaction();
            $user = users::find($id);
            if (count($user)==0) {
                return response()->json([
                    config('constparam.code') => config('constparam.invalid_msg'),
                    config('constparam.msg') => config('constparam.not_found')
                ],404);
            }
            $user->full = $params['full'];
            $user->address = $params['address'];
            $user->phone = $params['phone'];
            $user->level = $params['level'];
            $user->updated_at = \Carbon\Carbon::now();
            $user->save();
            DB::commit();

            return response()->json([
                config('constparam.code') => 200,
                config('constparam.msg') => config('constparam.fails_msg')
            ],200);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json([
                config('constparam.code') => 500,
                config('constparam.msg') => config('constparam.error_mess')
            ],500);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $user = users::find($id);
            if (!$user) {
                return response()->json([
                    config('constparam.code') => 400,
                    config('constparam.msg') => config('constparam.not_found')
                ],400);
            }
            users::destroy($id);
            DB::commit();

            return response()->json([
                config('constparam.code') => 200,
                config('constparam.msg') => config('constparam.success_msg')
            ],200);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json([
                config('constparam.code') => 500,
                config('constparam.msg') => config('constparam.error_msg')
            ],500);
        }
    }
}