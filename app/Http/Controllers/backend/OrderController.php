<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getOrder()
    {
        return view('backend.order.order');
    }

    public function getDetail()
    {
        return view('backend.order.detailorder');
    }

    public function getProcessed()
    {
        return view('backend.order.orderprocessed');
    }
}
