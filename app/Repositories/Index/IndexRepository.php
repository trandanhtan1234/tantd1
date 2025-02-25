<?php

namespace App\Repositories\Index;

use App\Repositories\Index\IndexRepositoryInterface;
use Carbon\Carbon;
use App\Models\models\Order;

class IndexRepository implements IndexRepositoryInterface
{
    public function index()
    {
        $dayN = Carbon::now()->format('d');
        $monthN = Carbon::now()->format('m');
        $yearN = Carbon::now()->format('y');

        $countMonthRevenue = Order::whereMonth('updated_at', $monthN)->whereYear('updated_at', $yearN)->count();

        $monthRevenue = $countMonthRevenue ? Order::whereMonth('updated_at', $monthN)->whereYear('updated_at', $yearN)->sum('total') : 0;
        $dayRevenue = Order::where('status', 1)->whereDay('updated_at', $dayN)->whereMonth('updated_at', $monthN)->whereYear('updated_at', $yearN)->sum('total');

        $orders = Order::where('status', 1)->whereMonth('updated_at', $monthN)->whereYear('updated_at', $yearN)->count();

        for ($i=1;$i<=$monthN;$i++) {
            $months[$i] = $i;
            $revenue[$i] = Order::where('status', 1)->whereMonth('updated_at', $i)->whereYear('updated_at', $yearN)->sum('total');
        }

        $data['monthN'] = $monthN;
        $data['monthRevenue'] = $monthRevenue;
        $data['dayRevenue'] = $dayRevenue;
        $data['orders'] = $orders;
        $data['months'] = $months;
        $data['revenue'] = $revenue;

        return $data;
    }
}