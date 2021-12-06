<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        //validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        //get the email and password from the request
        $credentials = $request->only('email', 'password');
        //get the user data from the database
        $userInfo = User::where('email', $request->email)->first();
        //check if the user exists
        if ($userInfo) {
            //if the user is found and the password is correct
            if (Hash::check($request->password, $userInfo->password)) {
                //check if the user is active
                if ($userInfo->user_status_id == 1) {
                    //attempt to log the user in
                    if (Auth::attempt($credentials)) {
                        //redirect to the home page
                        return redirect('/')->withSuccess('Login successful');
                    }
                } else {
                    //if the user is not active
                    return redirect('/login')->with('error', 'Your account is not active or deleted. Please contact the administrator.');
                }
            } else {
                //if the password is incorrect redirect to the login page with an error message
                return redirect('/login')->with('error', 'Incorrect Password');
            }
        } else {
            //if the user is not found redirect to the login page with an error message
            return redirect('/login')->with('error', 'User not found');
        }
    }

    public function register(Request $request)
    {
        //validate the request data
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'mobile_number' => "required|min:8|unique:users"
        ]);
        //add the user the the database
        $user = User::create(array(
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'user_type_id' => 1,
            'user_status_id' => 1,
            'password' => Hash::make($request->password),
        ));
        // //check if the user was created
        if (!$user) {
            return redirect('/register')->with('error', 'There was a problem when creating your account.');
        }
        //return the user the login page when the user is created
        return redirect('/login')->with("message", 'Register was successful');
    }


    public function logout(Request $request)
    {
        //destroy the session
        $request->session()->flush();
        //redirect to the login page
        return redirect('/login');
    }
}
