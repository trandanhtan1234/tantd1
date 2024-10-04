<?php

namespace App\Http\Controllers\Api\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Api\Customer\CustomerRepoInterface;
use App\Http\Requests\api\AddCustomerRequest;

class CustomerController extends Controller
{
    protected $customerRepo;

    public function __construct(
        CustomerRepoInterface $customerRepo
    ) {
        $this->customerRepo = $customerRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $data)
    {
        return $this->customerRepo->index($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddCustomerRequest $request)
    {
        return $this->customerRepo->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->customerRepo->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->customerRepo->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->customerRepo->destroy($id);
    }
}
