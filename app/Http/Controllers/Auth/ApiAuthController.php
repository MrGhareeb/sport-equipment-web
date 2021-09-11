<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        //return error response if validation fails
        if ($validator->fails()) {
            return response(['error' => ["Validation" => $validator->errors(),'message'=>'Validation error'],"successful"=>false], 401);
        }
        // Find the user by email
        $user = User::where('email', $input['email'])->first();
        // If the user is not found or the password is incorrect
        if (!$user || !Hash::check($input['password'], $user->password)) {
            return response(['error'=> ['message' => 'Invalid Credentials'] ,"successful"=>false], 401);
        }
        // Generate a token
        $token = $user->createToken('apiToken')->plainTextToken;
        //create the response
        $response = [
            'token' => $token,
            "successful"=>true
        ];
        // Return the response
        return response($response, 201);
    }

    public function register(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'mobile_number'=>'required|min:8|unique:users'
        ]);
        //return error response if validation fails
        if ($validator->fails()) {
            return response(['error' => ["Validation" => $validator->errors(),'message'=>'Validation error'],"successful"=>false], 401);
        }
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
            return response(['message' => 'User created successfully',"successful"=>true], 201);
        } else {
            return response(['error' => ['message' => 'User not created'],"successful"=>false], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return [
            'message' => 'Logged out',
            "successful"=>true
        ];
    }
}
