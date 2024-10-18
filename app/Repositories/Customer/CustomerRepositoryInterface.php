<?php

namespace App\Repositories\Customer;

interface CustomerRepositoryInterface
{
    public function index();

    public function getAll();
    
    public function addCustomer($params);

    public function show($id);

    public function update($params,$id);

    public function destroy($id);
}