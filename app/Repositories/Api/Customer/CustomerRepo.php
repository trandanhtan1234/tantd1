<?php

namespace App\Repositories\Api\Customer;

use App\Repositories\Api\Customer\CustomerRepoInterface;
use App\Models\models\Customer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerRegister;

class CustomerRepo implements CustomerRepoInterface
{
    public function index($data)
    {
        $limit = isset($data['limit']) && ctype_digit($data['limit']) ? $data['limit'] : 10;
        $customer = Customer::orderBy('id', 'DESC')->paginate($limit);

        if (!$customer->all()) {
            return response()->json([
                config('constparam.code') => 404,
                config('constparam.msg') => config('constparam.not_found')
            ],400);
        }

        return response()->json([
            config('constparam.code') => 200,
            config('constparam.msg') => config('constparam.success_msg'),
            config('constparam.result') => $customer
        ],200);
    }

    public function store($params)
    {
        try {
            DB::beginTransaction();
            $customer = new Customer();
            $customer->email = $params['email'];
            $customer->password = Hash::make($params['password']);
            $customer->full = $params['full'];
            $customer->address = $params['address'];
            $customer->phone = $params['phone'];

            Mail::to($params['email'])->send(new CustomerRegister($params));
            DB::commit();

            return response()->json([
                config('constparam.code') => 200,
                config('constparam.msg') => config('constparam.success_msg')
            ],200);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());

            return response()->json([
                config('constparam.code') => 500,
                config('constparam.msg') => config('constparam.fails_msg')
            ],500);
        }
    }

    public function show($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                config('constparam.code') => 404,
                config('constparam.msg') => config('constparam.not_found')
            ],404);
        }

        return response()->json([
            config('constparam.code') => 200,
            config('constparam.msg') => config('constparam.success_msg'),
            config('constparam.result') => $customer
        ],200);
    }

    public function update($params,$id)
    {
        try {
            DB::beginTransaction();
            $customer = Customer::find($id);
            if (!$customer) {
                return response()->json([
                    config('constparam.code') => config('constparam.invalid_msg'),
                    config('constparam.msg') => config('constparam.not_found')
                ],404);
            }

            $customer->full = $params['full'];
            $customer->email = $params['email'];
            $customer->address = $params['address'];
            $customer->phone = $params['phone'];
            DB::commit();

            return response()->json([
                config('constparam.code') => 200,
                config('constparam.msg') => config('constparam.success_msg')
            ],200);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());

            return response()->json([
                config('constparam.code') => 500,
                config('constparam.msg') => config('constparam.fails_msg')
            ],500);
        }
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                config('constparam.code') => 404,
                config('constparam.msg') => config('constparam.not_found')
            ],404);
        }

        Customer::destroy($id);

        return response()->json([
            config('constparam.code') => 200,
            config('constparam.msg') => config('constparam.success_msg')
        ],200);
    }
}