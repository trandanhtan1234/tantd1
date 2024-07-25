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

    public function editCategory($id)
    {
        $data['list'] = $this->cateRepo->getListCategory();
        $data['category'] = $this->cateRepo->getCategory($id);

        return view('backend.category.editcategory', $data);
    }
}
