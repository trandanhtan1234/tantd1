<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Cart\CartRepositoryInterface;

class CartController extends Controller
{
    protected $cartRepo;

    public function __construct(
        CartRepositoryInterface $cartRepo
    ) {
        $this->cartRepo = $cartRepo;
    }

    public function addCart(Request $r)
    {
        $addCart = $this->cartRepo->addCart($r);
        
        if ($addCart) {
            return redirect('/cart');
        } else {
            return redirect()->back()->with('failed', 'Something went wrong. Please try again later!');
        }
    }

    public function getCart()
    {
        $data = $this->cartRepo->getCart();

        return view('frontend.cart.cart', $data);
    }

    public function removeProduct($id)
    {
        $delete = $this->cartRepo->deleteProduct($id);
    }
}
