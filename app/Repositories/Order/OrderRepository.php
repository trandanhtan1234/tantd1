<?php

namespace App\Repositories\Order;

use App\Repositories\Order\OrderRepositoryInterface;
use App\Models\models\order;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;

class OrderRepository implements OrderRepositoryInterface
{
    const error_msg = 'Something went wrong. Please try again later!';

    public function orderIndex()
    {
        $orders = order::orderBy('id', 'DESC')->paginate(5);

        return $orders;
    }

    public function detailOrder($id)
    {
        $order = order::find($id);

        return $order;
    }

    public function approveOrder($params,$id)
    {
        try {
            DB::beginTransaction();
            $order = order::find($id);
            $order->status = $params['status'];
            $order->save();
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => $params['status']==1?'Approved':'Canceled'.' Order Successfully!'
            ];
            return $result;
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());

            $result = [
                'code' => 500,
                'msg' => static::error_msg
            ];
            return $result;
        }
    }

    public function getApproved()
    {
        $orders = order::where('status', 1)->paginate(5);

        return $orders;
    }
}