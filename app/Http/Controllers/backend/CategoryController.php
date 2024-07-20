<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategory()
    {
        return view('backend.category.category');
    }

    public function editCategory()
    {
        return view('backend.category.editcategory');
    }
}
