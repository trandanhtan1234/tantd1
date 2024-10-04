<?php

namespace App\Repositories\Category;

interface CategoryRepositoryInterface
{
    public function getListCategory();

    public function getCategory($id);

    public function addCategory($params);

    public function editCategory($params, $id);

    public function delCate($id);
}