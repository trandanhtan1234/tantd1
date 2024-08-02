<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Products\ProductsRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;

class ProductController extends Controller
{
    protected $cateRepo;

    protected $productRepo;

    public function __construct(
        CategoryRepositoryInterface $cateRepo,
        ProductsRepositoryInterface $productRepo
    ) {
        $this->cateRepo = $cateRepo;
        $this->productRepo = $productRepo;
    }

    public function getListProducts()
    {
        $data['list'] = $this->productRepo->getList();

        return view('backend.product.listproduct', $data);
    }

    public function getAddProduct()
    {
        $data['category'] = $this->cateRepo->getListCategory();

        return view('backend.product.addproduct', $data);
    }

    public function getEditProduct($id)
    {
        $data['category'] = $this->cateRepo->getListCategory();
        $data['product'] = $this->productRepo->getProduct($id);

        return view('backend.product.editproduct', $data);
    }

    public function postEditProduct(Request $r, $id)
    {
        $test = $r;
    }
}
