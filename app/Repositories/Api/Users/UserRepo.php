<?php

namespace App\Repositories\Api\Users;

use App\Repositories\Api\Users\UserRepoInterface;
use App\Models\models\users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserRepo implements UserRepoInterface
{
    const successMsg = 'Get Data Successfully!';
    const noUserError = 'Invalid user ID!';

    public function getUsers()
    {
        $listUsers = users::get();

        return response()->json([
            config('constparam.error_code') => config('constparam.success'),
            'message' => static::successMsg,
            'data' => $listUsers
        ],200);
    }

    public function findId($id)
    {
        $user = users::find($id);
        
        if (count($user)==0) {
            return response()->json([
                config('constparam.error_code') => config('constparam.fail'),
                config('constparam.error_mess') => static::noUserError
            ],404);
        }
        return response()->json([
            config('constparam.error_code') => config('constparam.success'),
            config('constparam.error_mess') => static::successMsg,
            'data' => $user
        ],200);
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $user = users::find($id);
            if (!$user) {
                return response()->json([
                    config('constparam.error_code') => config('constparam.fail'),
                    config('constparam.error_mess') => static::noUserError
                ],400);
            }
            users::destroy($id);
            DB::commit();

            return response()->json([
                config('constparam.error_code') => config('constparam.success'),
                config('constparam.error_mess') => static::successMsg
            ],200);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json([
                'message'
            ],500);
        }
    }
}