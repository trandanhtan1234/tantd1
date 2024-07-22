<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getListProducts()
    {
        return view('frontend.product.list');
    }

    public function getDetailProduct()
    {
        return view('frontend.product.detail');
    }
}
