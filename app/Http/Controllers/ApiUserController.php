<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ApiUserController extends Controller
{
    //
    function edit(Request $request)
    {
        $validator = Validator::make($request, [
            'name' => 'required|string',
            'mobile_number' => 'required|string',
            'private' => 'nullable|boolean',
            'email' => 'nullable|string',
            'password' => 'nullable|string',
            'new_password' => 'nullable|string',
        ]);
        //get the user
        $user = User::find($request->user()->id);
        //check if validator failed
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
                "successful" => false
            ], 400);
        }
        // validate the password
        if ($request->has('password')) {
            if (!$user->verifyPassword($request->password)) {
                return response()->json([
                    'message' => 'Password is incorrect',
                    "successful" => false
                ], 400);
            }
        }
        //validate the email
        if ($request->has('email')) {
            if ($user->email != $request->email) {
                $validator = Validator::make($request, [
                    'email' => 'unique:users',
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'message' => $validator->errors(),
                        "successful" => false
                    ], 400);
                }
                // update the email
                $user->email = $request->email;
            }
        }
        //validate the private
        if ($request->has('private')) {
            $user->private = $request->private;
        }
        //update the user data
        $user->name = $request->name;
        $user->mobile_number = $request->mobile_number;
        //check if new password is provided
        if ($request->has('new_password')) {
            $user->password = $request->new_password;
        }
        //save the user
        $user->update();
    }


    function delete(Request $request)
    {
        $validator = Validator::make($request, [
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required|string',
        ]);
        //get the user
        $user = User::find($request->user()->id);
        //check if validator failed
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
                "successful" => false
            ], 400);
        }
        // validate the password
        if (!$user->verifyPassword($request->password)) {
            return response()->json([
                'message' => 'Password is incorrect',
                "successful" => false
            ], 400);
        }
        //confirm the password
        if ($request->password != $request->password_confirmation) {
            return response()->json([
                'message' => 'Password confirmation is incorrect',
                "successful" => false
            ], 400);
        }
        //change the user status to deleted
        $user->user_status_id = 2;
        //save the user
        $user->update();
        //revoke all tokens
        $user->tokens()->delete();
        //return the response
        return response()->json([
            'message' => 'User deleted successfully',
            "successful" => true
        ], 200);
    }
}
