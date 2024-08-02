<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Products\ProductsRepositoryInterface;

class ProductController extends Controller
{
    protected $productRepo;

    public function __construct(
        ProductsRepositoryInterface $productRepo
    ) {
        $this->productRepo = $productRepo;
    }

    public function getListProducts()
    {
        $data['list'] = $this->productRepo->getList();

        return view('backend.product.listproduct', $data);
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
