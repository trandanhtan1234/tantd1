<?php

namespace App\Repositories\Cart;

use App\Repositories\Cart\CartRepositoryInterface;
use Cart;
use App\Models\models\{product,customer,order,orderdetail};
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;

class CartRepository implements CartRepositoryInterface
{
    const error_msg = 'Something went wrong. Please try again later!';

    public function addCart($params)
    {
        $prd = product::find($params['product_id']);

        Cart::add([
            'id' => $prd->id,
            'name' => $prd->name,
            'qty' => $params->quantity,
            'price' => getPrice($prd,$params->attr),
            'weight' => 0,
            'options' => ['img' => $prd->img, 'attr' => $params->attr]
        ]);

        return true;
    }

    public function getCart()
    {
        $data['cart'] = Cart::content();
        $data['total'] =Cart::total();
        $data['count'] = Cart::count();

        return $data;
    }

    public function updateCart($rowId,$qty)
    {
        try {
            DB::beginTransaction();
            $update = Cart::update($rowId,$qty);
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => 'Update quantity successfully!'
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

    public function postCheckout($params)
    {
        try {
            DB::beginTransaction();
            $checkCustomer = customer::where('email', $params['email'])->count();
            if (!$checkCustomer) {
                $customer = new customer();
                $customer->email = $params['email'];
                $customer->full = $params['fname'];
                $customer->address = $params['address'];
                $customer->phone = $params['phone'];
                $customer->save();
                $customerId = $customer->id;
            } else {
                $customerId = customer::where('email', $params['email'])->first()->id;
            }

            $order = new order();
            $order->total = str_replace('.','',Cart::total());
            $order->address = $params['address'];
            $order->status = 0;
            $order->customer_id = $customerId;
            $order->save();
            $orderId = $order->id;

            foreach (Cart::content() as $prd) {
                $orderDetail = new orderdetail();
                $orderDetail->code = product::where('id', $prd->id)->first()->code;
                $attrs = [];
                foreach ($prd->options->attr as $attr) {
                    $attrs[] = $attr;
                }
                $orderDetail->name = $prd->name.'-'.implode('-',$attrs);
                $orderDetail->price = $prd->price;
                $orderDetail->quantity = $prd->qty;
                $orderDetail->img = $prd->options->img;
                $orderDetail->order_id = $orderId;
                $orderDetail->save();
            }
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => 'Checkout completed!'
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

    public function deleteProduct($id)
    {
        try {
            DB::beginTransaction();
            $delete = Cart::destroy($id);
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => 'Delete product from Cart successfully!'
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
}