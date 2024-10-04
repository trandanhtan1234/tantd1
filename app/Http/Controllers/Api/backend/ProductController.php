<?php

namespace App\Http\Controllers\Api\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Api\Products\ProductRepoInterface;
use App\Http\Requests\api\{AddProductRequest,AddAttributeRequest,AddValueRequest,EditAttributeRequest};

class ProductController extends Controller
{
    protected $prdRepo;

    public function __construct(
        ProductRepoInterface $prdRepo
    ) {
        $this->prdRepo = $prdRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $data)
    {
        return $this->prdRepo->index($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddProductRequest $request)
    {
        return $this->prdRepo->store($request);
    }

    public function storeAttribute(AddAttributeRequest $request)
    {
        return $this->prdRepo->storeAttribute($request);
    }

    public function storeValue(AddValueRequest $request)
    {
        return $this->prdRepo->storeValue($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->prdRepo->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->prdRepo->update($request,$id);
    }

    public function updateAttribute(EditAttributeRequest $request,$id)
    {
        return $this->prdRepo->updateAttribute($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->prdRepo->destroy($id);
    }
}
