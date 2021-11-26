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
        //validate the request
        $request->validate([
            'order' => 'string|max:5',
            'status' => 'integer',
            'search' => 'string|max:255',
        ]);
        //get the equipments of the user 
        $status = $request->status ?? 1;
        $order = $request->order ?? 'asc';
        $search = $request->search ?? null;
        //check if the search is empty or not and execute the query accordingly
        if ($search != null) {
            $data = EquipmentModel::where('user_id', '=', Auth::id())->where('equipment_name', "LIKE", $search)->orWhere('equipment_description', "LIKE", $search)->orderby('equipment_name', $order)->paginate(6);
        } else {
            $data = EquipmentModel::where('user_id', '=', Auth::id())->where('equipment_status_id', "=", $status)->orderby('equipment_name', $order)->paginate(6);
        }
        //get all the equipment status
        $equipmentStatus = EquipmentStatusModel::all();
        //get all the equipment type
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

    public function test(Request $request)
    {
        return "test";
    }
}
