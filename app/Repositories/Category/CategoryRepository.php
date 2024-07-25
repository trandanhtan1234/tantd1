<?php

namespace App\Repositories\Category;

use App\Repositories\Category\CategoryRepositoryInterface;
use App\Models\models\category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getListCategory()
    {
        $category = category::get();

        return $category;
    }

    public function getCategory($id)
    {
        $category = category::find($id);

        return $category;
    }
}