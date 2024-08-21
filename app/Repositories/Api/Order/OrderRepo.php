<?php

namespace App\Repositories\Api\Order;

use App\Repositories\Api\Order\OrderRepoInterface;
use App\Models\models\order;

class OrderRepo implements OrderRepoInterface
{
    public function index($data)
    {
        $limit = $data['limit']?$data['limit']:10;
        $order = order::orderBy('id', 'DESC')->paginate($limit);

        if (!$order) {
            return response()->json([
                config('constparam.code') => 404,
                config('constparam.msg') => config('constparam.not_found')
            ],404);
        }

        return response()->json([
            config('constparam.code') => 200,
            config('constparam.msg') => config('constparam.success_msg')
        ]);
    }
}