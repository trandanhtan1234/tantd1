<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Products\ProductsRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Attributes\AttributeRepositoryInterface;
use App\Http\Requests\AddProductRequest;

class ProductController extends Controller
{
    protected $cateRepo;

    protected $productRepo;
    
    protected $attrRepo;

    public function __construct(
        CategoryRepositoryInterface $cateRepo,
        ProductsRepositoryInterface $productRepo,
        AttributeRepositoryInterface $attrRepo
    ) {
        $this->cateRepo = $cateRepo;
        $this->productRepo = $productRepo;
        $this->attrRepo = $attrRepo;
    }

    public function getListProducts()
    {
        $data['products'] = $this->productRepo->getList();

        return view('backend.product.listproduct', $data);
    }

    public function getAddProduct()
    {
        $data['category'] = $this->cateRepo->getListCategory();

        return view('backend.product.addproduct', $data);
    }

    public function postAddProduct(AddProductRequest $r)
    {
        dd($r->all());
        if ($r->hasFile('product_img')) {
            dd(11);
        } else {
            dd(22);
        }
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

    public function deleteProduct($id)
    {
        $delPrd = $this->productRepo->deleteProduct($id);

        if ($delPrd['code'] == 200) {
            return redirect()->back()->with('success', $delPrd['msg']);
        } else {
            return redirect()->back()->with('failed', $delPrd['msg']);
        }
    }
}
