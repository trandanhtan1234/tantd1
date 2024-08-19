<?php

namespace App\Repositories\Order;

interface OrderRepositoryInterface 
{
    public function orderIndex();

    public function detailOrder($id);
    
    public function approveOrder($params,$id);

    public function getApproved();
}