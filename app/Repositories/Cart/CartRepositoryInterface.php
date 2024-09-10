<?php

namespace App\Repositories\Cart;

interface CartRepositoryInterface
{
    public function addCart($params);
    
    public function getCart();

    public function updateCart($rowId,$qty);

    public function postCheckout($params);

    public function deleteProduct($id);
}