<?php

namespace App\Repositories\Cart;

use App\Repositories\Cart\CartRepositoryInterface;
use Cart;
use App\Models\models\{product,customer,order,orderdetail};
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;

class CartRepository implements CartRepositoryInterface
{
    const error_msg = 'Something went wrong. Please try again later!';

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
        $data['count'] = Cart::count();

        return $data;
    }

    public function updateCart($rowId,$qty)
    {
        try {
            DB::beginTransaction();
            $update = Cart::update($rowId,$qty);
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => 'Update quantity successfully!'
            ];
            return $result;
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());

            $result = [
                'code' => 500,
                'msg' => static::error_msg
            ];
            return $result;
        }
    }

    public function postCheckout($params)
    {
        try {
            DB::beginTransaction();
            $checkCustomer = customer::where('email', $params['email'])->count();
            if (!$checkCustomer) {
                $customer = new customer();
                $customer->email = $params['email'];
                $customer->full = $params['fname'];
                $customer->address = $params['address'];
                $customer->phone = $params['phone'];
                $customer->save();
                $customerId = $customer->id;
            } else {
                $customerId = customer::where('email', $params['email'])->first()->id;
            }

            $order = new order();
            $order->total = str_replace('.','',Cart::total());
            $order->address = $params['address'];
            $order->status = 0;
            $order->customer_id = $customerId;
            $order->save();
            $orderId = $order->id;

            foreach (Cart::content() as $prd) {
                $orderDetail = new orderdetail();
                $orderDetail->code = product::where('id', $prd->id)->first()->code;
                $attrs = [];
                foreach ($prd->options->attr as $attr) {
                    $attrs[] = $attr;
                }
                $orderDetail->name = $prd->name.'-'.implode('-',$attrs);
                $orderDetail->price = $prd->price;
                $orderDetail->quantity = $prd->qty;
                $orderDetail->img = $prd->options->img;
                $orderDetail->order_id = $orderId;
                $orderDetail->save();

                $product = product::where('id', $prd->id)->first();
                if (($product->quantity - $prd->qty) == 0) {
                    $product->status = 0;
                }
                $product->quantity = $product->quantity - $prd->qty;
                $product->save();
            }
            Cart::destroy();
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => 'Checkout completed!'
            ];
            return $result;
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());

            $result = [
                'code' => 500,
                'msg' => static::error_msg
            ];
            return $result;
        }
    }

    public function vnPay($params)
    {
        try {
            DB::beginTransaction();
            // Payment Process
            $data = $params->all();
            $codeCart = rand(00,9999);
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = url('checkout/complete');
            $vnp_TmnCode = "2FB4TSJS";//Mã website tại VNPAY
            $vnp_HashSecret = "EO2UQ6WKK39MSAGN3654HMEUH53CK20Y"; //Chuỗi bí mật
    
            $vnp_TxnRef = $codeCart; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Checkout Test';
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $data['total_vnpay'] * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            //Add Params of 2.0.1 Version
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
            // End Payment Process

            // Save Data
            $checkCustomer = customer::where('email', $params['email'])->count();
            if (!$checkCustomer) {
                $customer = new customer();
                $customer->email = $params['email'];
                $customer->full = $params['fname'];
                $customer->address = $params['address'];
                $customer->phone = $params['phone'];
                $customer->save();
                $customerId = $customer->id;
            } else {
                $customerId = customer::where('email', $params['email'])->first()->id;
            }

            $order = new order();
            $order->total = str_replace('.','',Cart::total());
            $order->address = $params['address'];
            $order->status = 0;
            $order->customer_id = $customerId;
            $order->save();
            $orderId = $order->id;

            foreach (Cart::content() as $prd) {
                $orderDetail = new orderdetail();
                $orderDetail->code = product::where('id', $prd->id)->first()->code;
                $attrs = [];
                foreach ($prd->options->attr as $attr) {
                    $attrs[] = $attr;
                }
                $orderDetail->name = $prd->name.'-'.implode('-',$attrs);
                $orderDetail->price = $prd->price;
                $orderDetail->quantity = $prd->qty;
                $orderDetail->img = $prd->options->img;
                $orderDetail->order_id = $orderId;
                $orderDetail->save();

                $product = product::where('id', $prd->id)->first();
                if (($product->quantity - $prd->qty) == 0) {
                    $product->status = 0;
                }
                $product->quantity = $product->quantity - $prd->qty;
                $product->save();
            }
            Cart::destroy();
            // End Save Data
            DB::commit();

            if (isset($_POST['redirect'])) {
                header('Location: ' .$vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
            // $result = [
            //     'code' => 200,
            //     'msg' => 'Checkout completed!'
            // ];
            // return $result;
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());

            $result = [
                'code' => 500,
                'msg' => static::error_msg
            ];
            return $result;
        }
    }

    public function momoPay($params)
    {
        try {
            // Payment Process
            DB::beginTransaction();
            $data = $params->all();
            
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
            $orderInfo = "Thanh toán qua ATM MoMo";
            $amount = $data['total_momo'];
            $orderId = time() . "";
            $redirectUrl = url('checkout/complete');
            $ipnUrl = url('checkout/complete');
            $extraData = "";
    
            $requestId = time() . "";
            $requestType = "payWithATM";
            // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            $data = array('partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature);
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);  // decode json
            // End Payment Process

            // Save Data
            $checkCustomer = customer::where('email', $params['email'])->count();
            if (!$checkCustomer) {
                $customer = new customer();
                $customer->email = $params['email'];
                $customer->full = $params['fname'];
                $customer->address = $params['address'];
                $customer->phone = $params['phone'];
                $customer->save();
                $customerId = $customer->id;
            } else {
                $customerId = customer::where('email', $params['email'])->first()->id;
            }

            $order = new order();
            $order->total = str_replace('.','',Cart::total());
            $order->address = $params['address'];
            $order->status = 0;
            $order->customer_id = $customerId;
            $order->save();
            $orderId = $order->id;

            foreach (Cart::content() as $prd) {
                $orderDetail = new orderdetail();
                $orderDetail->code = product::where('id', $prd->id)->first()->code;
                $attrs = [];
                foreach ($prd->options->attr as $attr) {
                    $attrs[] = $attr;
                }
                $orderDetail->name = $prd->name.'-'.implode('-',$attrs);
                $orderDetail->price = $prd->price;
                $orderDetail->quantity = $prd->qty;
                $orderDetail->img = $prd->options->img;
                $orderDetail->order_id = $orderId;
                $orderDetail->save();

                $product = product::where('id', $prd->id)->first();
                if (($product->quantity - $prd->qty) == 0) {
                    $product->status = 0;
                }
                $product->quantity = $product->quantity - $prd->qty;
                $product->save();
            }
            Cart::destroy();
            // End Save Data
            DB::commit();
            
            $result = [
                'code' => 200,
                'msg' => 'Checkout Completed',
                'url' => $jsonResult['payUrl']
            ];
            return $result;
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());

            $result = [
                'code' => 500,
                'msg' => static::error_msg
            ];
            return $result;
        }
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function deleteProduct($id)
    {
        try {
            DB::beginTransaction();
            $delete = Cart::destroy($id);
            DB::commit();

            $result = [
                'code' => 200,
                'msg' => 'Delete product from Cart successfully!'
            ];
            return $result;
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());

            $result = [
                'code' => 500,
                'msg' => static::error_msg
            ];
            return $result;
        }
    }
}