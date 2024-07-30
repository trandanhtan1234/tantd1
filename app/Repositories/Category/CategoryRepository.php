<?php

namespace App\Repositories\Category;

use App\Repositories\Category\CategoryRepositoryInterface;
use App\Models\models\category;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryRepositoryInterface
{
    const failed_msg = 'Something went wrong, please try again later!';
    
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

            $result = [
                'code' => 500,
                'msg' => 'Add Category failed!'
            ];
            return $result;
        }
    }

    public function editCategory($params, $id)
    {
        try {
            DB::beginTransaction();
            $cate = category::find($id);
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
            $cate = category::find($id);

            // Check if there are any child categories, set its parent as theirs first
            category::where('parent', $id)->update('parent', $cate->parent);
            $cate->delete();
            DB::commit();
            
            $result = [
                'code' => 200,
                'msg' => 'Delete Category successfully'
            ];
            return $result;
        } catch (Exception $e) {
            DB::rollBack();

            $result = [
                'code' => 500,
                'msg' => static::failed_msg
            ];
        }
    }
}