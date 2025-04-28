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

    public function getVariant(Request $r)
    {
        $getVariant = $this->cartRepo->getVariant($r);

        if ($getVariant) {
            return response()->json([
                'success' => true,
                'variant' => $getVariant,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No matching variant found.',
            ]);
        }
    }

    public function getCart()
    {
        $data = $this->cartRepo->getCart();

        return view('frontend.cart.cart', $data);
    }

    public function updateCart(Request $r)
    {
        $update = $this->cartRepo->updateCart($r);

        return $update;
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
