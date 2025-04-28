<?php

namespace App\Repositories\Order;

use App\Repositories\Order\OrderRepositoryInterface;
use App\Models\models\{Order,Orderdetail,Product,Customer,Variants};
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
        $details = Orderdetail::where('order_id',$id)->get();

        return [
            'order' => $order,
            'details' => $details
        ];
    }

    public function approveOrder($params,$id)
    {
        try {
            DB::beginTransaction();
            if ($params['status'] == 2) {
                $detailOrder = Orderdetail::where('order_id', $id)->get();
                foreach ($detailOrder as $prd) {
                    $variant = Variants::find($prd->var_id);
                    $variant->quantity = $variant->quantity + $prd->quantity;
                    $productId = $variant->product_id;
                    $variant->save();

                    // Update product status to In Stock if product is refunded
                    $product = Product::find($productId);
                    $product->status = 1;
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