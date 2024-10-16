<?php

namespace App\Repositories\Customer;

use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Models\models\customer;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerRegister;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function index()
    {
        $customers = customer::orderBy('id', 'DESC')->paginate(5);

        return $customers;
    }

    public function addCustomer($params)
    {
        try {
            DB::beginTransaction();
            $customer = new customer();
            $customer->email = $params['email'];
            $customer->password = Hash::make($params['password']);
            $customer->full = $params['full'];
            $customer->address = $params['address'];
            $customer->phone = $params['phone'];
            $customer->save();

            Mail::to($params['email'])->send(new CustomerRegister($params));
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => 'Registered Successfully!'
            ];
            return $result;
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());

            $result = [
                'code' => 500,
                'msg' => 'Registered Failed!'
            ];
            return $result;
        }
    }

    public function show($id)
    {
        $customer = customer::find($id);

        return $customer;
    }
}