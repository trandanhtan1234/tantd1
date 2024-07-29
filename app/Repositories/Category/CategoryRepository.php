<?php

namespace App\Repositories\Category;

use App\Repositories\Category\CategoryRepositoryInterface;
use App\Models\models\category;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Str;

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
            $cate->slug = Str::slug($params['slug'], '-');
            $cate->parent = $params['parent'];
            $cate->save();
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => 'Add Category successfully!'
            ];
            return $result;
        } catch (\Exception $e) {
            DB::rollback();

            $result = [
                'code' => 500,
                'msg' => 'Add Category failed'
            ];
            return $result;
        }
    }
}