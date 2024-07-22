<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function getCheckout()
    {
        return view('frontend.checkout.checkout');
    }
}
