<?php

namespace App\Repositories\Customer;

interface CustomerRepositoryInterface
{
    public function index();
    
    public function addCustomer($params);

    public function show($id);
}