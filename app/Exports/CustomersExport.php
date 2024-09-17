<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class CustomersExport implements FromView
{
    private $customers;

    public function __construct($customers) {
        $this->customers = $customers;
    }
    
    /**
     * @return View
     */
    public function view(): View
    {
        return view('backend.customer.export_customers', ['customers' => $this->customers]);
    }
}
