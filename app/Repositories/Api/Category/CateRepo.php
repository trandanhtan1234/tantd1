<?php

namespace App\Repositories\Api\Category;

use App\Repositories\Api\Category\CateRepoInterface;
use Illuminate\Support\Facades\Log;
use App\Models\models\Category;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Str;

class CateRepo implements CateRepoInterface
{
    public function index($data)
    {
        $limit = isset($data['limit']) && ctype_digit($data['limit']) ? $data['limit'] : 10;
        $cate = Category::orderBy('id', 'DESC')->paginate($limit);

        if (!$cate->all()) {
            return response()->json([
                config('constparam.code') => 404,
                config('constparam.msg') => config('constparam.not_found')
            ],404);
        }

        return response()->json([
            config('constparam.code') => 200,
            config('constparam.msg') => config('constparam.success_msg'),
            config('constparam.result') => $cate
        ],200);
    }

    public function store($params)
    {
        try {
            DB::beginTransaction();
            $list = Category::get();
            if (checkLevel($list, $params->parent, 1) > 3) {
                return response()->json([
                    config('constparam.code') => 400,
                    config('constparam.msg') => 'Only accept max category level 3!'
                ],400);
            }
            $checkParent = Category::find($params['parent']);
            if (!$checkParent) {
                return response()->json([
                    config('constparam.code') => 404,
                    config('constparam.msg') => config('constparam.invalid_msg')
                ],404);
            }
            $cate = new Category();
            $cate->name = $params['name'];
            $cate->slug = Str::slug($params['name'], '-');
            $cate->parent = $params['parent'];
            $cate->save();
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
                config('constparam.msg') => config('constparam.fails_msg')
            ],500);
        }
    }

    public function show($id)
    {
        $cate = Category::find($id);

        if (!$cate) {
            return response()->json([
                config('constparam.code') => 404,
                config('constparam.msg') => config('constparam.not_found')
            ],404);
        }

        return response()->json([
            config('constparam.code') => 200,
            config('constparam.msg') => config('constparam.success_msg'),
            config('constparam.result') => $cate
        ],200);
    }

    public function update($params,$id)
    {
        try {
            DB::beginTransaction();
            $list = Category::get();
            if (checkLevel($list, $params->parent, 1) > 3) {
                return response()->json([
                    config('constparam.code') => 400,
                    config('constparam.msg') => 'Only accept max category level 3!'
                ],400);
            }
            $cate = Category::find($id);
            if (!$cate) {
                return response()->json([
                    config('constparam.code') => 404,
                    config('constparam.msg') => config('constparam.not_found')
                ],404);
            }
            if ($id == $params['parent']) {
                return response()->json([
                    config('constparam.code') => 400,
                    config('constparam.msg') => config('constparam.invalid_msg')
                ],400);
            }
            $cate->name = $params['name'];
            $cate->slug = Str::slug($params['name'], '-');
            $cate->parent = $params['parent'];
            $cate->save();
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
                config('constparam.msg') => config('constparam.fails_msg')
            ],500);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $cate = Category::find($id);

            if (!$cate) {
                return response()->json([
                    config('constparam.code') => 400,
                    config('constparam.msg') => config('constparam.not_found')
                ],400);
            }

            Category::where('parent', $id)->update([
                'parent' => $cate->parent
            ]);
            Category::destroy($id);
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