<?php

namespace App\Repositories\Cart;

interface CartRepositoryInterface
{
    public function addCart($params);
    
    public function getCart();

    public function deleteProduct($id);
}