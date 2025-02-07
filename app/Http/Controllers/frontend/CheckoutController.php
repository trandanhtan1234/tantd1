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
    
    public function vnPay()
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:8000/cart";
        $vnp_TmnCode = "2FB4TSJS";//Mã website tại VNPAY
        $vnp_HashSecret = "EO2UQ6WKK39MSAGN3654HMEUH53CK20Y"; //Chuỗi bí mật

        $vnp_TxnRef = '12'; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Checkout Test';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = 20000 * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
        
        $inputData = array(
            "vnp_Version" => "2.0.1",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =    hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
        if (isset($_POST['redirect'])) {
            header('Location: ' .$vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
            // vui lòng tham khảo thêm tại code demo
    }
}
