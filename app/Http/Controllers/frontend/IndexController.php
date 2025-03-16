<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\{LoginCustomerRequest,RegisterRequest};
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Products\{ProductsRepositoryInterface};
use App\Models\models\Customer;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    protected $productRepo;

    protected $customerRepo;

    public function __construct(
        ProductsRepositoryInterface $productRepo,
        CustomerRepositoryInterface $customerRepo
    ) {
        $this->productRepo = $productRepo;
        $this->customerRepo = $customerRepo;
    }

    public function getIndex()
    {
        $data['featured'] = $this->productRepo->getFeatured();
        $data['list'] = $this->productRepo->getListNew();
        $data['now'] = \Carbon\Carbon::now();

        return view('frontend.index', $data);
    }

    public function loginCustomer()
    {
        return view('frontend.login');
    }

    public function postLoginCustomer(LoginCustomerRequest $r)
    {
        $credentials = $r->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            /** @var App\Models\models\Customer $customer */
            $customer = Auth::guard('customer')->user();
            $customer->save();
            return redirect($r->previous_page);
        } else {
            return redirect('login-customer')->withInput()->with('failed', 'Email or Password is incorrect!');
        }
    }

    public function logoutCustomer()
    {
        Auth::guard('customer')->logout();
        return back();
    }

    public function registerCustomer()
    {
        return view('frontend.register');
    }

    public function postRegisterCustomer(RegisterRequest $r)
    {
        $customer = $this->customerRepo->addCustomer($r);

        if ($customer['code'] == 200) {
            return redirect('/login-customer')->with('success', $customer['msg']);
        } else {
            return redirect()->back()->with('failed', $customer['msg']);
        }
    }

    public function authGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function authGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        
        $checkCustomer = Customer::where('email', 'like', '%' . $googleUser->getEmail() . '%')->first();
        
        $params = [
            'email' => $googleUser->getEmail(),
            'password' => Hash::make('123456')
        ];

        if (!$checkCustomer) {
            $this->customerRepo->addCustomer($params);
        }

        $customer = Customer::updateOrCreate([
            'email' => $googleUser->getEmail(),
        ], [
            'full' => $googleUser->getName(),
            'password' => Hash::make('123456'),
            'phone' => ''
        ]);

        Auth::guard('customer')->login($customer);

        return redirect('/');
    }

    public function getAboutUs()
    {
        return view('frontend.about');
    }

    public function getContact()
    {
        return view('frontend.contact');
    }

    public function map()
    {
        return view('frontend.map');
    }
}
