<?php

namespace App\Repositories\Api\Products;

use App\Repositories\Api\Products\ProductRepoInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\models\{product,attributes,values,variants};
use Exception;
use Illuminate\Support\Str;

class ProductRepo implements ProductRepoInterface
{
    public function index($data)
    {
        $limit = isset($data['limit']) && ctype_digit($data['limit']) ? $data['limit'] : 10;
        $products = product::orderBy('id', 'DESC')->paginate($limit);

        if (!$products->all()) {
            return response()->json([
                config('constparam.code') => 404,
                config('constparam.msg') => config('constparam.not_found')
            ],404);
        }
        
        return response()->json([
            config('constparam.code') => 200,
            config('constparam.msg') => config('constparam.success_msg'),
            config('constparam.result') => $products
        ],200);
    }

    public function store($params)
    {
        try {
            DB::beginTransaction();
            $latestId = product::orderBy('id', 'DESC')->first()->id;
            $product = new product();
            $product->code = codeName($params['name'], $latestId+1);
            $product->name = $params['name'];
            $product->slug = Str::slug($params['name'], '-');
            $product->price = $params['price'];
            $product->featured = $params['featured'];
            $product->status = ($params['quantity']>0||$params['quantity']!=''?$params['status']:0);
            $product->quantity = $params['quantity'];
            $product->description = $params['description'];
            // img
            if ($params->hasFile('img')) {
                $name = convertCharacters($params['name']);
                $letters = substr($name,0,2);
                $folder = str_split($letters);
                $path = 'base/img/'.$folder[0].'/'.$folder[1];
                $file = $params['img'];
                $fileName = Str::slug($params['name'], '-').'.'.$file->getClientOriginalExtension();
                $file->move($path,$fileName);
                $product->img = $path.'/'.$fileName;
            } else {
                $product->img = 'no-img.jpg';
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
                $variant = new variants();
                $variant->product_id = $product->id;
                $variant->price = $params['price'];
                $variant->save();
                $variant->values()->attach($var);
            }
            DB::commit();

            return response()->json([
                config('constparam.code') => 200,
                config('constparam.msg') => config('constparam.success_msg')
            ],200);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());

            return response()->json([
                config('constparam.code') => 500,
                config('constparam.msg') => config('constparam.error_msg')
            ],500);
        }
    }

    public function storeAttribute($params)
    {
        try {
            DB::beginTransaction();
            $attr = new attributes();
            $attr->name = $params['name'];
            $attr->save();
            DB::commit();

            return response()->json([
                config('constparam.code') => 200,
                config('constparam.msg') => config('constparam.success_msg')
            ],200);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());

            return response()->json([
                config('constparam.code') => 500,
                config('constparam.msg') => config('constparam.error_msg')
            ],500);
        }
    }

    public function storeValue($params)
    {
        try {
            DB::beginTransaction();
            $checkAttr = attributes::find($params['attr_id']);
            if (!$checkAttr) {
                return response()->json([
                    config('constparam.code') => 404,
                    config('constparam.msg') => config('constparam.not_found')
                ],404);
            }

            $value = new values();
            $value->value = $params['value'];
            $value->attr_id = $params['attr_id'];
            $value->save();
            DB::commit();
            
            return response()->json([
                config('constparam.code') => 200,
                config('constparam.msg') => config('constparam.success_msg')
            ],200);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());

            return response()->json([
                config('constparam.code') => 500,
                config('constparam.msg') => config('constparam.error_msg')
            ],500);
        }
    }

    public function show($id)
    {
        $product = product::find($id);
        if (!$product) {
            return response()->json([
                config('constparam.code') => 404,
                config('constparam.msg') => config('constparam.not_found')
            ],404);
        }

        return response()->json([
            config('constparam.code') => 200,
            config('constparam.msg') => config('constparam.not_found'),
            config('constparam.result') => $product
        ],200);
    }

    public function update($params,$id)
    {
        try {
            DB::beginTransaction();
            $checkPrd = product::find($id);
            if (!$checkPrd) {
                return response()->json([
                    config('constparam.code') => 404,
                    config('constparam.msg') => config('constparam.not_found')
                ],404);
            }
            $product = product::find($id);
            $product->code = codeName($params['name'], $id);
            $product->name = $params['name'];
            $product->slug = Str::slug($params['name'], '-');
            $product->price = $params['price'];
            $product->featured = $params['featured'];
            $product->status = ($params['quantity']>0||$params['quantity']!=''?$params['status']:0);
            $product->quantity = $params['quantity'];
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
                $variant = new variants();
                $variant->product_id = $product->id;
                $variant->save();
                $variant->values()->attach($var);
            }
            DB::commit();

            return response()->json([
                config('constparam.code') => 200,
                config('constparam.msg') => config('constparam.success_msg')
            ],200);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());

            return response()->json([
                config('constparam.code') => 500,
                config('constparam.msg') => config('constparam.error_msg')
            ],500);
        }
    }

    public function updateAttribute($params,$id)
    {
        
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $product = product::find($id);
    
            if (!$product) {
                return response()->json([
                    config('constparam.code') => 404,
                    config('constparam.msg') => config('constparam.not_found')
                ],404);
            }
            product::destroy($id);
            DB::commit();

            return response()->json([
                config('constparam.code') => 200,
                config('constparam.msg') => config('constparam.success_msg')
            ],200);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());

            return response()->json([
                config('constparam.code') => 500,
                config('constparam.msg') => config('constparam.error_msg')
            ],500);
        }
    }
}