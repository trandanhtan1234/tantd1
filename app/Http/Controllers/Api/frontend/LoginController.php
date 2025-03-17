<?php

namespace App\Http\Controllers\Api\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Config;
use Laravel\Socialite\Facades\Socialite;
use App\Models\models\Customer;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function redirectToGoogle()
    {
        Config::set('services.google.redirect', env('API_GOOGLE_REDIRECT_URI'));

        return response()->json([
            'url' => Socialite::driver('google')->stateless()->redirect()->getTargetUrl()
        ]);
    }

    public function handleGoogleCallback(): JsonResponse
    {
        Config::set('services.google.redirect', env('API_GOOGLE_REDIRECT_URI'));

        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Check if the user exists
            $customer = Customer::where('email', $googleUser->getEmail())->first();

            if (!$customer) {
                // Create a new user
                $customer = Customer::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt('random-password'), // You can set this to null if not needed
                ]);
            }

            // Generate JWT token
            $token = JWTAuth::fromUser($customer);

            return response()->json([
                'message' => 'Google Login Successful',
                'user' => $customer,
                'token' => $token,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to authenticate'], 500);
        }
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
