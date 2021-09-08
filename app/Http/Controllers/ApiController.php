<?php

namespace App\Http\Controllers;

use App\Models\EquipmentModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function getUserEquipment(Request $request){
        $user = $request->user();
        $equipments = EquipmentModel::where('user_id', $user->id)->get();
        return response($equipments);
    }
    
    public function getUserEquipmentByID(Request $request){

        $input = $request->all();
        $validator = Validator::make($input, [
            'id' => 'required|integer'
        ]);
        $user = $request->user();
        if ($validator->fails()) {
            return response(['error' => $validator->errors()], 401);
        }
        $equipments = EquipmentModel::where('user_id', $user->id)->where('equipment_id', $input['id'])->get();
        if(count($equipments) > 0){
            return response($equipments);
        }
        return response(['message' => 'Equipment not found'], 404);
        

    }   
}
