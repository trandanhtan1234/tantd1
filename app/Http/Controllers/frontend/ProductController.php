<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Products\ProductsRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;

class ProductController extends Controller
{
    protected $categoryRepo;

    protected $productRepo;

    public function __construct(
        CategoryRepositoryInterface $categoryRepo,
        ProductsRepositoryInterface $productRepo
    ) {
        $this->categoryRepo = $categoryRepo;
        $this->productRepo = $productRepo;
    }

    public function getListProducts()
    {
        $data['list'] = $this->productRepo->getProducts();
        $data['category'] = $this->categoryRepo->getListCategory();
        $data['now'] = \Carbon\Carbon::now();
        $data['attribtes'] = $this->productRepo->getAttributes();

        return view('frontend.product.list', $data);
    }

    public function getDetailProduct($id)
    {
        $data['product'] = $this->productRepo->getProduct($id);
        $data['prd_new'] = $this->productRepo->getListNew();

        return view('frontend.product.detail', $data);
    }
}
