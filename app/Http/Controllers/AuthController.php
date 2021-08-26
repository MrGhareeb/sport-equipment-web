<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response(['message' => 'Invalid Credentials'], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        $response= [
            'token'=> $token
        ];

        return response($response, 201);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create(array(
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ));

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'token' => $token
        ];

        return response($response, 201);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return [
            'message'=> 'Logged out'
        ];
    }

}
