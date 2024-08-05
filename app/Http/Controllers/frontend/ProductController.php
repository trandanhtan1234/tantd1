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
        $data['list'] = $this->productRepo->getNewProducts();
        $data['category'] = $this->categoryRepo->getListCategory();

        return view('frontend.product.list', $data);
    }

    public function getDetailProduct()
    {
        return view('frontend.product.detail');
    }
}
