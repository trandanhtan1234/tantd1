<?php

namespace App\Repositories\Category;

interface CategoryRepositoryInterface
{
    public function getListCategory();

    public function getCategory($id);

    public function addCategory($params);
}