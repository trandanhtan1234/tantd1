<?php

namespace App\Repositories\Products;

use App\Repositories\Products\ProductsRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Models\models\{product,attributes};
use Exception;
use Illuminate\Support\Str;

class ProductsRepository implements ProductsRepositoryInterface
{
    const failed_msg = 'Something went wrong, please try again later!';

    public function getList()
    {
        $products = product::orderBy('id', 'DESC')->paginate(5);
        
        return $products;
    }

    public function getProduct($id)
    {
        $product = product::find($id);

        return $product;
    }

    public function getAttributes()
    {
        $attributes = attributes::get();

        return $attributes;
    }

    public function addProduct($params)
    {
        try {
            DB::beginTransaction();
            // Save Product
            $latestId = product::orderBy('id', 'DESC')->first()->id;
            $product = new product();
            $product->code = codeName($params['name'], $latestId+1);
            $product->name = $params['name'];
            $product->slug = Str::slug($params['name'], '-');
            $product->price = $params['price'];
            $product->featured = $params['featured'];
            $product->status = $params['status'];
            $product->quantity = $params['quantity'];
            $product->description = $params['description'];
            // img
            if ($params->hasFile('img')) {
                $letters = substr($params['name'],0,2);
                $folder = str_split($letters);
                $path = 'base/img/'.$folder[0].'/'.$folder[1];
                // if (!is_dir($path)) {
                //     mkdir($path);
                // }
                // if ($params['img'] != 'no-img.jpg') {
                //     unlink('backend/img/'.$path.'/'.$params['img']);
                // }
                $file = $params['img'];
                $fileName = Str::slug($params['name'], '-').'.'.$file->getClientOriginalExtension();
                $file->move($path,$fileName);
                $product->img = $path.'/'.$fileName;
            } else {
                $product->img = 'no-img.jpg';
            }
            $product->category_id = $params['category'];
            $product->created_at = \Carbon\Carbon::now();
            $product->updated_at = \Carbon\Carbon::now();
            $product->save();
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => 'Add Product Successfully!'
            ];
            return $result;
        } catch (Exception $e) {
            DB::rollback();

            $result = [
                'code' => 500,
                'msg' => static::failed_msg
            ];
            return $result;
        }
    }

    public function editProduct($params, $id)
    {
        try {
            DB::beginTransaction();
            $product = product::find($id);
            // $product->code
            $product->name = $params['name'];
            $product->slug = Str::slug($params['name'], '-');
            $product->price = $params['price'];
            $product->featured = $params['featured'];
            $product->status = $params['status'];
            $product->quantity = $params['quantity'];
            $product->description = $params['description'];
            // img
            if ($params->hasFile('img')) {
                $letters = substr($params['name'],0,2);
                $folder = str_split($letters);
                $path = 'base/img/'.$folder[0].'/'.$folder[1];
                // if (!is_dir($path)) {
                //     mkdir($path);
                // }
                if ($product->img != 'no-img.jpg') {
                    unlink('backend/img/'.$path.'/'.$params['img']);
                }
                $file = $params['img'];
                $fileName = Str::slug($params['name'], '-').'-'.$file->getClientOriginalExtension();
                $file->move($path,$fileName);
                $product->img = $path.'/'.$fileName;
            } else {
                $product->img = 'no-img.jpg';
            }
            $product->category_id = $params['category'];
            $product->updated_at = \Carbon\Carbon::now();
            $product->save();
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => 'Edit Product Successfully!'
            ];
        } catch (Exception $e) {
            DB::rollback();

            $result = [
                'code' => 500,
                'msg' => static::failed_msg
            ];
            return $result;
        }
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
                'msg' => static::failed_msg
            ];
            return $result;
        }
    }

    public function getFeatured()
    {
        $featured = product::where('featured',1)->where('status',1)->orderBy('id','DESC')->get();

        return $featured;
    }

    public function getNewProducts()
    {
        $products = product::orderBy('id', 'DESC')->paginate(12);
        
        return $products;
    }
}