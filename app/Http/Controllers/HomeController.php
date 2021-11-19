<?php

namespace App\Http\Controllers;

use App\Models\EquipmentModel;
use App\Models\EquipmentStatusModel;
use App\Models\EquipmentTypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // $data = EquipmentModel::with(['equipment_status'])->get()->where('user_id', '=', Auth::id());
        //get the equipments of the user
        $status = $request->status ?? 1;
        $data = EquipmentModel::where('user_id', '=', Auth::id())->where('equipment_status_id',"=",$status)->paginate(6);
      
        $equipmentStatus = EquipmentStatusModel::all();
        $equipmentType = EquipmentTypeModel::all();
        return view('index', ['data' => $data, 'equipmentStatus' => $equipmentStatus, 'equipmentType' => $equipmentType]);
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

    public function test()
    {
        // $contents = Storage::disk('public')->get('equipment_images/5/pexels-pixabay-532220.jpg');
        // return response($contents)->header('Content-Type', 'image/jpeg');
        $data = EquipmentModel::with(['equipment_status', 'equipment_images'])->get()->where('user_id', '=', Auth::id());
        return $data;
    }
}
