<?php

namespace App\Repositories\Order;

use App\Repositories\Order\OrderRepositoryInterface;
use App\Models\models\{Order,Orderdetail,Product,Customer};
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;

class OrderRepository implements OrderRepositoryInterface
{
    const error_msg = 'Something went wrong. Please try again later!';

    public function orderIndex()
    {
        $orders = Order::orderBy('id', 'DESC')->paginate(5);

        return $orders;
    }

    public function detailOrder($id)
    {
        $order = Order::find($id);

        return $order;
    }

    public function approveOrder($params,$id)
    {
        try {
            DB::beginTransaction();
            if ($params['status'] == 2) {
                $detailOrder = Orderdetail::where('order_id', $id)->get();
                foreach ($detailOrder as $prd) {
                    $product = Product::where('code', $prd['code'])->first();
                    $product->quantity = $product->quantity + $detailOrder->quantity;
                    $product->save();
                }
            }

            $order = Order::find($id);
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
        $orders = Order::where('status', 1)->paginate(5);

        return $orders;
    }

    public function getCustomers()
    {
        $customers = Customer::get();

        return $customers;
    }
}