<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function add(Request $request){
        return view('addEquipment');
    }
}
