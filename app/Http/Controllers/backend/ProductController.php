<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Products\ProductsRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Attributes\AttributeRepositoryInterface;
use App\Http\Requests\{AddProductRequest,EditProductRequest,AddAttributeRequest,EditAttributeRequest,AddValueRequest,EditValueRequest};
use App\Services\ChatGPTService;

class ProductController extends Controller
{
    protected $cateRepo;

    protected $productRepo;

    protected $chatGPTService;

    public function __construct(
        CategoryRepositoryInterface $cateRepo,
        ProductsRepositoryInterface $productRepo,
        ChatGPTService $chatGPTService
    ) {
        $this->cateRepo = $cateRepo;
        $this->productRepo = $productRepo;
        $this->chatGPTService = $chatGPTService;
    }

    public function getListProducts()
    {
        $data['products'] = $this->productRepo->getList();

        return view('backend.product.listproduct', $data);
    }

    public function getAddProduct()
    {
        $data['category'] = $this->cateRepo->getListCategory();
        $data['attributes'] = $this->productRepo->getAttributes();

        return view('backend.product.addproduct', $data);
    }

    public function postAddProduct(AddProductRequest $r)
    {
        $addPrd = $this->productRepo->addProduct($r);

        if ($addPrd['code'] == 200) {
            return redirect('admin/product/add-variant/'.$addPrd['prdId'])->with('success', $addPrd['msg']);
        } else {
            return redirect('admin/product')->with('failed', $addPrd['msg']);
        }
    }

    public function getEditProduct($id)
    {
        $data['category'] = $this->cateRepo->getListCategory();
        $data['product'] = $this->productRepo->getProduct($id);
        $data['attrs'] = $this->productRepo->getAttributes();

        return view('backend.product.editproduct', $data);
    }

    public function postEditProduct(EditProductRequest $r, $id)
    {
        $editPrd = $this->productRepo->editProduct($r, $id);

        if ($editPrd['code'] == 200) {
            return redirect('admin/product')->with('success', $editPrd['msg']);
        } else {
            return redirect('admin/product')->with('failed', $editPrd['msg']);
        }
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
    
    public function detailAttr()
    {
        $data['attributes'] = $this->productRepo->getAttributes();

        return view('backend.attr.attr', $data);
    }

    public function addAttribute(AddAttributeRequest $r)
    {
        $addAttr = $this->productRepo->addAttr($r);

        if ($addAttr['code'] == 200) {
            return redirect()->back()->with('success', $addAttr['msg']);
        } else {
            return redirect()->back()->with('failed', $addAttr['msg']);
        }
    }

    public function editAttribute($id)
    {
        $data['attr'] = $this->productRepo->getAttribute($id);

        return view('backend.attr.editattr', $data);
    }

    public function postEditAttribute(EditAttributeRequest $r, $id)
    {
        $editAttr = $this->productRepo->editAttr($r, $id);

        if ($editAttr['code'] == 200) {
            return redirect('admin/product/attr')->with('success', $editAttr['msg']);
        } else {
            return redirect('admin/product/attr')->with('failed', $editAttr['msg']);
        }
    }

    public function addValue(AddValueRequest $r)
    {
        $addValue = $this->productRepo->addValue($r);

        if ($addValue['code'] == 200) {
            return redirect()->back()->with('success', $addValue['msg']);
        } else {
            return redirect()->back()->with('success', $addValue['msg']);
        }
    }

    public function deleteAttribute($id)
    {
        $delAttr = $this->productRepo->deleteAttribute($id);

        if ($delAttr['code'] == 200) {
            return redirect()->back()->with('success', $delAttr['msg']);
        } else {
            return redirect()->back()->with('failed', $delAttr['msg']);
        }
    }

    public function deleteValue($id)
    {
        $delVal = $this->productRepo->deleteValue($id);

        if ($delVal['code'] == 200) {
            return redirect()->back()->with('success', $delVal['msg']);
        } else {
            return redirect()->back()->with('failed', $delVal['msg']);
        }
    }

    public function editValue($id)
    {
        $data['value'] = $this->productRepo->getValue($id);
        
        return view('backend.attr.editvalue', $data);

    }

    public function postEditValue(EditValueRequest $r, $id)
    {
        $editValue = $this->productRepo->editValue($r, $id);

        if ($editValue['code'] == 200) {
            return redirect('admin/product/detailAttr')->with('success', $editValue['msg']);
        } else {
            return redirect('admin/product/detailAttr')->with('failed', $editValue['msg']);
        }
    }

    public function getAddVariant($id)
    {
        $data['product'] = $this->productRepo->getVariants($id);

        return view('backend.variant.addvariant', $data);
    }

    public function postAddVariant(Request $r, $id)
    {
        $addVariant = $this->productRepo->addVariant($r);
        
        if ($addVariant['code'] == 200) {
            return redirect('admin/product')->with('success', $addVariant['msg']);
        } else {
            return redirect('admin/product')->with('failed', $addVariant['msg']);
        }
    }

    public function getEditVariant()
    {
        return view('backend.variant.editvariant');
    }

    public function askChatGPT(Request $r)
    {
        $message = $r->input('message');
        $response = $this->chatGPTService->chat($message);
        return response()->json([
            'code' => 200,
            'response' => $response
        ]);
    }
}
