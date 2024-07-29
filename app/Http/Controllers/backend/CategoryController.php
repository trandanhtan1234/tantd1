<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Http\Requests\{AddCategoryRequest,EditCategoryRequest};

class CategoryController extends Controller
{
    protected $cateRepo;

    public function __construct(
        CategoryRepositoryInterface $cateRepo
    ) {
        $this->cateRepo = $cateRepo;
    }
    
    public function getCategory()
    {
        $data['category'] = $this->cateRepo->getListCategory();

        return view('backend.category.category', $data);
    }

    public function postCategory(AddCategoryRequest $r)
    {
        $addCate = $this->cateRepo->addCategory($r);
        // https://gaigoihanoivip3.vncns.com/threads/hoa-hau-vong-1-thuy-tien-thien-than-sexy-quyen-ru.170/

        if ($addCate['code'] == 200) {
            return redirect('/admin/category')->with('success', $addCate['msg']);
        } else {
            return redirect('/admin/category')->with('failed', $addCate['msg']);
        }
    }

    public function editCategory($id)
    {
        $data['list'] = $this->cateRepo->getListCategory();
        $data['category'] = $this->cateRepo->getCategory($id);

        return view('backend.category.editcategory', $data);
    }

    public function postEditCategory(EditCategoryRequest $r, $id)
    {
        $editCate = $this->cateRepo->editCategory($r, $id);
        
        if ($editCate['code'] == 200) {
            return redirect('/admin/category')->with('success', $editCate['msg']);
        } else {
            return redirect('/admin/category')->with('failed', $editCate['msg']);
        }
    }

    public function deleteCategory($id)
    {
        $delCate = $this->cateRepo->delCate($id);
    }
}
