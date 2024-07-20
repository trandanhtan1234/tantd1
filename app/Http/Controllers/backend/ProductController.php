<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getListProducts()
    {
        return view('backend.product.listproduct');
    }

    public function getAddProduct()
    {
        return view('backend.product.addproduct');
    }

    public function getEditProduct()
    {
        return view('backend.product.editproduct');
    }
}
