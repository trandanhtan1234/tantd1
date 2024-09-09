<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Http\Requests\CheckoutRequest;

class CheckoutController extends Controller
{
    protected $cartRepo;

    public function __construct(
        CartRepositoryInterface $cartRepo
    ) {
        $this->cartRepo = $cartRepo;
    }
    public function getCheckout()
    {
        $data = $this->cartRepo->getCart();
        return view('frontend.checkout.checkout', $data);
    }

    public function postCheckout(CheckoutRequest $r)
    {
        $postCheckout = $this->cartRepo->postCheckout($r);

        if ($postCheckout['code'] == 200) {
            return redirect('/checkout/complete')->with('success', $postCheckout['msg']);
        } else {
            return redirect()->back()->with('failed', $postCheckout['msg']);
        }
    }

    public function getComplete()
    {
        return view('frontend.checkout.complete');
    }
}
