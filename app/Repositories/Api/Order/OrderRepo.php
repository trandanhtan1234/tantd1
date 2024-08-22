<?php

namespace App\Repositories\Api\Order;

use App\Repositories\Api\Order\OrderRepoInterface;
use App\Models\models\order;

class OrderRepo implements OrderRepoInterface
{
    public function index($data)
    {
        $limit = $data['limit']?$data['limit']:10;
        $orders = order::orderBy('id', 'DESC')->paginate($limit);

        if (!$orders) {
            return response()->json([
                config('constparam.code') => 404,
                config('constparam.msg') => config('constparam.not_found')
            ],404);
        }

        return response()->json([
            config('constparam.code') => 200,
            config('constparam.msg') => config('constparam.success_msg'),
            config('constparam.result') => $orders
        ]);
    }

    public function show($id)
    {
        $order = order::find($id);

        if (!$order) {
            return response()->json([
                config('constparam.code') => 404,
                config('constparam.msg') => config('constparam.not_found')
            ],404);
        }

        return response()->json([
            config('constparam.code') => 200,
            config('constparam.msg') => config('constparam.success_msg'),
            config('constparam.result') => $order->detail
        ],200);
    }
}