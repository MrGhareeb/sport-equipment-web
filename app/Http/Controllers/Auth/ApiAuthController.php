<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate the request
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        // Find the user by email
        $user = User::where('email', $fields['email'])->first();
        // If the user is not found or the password is incorrect
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response(['message' => 'Invalid Credentials'], 401);
        }
        // Generate a token
        $token = $user->createToken('apiToken')->plainTextToken;
        //create the response
        $response = [
            'token' => $token
        ];
        // Return the response
        return response($response, 201);
    }

    public function register(Request $request)
    {
        //validate the request data
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'mobile_number'=>'required|min:8|unique:users'
        ]);
        //create a new user
        $user = User::create(array(
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'user_type_id' => 1,
            'user_status_id' => 1,
            'password' => Hash::make($request->password),
        ));

        //Check if user was created and return a massage
        if ($user) {
            return response(['message' => 'User created successfully'], 201);
        } else {
            return response(['message' => 'User not created'], 401);
        }
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return [
            'message' => 'Logged out'
        ];
    }
}
