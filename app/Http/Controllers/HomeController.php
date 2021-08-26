<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('layouts.home');
    }

    public function login()
    {
        return view('auth.login');
    }


    public function register()
    {
        return view('Auth.register');
    }
}
