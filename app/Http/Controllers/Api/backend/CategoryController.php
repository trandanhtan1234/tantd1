<?php

namespace App\Http\Controllers\Api\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Api\Category\CateRepoInterface;
use App\Http\Requests\api\{AddCateRequest,EditCateRequest};

class CategoryController extends Controller
{
    protected $cateRepo;

    public function __construct(
        CateRepoInterface $cateRepo
    ) {
        $this->cateRepo = $cateRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $data)
    {
        return $this->cateRepo->index($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddCateRequest $request)
    {
        return $this->cateRepo->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->cateRepo->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditCateRequest $request, string $id)
    {
        return $this->cateRepo->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->cateRepo->destroy($id);
    }
}
