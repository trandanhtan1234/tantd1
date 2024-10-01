<?php

namespace App\Repositories\Api\Products;

interface ProductRepoInterface
{
    public function index($data);

    public function store($params);

    public function storeAttribute($params);

    public function storeValue($params);

    public function show($id);

    public function update($params,$id);

    public function updateAttribute($params,$id);

    public function destroy($id);
}