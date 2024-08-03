<?php

namespace App\Repositories\Products;

use App\Repositories\Products\ProductsRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Models\models\product;
use Exception;
use Illuminate\Support\Str;

class ProductsRepository implements ProductsRepositoryInterface
{
    public function getList()
    {
        $products = product::paginate(5);
        
        return $products;
    }

    public function getProduct($id)
    {
        $product = product::find($id);

        return $product;
    }
    public function addProduct($params)
    {

    }

    public function editProduct($params, $id)
    {

    }

    public function deleteProduct($id)
    {
        try {
            DB::beginTransaction();
            product::destroy($id);
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => 'Delete Product successfully!'
            ];
            return $result;
        } catch (Exception $e) {
            DB::rollback();

            $result = [
                'code' => 500,
                'msg' => 'Something went wrong. Please try again later!'
            ];
            return $result;
        }
    }
}