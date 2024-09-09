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
            return redirect()->back()->with('success', 'Product has been added to Cart!');
        } else {
            return redirect()->back()->with('failed', 'Something went wrong. Please try again later!');
        }
    }

    public function getCart()
    {
        $data = $this->cartRepo->getCart();

        return view('frontend.cart.cart', $data);
    }

    public function updateCart($rowId,$qty)
    {
        $update = $this->cartRepo->updateCart($rowId,$qty);
    }

    public function removeProduct($id)
    {
        $delete = $this->cartRepo->deleteProduct($id);

        if ($delete['code'] == 200) {
            return redirect()->back()->with('success', $delete['msg']);
        } else {
            return redirect()->back()->with('failed', $delete['msg']);
        }
    }
}
