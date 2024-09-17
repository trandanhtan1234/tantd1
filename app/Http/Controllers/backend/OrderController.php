<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Order\OrderRepositoryInterface;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomersExport;

class OrderController extends Controller
{
    protected $orderRepo;

    public function __construct(
        OrderRepositoryInterface $orderRepo
    ) {
        $this->orderRepo = $orderRepo;
    }

    public function getOrder()
    {
        $data['orders'] = $this->orderRepo->orderIndex();

        return view('backend.order.order', $data);
    }

    public function getDetail($id)
    {
        $data['order'] = $this->orderRepo->detailOrder($id);

        return view('backend.order.detailorder', $data);
    }

    public function approveOrder(Request $r,$id)
    {
        $approve = $this->orderRepo->approveOrder($r,$id);

        if ($approve['code'] == 200) {
            return redirect('admin/order')->with('success', $approve['msg']);
        } else {
            return redirect('admin/order')->with('failed', $approve['msg']);
        }
    }

    public function getApproved()
    {
        $data['orders'] = $this->orderRepo->getApproved();

        return view('backend.order.orderapproved', $data);
    }

    public function getCustomers()
    {
        $customers = $this->orderRepo->getCustomers();

        return Excel::download(new CustomersExport($customers), 'customers.xlsx');
    }
}
