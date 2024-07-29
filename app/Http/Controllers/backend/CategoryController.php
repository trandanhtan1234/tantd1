<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepositoryInterface;

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

    public function postCategory(Request $r)
    {
        $addCate = $this->cateRepo->addCategory($r);

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
}
