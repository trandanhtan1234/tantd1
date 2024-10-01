<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\{LoginCustomerRequest,RegisterRequest};
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Products\{ProductsRepositoryInterface};

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
        dd($r->all());
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
