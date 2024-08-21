<?php

namespace App\Http\Controllers\Api\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Api\Order\OrderRepoInterface;

class OrderController extends Controller
{
    protected $orderRepo;

    public function __construct(
        OrderRepoInterface $orderRepo
    ) {
        $this->orderRepo = $orderRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index($data)
    {
        return $this->orderRepo->index($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
