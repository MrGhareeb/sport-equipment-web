<?php

namespace App\Http\Controllers;

use App\Models\EquipmentModel;
use App\Models\EquipmentStatusModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $data = EquipmentModel::with(['equipment_status'])->get()->where('user_id', '=', Auth::id());
        $equipmentStatus = EquipmentStatusModel::all();
        return view('index',['data' => $data, 'equipmentStatus' => $equipmentStatus]);
    }

    public function add(Request $request){
        return view('addEquipment');
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
        $data = EquipmentStatusModel::all();
        dd($data);
    }
}
