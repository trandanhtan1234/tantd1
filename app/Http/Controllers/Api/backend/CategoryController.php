<?php

namespace App\Http\Controllers\Api\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Api\Category\CateRepoInterface;

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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->cateRepo->destroy($id);
    }
}
