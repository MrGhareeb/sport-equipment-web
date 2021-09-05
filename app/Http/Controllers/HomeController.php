<?php

namespace App\Http\Controllers;

use App\Models\EquipmentModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $data = EquipmentModel::with(['equipment_status'])->get()->where('user_id', '=', Auth::id());
        return view('index',['data' => $data]);
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

    public function test(){
        $data = EquipmentModel::with(['equipment_status'])->get()->where('user_id', '=', Auth::id());
        dd($data[0]->equipment_status->equipment_status_value);
    }
}
