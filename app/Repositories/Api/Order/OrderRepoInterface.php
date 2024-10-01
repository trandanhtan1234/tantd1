<?php

namespace App\Repositories\Api\Order;

interface OrderRepoInterface
{
    public function index($data);

    public function show($id);

    public function update($params, $id);
}