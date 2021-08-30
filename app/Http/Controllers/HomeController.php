<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function login()
    {
        //check if user is logged in
        if (auth()->check()) {
            return redirect('/');
        }
        //if not logged in, show login page
        return view('Auth.login');
    }


    public function register()
    {
        return view('Auth.register');
    }
}
