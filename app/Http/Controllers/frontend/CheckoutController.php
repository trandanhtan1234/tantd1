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
        if ($r->payment_method == 0) {
            $postCheckout = $this->cartRepo->postCheckout($r);
            if ($postCheckout['code'] == 200) {
                return redirect('/checkout/complete')->with('success', $postCheckout['msg']);
            } else {
                return redirect()->back()->with('failed', $postCheckout['msg']);
            }
        } elseif ($r->payment_method == 1) {
            $momoPay = $this->cartRepo->momoPay($r);

            if ($momoPay['code'] == 200) {
                return redirect()->to($momoPay['url']);
            } else {
                return redirect()->back()->with('failed', $momoPay['msg']);
            }
        } elseif ($r->payment_method == 2) {
            $vnPay = $this->cartRepo->vnPay($r);

            if ($vnPay['code'] == 200) {
                return redirect()->to($vnPay['url']);
            } else {
                return redirect()->back()->with('failed', $vnPay['msg']);
            }
        } else {
            $onePay = $this->cartRepo->onePay($r);

            if ($onePay['code'] == 200) {
                return redirect()->to($onePay['url']);
            } else {
                return redirect()->back()->with('failed', $onePay['msg']);
            }
        }
    }
}
