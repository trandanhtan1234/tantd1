<?php

namespace App\Repositories\Products;

use App\Repositories\Products\ProductsRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Models\models\product;
use Exception;
use Illuminate\Support\Str;

class ProductsRepository implements ProductsRepositoryInterface
{
    public function getList()
    {
        $products = product::paginate(5);
        
        return $products;
    }
}