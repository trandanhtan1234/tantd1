<?php

namespace App\Repositories\Cart;

use App\Repositories\Cart\CartRepositoryInterface;
use Cart;
use App\Models\models\product;

class CartRepository implements CartRepositoryInterface
{
    public function addCart($params)
    {
        $prd = product::find($params['product_id']);

        Cart::add([
            'id' => $prd->id,
            'name' => $prd->name,
            'qty' => $params->quantity,
            'price' => getPrice($prd,$params->attr),
            'weight' => 0,
            'options' => ['img' => $prd->img, 'attr' => $params->attr]
        ]);

        return true;
    }

    public function getCart()
    {
        $data['cart'] = Cart::content();
        $data['total'] =Cart::total();

        return $data;
    }

    public function deleteProduct($id)
    {
        
    }
}