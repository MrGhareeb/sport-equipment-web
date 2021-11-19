<?php

namespace App\Http\Controllers;

use App\Models\EquipmentModel;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function add(Request $request){
        $request->validate([
            'itemName' => 'required',
            'ItemDescription'=>'required',
            'status'=>'required'
        ]);
        
       

    }
}
