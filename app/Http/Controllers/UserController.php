<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function edit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'privacy' => 'required|boolean',
            'mobile_number' => 'required|string|min:8',
            'password' => 'required|string|min:6',
            'new_password' => 'nullable|string|min:6',
        ]);
        //if the password is not null, then we need to check if the old password is correct
        if ($request->password) {
            if (!Hash::check($request->password, auth()->user()->password)) {
                return redirect('/editProfile')->with('error', 'The old password do not match with the current password');
            }
        }
        // done this way because I had a problem with Auth::user()->update()
        $user = User::where('id', auth()->user()->id)->first();
        //validate the email
        if ($user->email != $request->email) {
            if (User::where('email', $request->email)->exists()) {
                return redirect('/editProfile')->with('error', 'The email is already taken');
            }
            $user->email = $request->email;
        }
        $user->name = $request->name;
        $user->private = $request->privacy;
        $user->mobile_number = $request->mobile_number;
        //if the user wants to change the password
        if ($request->new_password) {
            $user->password = Hash::make($request->new_password);
        }
        $update = $user->update();
        if ($update) {
            return redirect('/profile')->with('message', 'Profile updated successfully');
        }
        return redirect('/editProfile')->with('error', 'Something went wrong');
    }


    public function delete(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6',
        ]);
        if (!Hash::check($request->password, auth()->user()->password)) {
            return redirect('/profile')->with('error', 'The password do not match with the current password');
        }
        $user = User::where('id', auth()->user()->id)->first();
        $user->user_status_id = 2;
        $user->update();
        $request->session()->flush();
        $user->tokens()->delete();
        return redirect('/')->with('message', 'Account deleted successfully');
    }
}
