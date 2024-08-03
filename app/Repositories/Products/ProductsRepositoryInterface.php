<?php

namespace App\Repositories\Products;

interface ProductsRepositoryInterface
{
    public function getList();

    public function getProduct($id);

    public function addProduct($params);

    public function editProduct($params, $id);

    public function deleteProduct($id);
}