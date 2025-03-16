<?php

namespace App\Http\Controllers\Api\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\api\UserLoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Api\Users\UserRepoInterface;
use Laravel\Sanctum\PersonalAccessToken;

class LoginController extends Controller
{
    protected $userRepo;

    public function __construct(
        UserRepoInterface $userRepo
    )
    {
        $this->userRepo = $userRepo;
    }

    public function login(UserLoginRequest $request)
    {
        return $this->userRepo->login($request);
    }

    public function logout(Request $request)
    {
        $token = $request->bearerToken();
        $accessToken = PersonalAccessToken::findToken($token);

        if (!$token || !$accessToken) {
            return response()->json([
                'error' => '401',
                'message' => 'Token not provided'
            ],401);
        }

        $accessToken->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
