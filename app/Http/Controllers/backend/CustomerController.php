<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Http\Requests\{AddCustomerRequest,EditCustomerRequest};
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomersExport;

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

    public function getStore()
    {
        return view('backend.customer.addcustomer');
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

    public function postUpdate(EditCustomerRequest $r, $id)
    {
        $editCustomer = $this->customerRepo->update($r,$id);

        if ($editCustomer['code'] == 200) {
            return redirect('/admin/customer')->with('success', $editCustomer['msg']);
        } else {
            return redirect('/admin/customer')->with('failed', $editCustomer['msg']);
        }
    }

    public function destroy($id)
    {
        $delCustomer = $this->customerRepo->destroy($id);

        if ($delCustomer['code'] == 200) {
            return redirect()->back()->with('success', $delCustomer['msg']);
        } else {
            return redirect()->back()->with('failed', $delCustomer['msg']);
        }
    }
    
    public function exportCustomers()
    {
        $customers = $this->customerRepo->getAll();
        
        return Excel::download(new CustomersExport($customers), 'customers.xlsx');
    }
}
