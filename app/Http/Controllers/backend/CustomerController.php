<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Http\Requests\AddCustomerRequest;

class CustomerController extends Controller
{
    protected $customerRepo;

    public function __construct(
        CustomerRepositoryInterface $customerRepo
    ) {
        $this->customerRepo = $customerRepo;
    }

    public function index()
    {
        $data['customers'] = $this->customerRepo->index();

        return view('backend.customer.listcustomer', $data);
    }

    public function store(AddCustomerRequest $r)
    {
        $addCustomer = $this->customerRepo->addCustomer($r);

        if ($addCustomer['code'] == 200) {
            return redirect('/admin/customer')->with('success', $addCustomer['msg']);
        } else {
            return redirect('/admin/customer')->with('failed', $addCustomer['msg']);
        }
    }

    public function update($id)
    {
        $data['customer'] = $this->customerRepo->show($id);

        return view('backend.customer.editcustomer', $data);
    }

    public function postUpdate(Request $r)
    {
        
    }
}
