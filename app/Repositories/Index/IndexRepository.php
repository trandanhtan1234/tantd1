<?php

namespace App\Repositories\Index;

use App\Repositories\Index\IndexRepositoryInterface;
use Carbon\Carbon;

class IndexRepository implements IndexRepositoryInterface
{
    public function index()
    {
        $dayN = Carbon::now()->format('d');
        $monthN = Carbon::now()->format('m');
        $yearN = Carbon::now()->format('y');
    }
}