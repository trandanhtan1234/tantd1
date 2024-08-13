<?php

namespace App\Repositories\Api\Category;

use App\Repositories\Api\Category\CateRepoInterface;
use App\Models\models\category;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Str;

class CateRepo implements CateRepoInterface
{
    public function index($data)
    {
        $limit = isset($data['limit']) && ctype_digit($data['limit']) ? $data['limit'] : 10;
        $cate = category::orderBy('id', 'DESC')->paginate($limit);

        return response()->json([
            config('constparam.code') => 200,
            config('constparam.msg') => config('constparam.success_msg'),
            config('constparam.result') => $cate
        ],200);
    }

    public function store($params)
    {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function show($id)
    {
        $cate = category::find($id);

        if (count($cate)==0) {
            return response()->json([
                config('constparam.code') => 400,
                config('constparam.msg') => config('constparam.fails_msg')
            ],400);
        }

        return response()->json([
            config('constparam.code') => 200,
            config('constparam.msg') => config('constparam.success_msg'),
            config('constparam.result') => $cate
        ],200);
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $cate = category::find($id);

            if (count($cate)==0) {
                return response()->json([
                    config('constparam.code') => 400,
                    config('constparam.msg') => config('constparam.fails_msg')
                ],400);
            }

            category::where('parent', $id)->update([
                'parent' => $cate->parent
            ]);
            category::destroy($id);
            DB::commit();

            return response()->json([
                config('constparam.code') => 200,
                config('constparam.msg') => config('constparam.success_msg')
            ],200);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json([
                config('constparam.code') => 500,
                config('constparam.msg') => config('constparam.error_msg')
            ],500);
        }
    }
}