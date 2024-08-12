<?php

namespace App\Repositories\Products;

interface ProductsRepositoryInterface
{
    public function getList();

    public function getProduct($id);
    
    public function getAttributes();

    public function addProduct($params);

    public function editProduct($params, $id);

    public function deleteProduct($id);

    public function addAttr($params);

    public function addValue($params);

    public function getAttribute($id);

    public function editAttr($params, $id);

    public function deleteAttribute($id);

    public function deleteValue($id);

    public function getValue($id);

    public function editValue($params, $id);

    public function getVariants($id);

    public function addVariant($params);

    public function getFeatured();

    public function getListNew();

    public function getProducts();
}