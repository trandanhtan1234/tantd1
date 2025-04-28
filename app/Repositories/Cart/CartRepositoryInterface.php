<?php

namespace App\Repositories\Cart;

interface CartRepositoryInterface
{
    public function addCart($params);

    public function getVariant($params);
    
    public function getCart();

    public function updateCart($params);

    public function postCheckout($params);

    public function vnPay($params);
    
    public function momoPay($params);

    public function onePay($params);

    public function deleteProduct($id);
}