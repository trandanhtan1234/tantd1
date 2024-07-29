<?php

namespace App\Repositories\Category;

use App\Repositories\Category\CategoryRepositoryInterface;
use App\Models\models\category;
use Illuminate\Support\Facades\DB;
use Exception;

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

    public function addCategory($params)
    {
        try {
            DB::beginTransaction();
            $cate = new category();
            $cate->name = $params['name'];
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}