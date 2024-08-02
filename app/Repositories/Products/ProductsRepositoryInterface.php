<?php

namespace App\Repositories\Products;

interface ProductsRepositoryInterface
{
    public function getList();

    public function getProduct($id);
}