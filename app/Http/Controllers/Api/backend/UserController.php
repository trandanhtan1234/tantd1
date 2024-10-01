<?php

namespace App\Http\Controllers\Api\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Api\Users\UserRepoInterface;
use App\Http\Requests\api\{AddUserRequest,EditUserRequest};

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(
        UserRepoInterface $userRepo
    ) {
        $this->userRepo = $userRepo;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $data)
    {
        return $this->userRepo->getUsers($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddUserRequest $request)
    {
        return $this->userRepo->storeUser($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->userRepo->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditUserRequest $request, string $id)
    {
        return $this->userRepo->updateUser($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->userRepo->destroy($id);
    }
}
