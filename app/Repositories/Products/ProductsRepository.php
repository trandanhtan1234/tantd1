<?php

namespace App\Repositories\Products;

use App\Repositories\Products\ProductsRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\models\{Product,Attributes,Values,Variants};
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductsRepository implements ProductsRepositoryInterface
{
    const failed_msg = 'Something went wrong, please try again later!';

    public function getList()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(5);
        
        return $products;
    }

    public function getProduct($id)
    {
        $product = Product::find($id);

        return $product;
    }

    public function getAttributes()
    {
        $attributes = Attributes::get();

        return $attributes;
    }

    public function addProduct($params)
    {
        try {
            DB::beginTransaction();
            // Save Product
            $latestId = Product::orderBy('id', 'DESC')->first()->id;
            $product = new Product();
            $product->code = codeName($params['name'], $latestId+1);
            $product->name = $params['name'];
            $product->slug = Str::slug($params['name'], '-');
            $product->price = $params['price'];
            $product->featured = $params['featured'];
            $product->status = $params['status'];
            $product->description = $params['description'];
            // img
            if ($params->hasFile('img')) {
                // $name = convertCharacters($params['name']);
                // $letters = substr($name,0,2);
                // $folder = str_split($letters);
                // $path = 'base/img/'.$folder[0].'/'.$folder[1];
                // $file = $params['img'];
                // $fileName = Str::slug($params['name'], '-').'.'.$file->getClientOriginalExtension();
                // $file->move($path,$fileName);
                // $product->img = $path.'/'.$fileName;
                $extension = $params->file('img')->getClientOriginalExtension();
                $baseFileName = Str::slug($params['name'], '-');
                $path = 'products/' . $baseFileName . '-' . time() . '.' . $extension;
                $path = Storage::disk('s3')->putFileAs(
                    'products',
                    $params->file('img'),
                    $baseFileName . '.' . $extension,
                    'public'
                );
                $product->img = Storage::disk('s3')->url($path);
            } else {
                $product->img = Storage::disk('s3')->url('no-img.jpg');
            }
            $product->category_id = $params['category'];
            $product->save();

            // Values Products
            $arr = [];
            foreach ($params['attr'] as $value) {
                foreach ($value as $item) {
                    $arr[] = $item;
                }
            }
            $product->values()->attach($arr);

            // Variants
            $variants = getCombinations($params['attr']);
            foreach ($variants as $var) {
                $variant = new Variants();
                $variant->product_id = $product->id;
                $variant->price = $params['price'];
                $variant->save();
                $variant->values()->attach($var);
            }
            $prdId = $product->id;
            DB::commit();

            $result = [
                'code' => 200,
                'prdId' => $prdId,
                'msg' => 'Add Product Successfully!'
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

    public function editProduct($params, $id)
    {
        try {
            DB::beginTransaction();
            $product = Product::find($id);
            $product->code = codeName($params['name'], $id);
            $product->name = $params['name'];
            $product->slug = Str::slug($params['name'], '-');
            $product->price = $params['price'];
            $product->featured = $params['featured'];
            $product->status = $params['status'];
            $product->description = $params['description'];
            // img
            if ($params->hasFile('img')) {
                $name = convertCharacters($params['name']);
                $letters = substr($name,0,2);
                $folder = str_split($letters);
                $path = 'base/img/'.$folder[0].'/'.$folder[1];
                if ($product->img != 'no-img.jpg' && file_exists($product->img)) {
                    unlink($product->img);
                }
                $file = $params['img'];
                $fileName = Str::slug($params['name'], '-').'.'.$file->getClientOriginalExtension();
                $file->move($path,$fileName);
                $product->img = $path.'/'.$fileName;
            }
            $product->category_id = $params['category'];
            $product->save();

            // Values Products
            $arr = [];
            foreach ($params['attr'] as $value) {
                foreach ($value as $item) {
                    $arr[] = $item;
                }
            }
            $product->values()->attach($arr);

            // Variants
            $variants = getCombinations($params['attr']);
            foreach ($variants as $var) {
                $variant = new Variants();
                $variant->product_id = $product->id;
                $variant->save();
                $variant->values()->attach($var);
            }
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => 'Edit Product Successfully!'
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

    public function addAttr($params)
    {
        try {
            DB::beginTransaction();
            $attr = new attributes();
            $attr->name = $params['attr_name'];
            $attr->save();
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => 'Add Attribute Successfully!'
            ];
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            $result = [
                'code' => 500,
                'msg' => static::failed_msg
            ];
            return $result;
        }
    }

    public function addValue($params)
    {
        try {
            DB::beginTransaction();
            $value = new Values();
            $value->value = $params['value_name'];
            $value->attr_id = $params['attr_id'];
            $value->save();
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => 'Add Value Successfully!'
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

    public function deleteProduct($id)
    {
        try {
            DB::beginTransaction();
            Product::destroy($id);
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => 'Delete Product successfully!'
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

    public function getFeatured()
    {
        $featured = Product::where('featured',1)->where('status',1)->orderBy('id','DESC')->take(4)->get();

        return $featured;
    }

    public function getProducts()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(12);
        
        return $products;
    }

    public function getAttribute($id)
    {
        $attr = Attributes::find($id);

        return $attr;
    }

    public function getValue($id)
    {
        $value = Values::find($id);

        return $value;
    }

    public function editAttr($params, $id)
    {
        try {
            DB::beginTransaction();
            $attr = Attributes::find($id);
            $attr->name = $params['attr_name'];
            $attr->save();
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => 'Edit Attribute Successfully!'
            ];
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            $result = [
                'code' => 500,
                'msg' => static::failed_msg
            ];
            return $result;
        }
    }

    public function deleteAttribute($id)
    {
        try {
            DB::beginTransaction();
            Attributes::destroy($id);
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => 'Delete Attribute Successfully!'
            ];
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            $result = [
                'code' => 500,
                'msg' => static::failed_msg
            ];
            return $result;
        }
    }

    public function deleteValue($id)
    {
        try {
            DB::beginTransaction();
            Values::destroy($id);
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => 'Delete Value Successfully!'
            ];
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            $result = [
                'code' => 500,
                'msg' => static::failed_msg
            ];
            return $result;
        }
    }

    public function editValue($params, $id)
    {
        try {
            DB::beginTransaction();
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => 'Edit Attribute\'s Value Successfully!'
            ];
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            $result = [
                'code' => 200,
                'msg' => static::failed_msg
            ];
            return $result;
        }
    }

    public function getVariants($id)
    {
        $variant = Product::find($id);

        return $variant;
    }

    public function addVariant($params)
    {
        try {
            DB::beginTransaction();
            // price
            foreach ($params['var_price'] as $key => $value) {
                $variant = Variants::find($key);
                $variant->price = $value;
                $variant->save();
            }

            // quantity
            foreach ($params['var_qty'] as $key => $value) {
                $variant = Variants::find($key);
                $variant->quantity = $value;
                $variant->save();
            }
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => 'Add Variant\'s Price Successfully!'
            ];
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            $result = [
                'code' => 500,
                'msg' => static::failed_msg
            ];
            return $result;
        }
    }

    public function getListNew()
    {
        $new = Product::orderBy('id', 'DESC')->take(8)->get();
        return $new;
    }
}