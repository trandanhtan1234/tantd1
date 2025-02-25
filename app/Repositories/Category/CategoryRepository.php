<?php

namespace App\Repositories\Category;

use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Log;
use App\Models\models\Category;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryRepositoryInterface
{
    const failed_msg = 'Something went wrong, please try again later!';
    
    public function getListCategory()
    {
        $category = Category::get();

        return $category;
    }

    public function getCategory($id)
    {
        $category = Category::find($id);

        return $category;
    }

    public function addCategory($params)
    {
        try {
            DB::beginTransaction();
            $list = Category::get();
            if (checkLevel($list, $params->parent, 1) > 3) {
                DB::commit();
                $result = [
                    'code' => 400,
                    'msg' => 'Cannot add category that is beyond level 3'
                ];
                return $result;
            }
            $cate = new Category();
            $cate->name = $params['name'];
            $cate->slug = Str::slug($params['name'], '-');
            $cate->parent = $params['parent'];
            $cate->save();
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => 'Add Category successfully!'
            ];
            return $result;
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());

            $result = [
                'code' => 500,
                'msg' => static::failed_msg
            ];
            return $result;
        }
    }

    public function editCategory($params, $id)
    {
        try {
            DB::beginTransaction();
            $list = Category::get();
            if (checkLevel($list, $params->parent, 1) > 3) {
                DB::commit();
                $result = [
                    'code' => 400,
                    'msg' => 'Cannot add category that is beyond level 3'
                ];
                return $result;
            }
            $cate = Category::find($id);
            $cate->name = $params['name'];
            $cate->slug = Str::slug($params['name'], '-');
            $cate->parent = $params['parent'];
            $cate->save();
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => 'Edit Category successfully'
            ];
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            $result = [
                'code' => 500,
                'msg' => static::failed_msg
            ];
        }
    }

    public function delCate($id)
    {
        try {
            DB::beginTransaction();
            $cate = Category::find($id);

            // Check if there are any child categories, set its parent as theirs first
            Category::where('parent', $id)->update(['parent' => $cate->parent]);

            Category::destroy($id);
            DB::commit();
            
            $result = [
                'code' => 200,
                'msg' => 'Delete Category successfully'
            ];
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            $result = [
                'code' => 500,
                'msg' => static::failed_msg
            ];
        }
    }
}