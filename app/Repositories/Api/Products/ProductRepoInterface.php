<?php

namespace App\Repositories\Api\Products;

interface ProductRepoInterface
{
    public function index($data);

    public function store($params);

    public function show($id);

    public function update($params,$id);

    public function destroy($id);
}