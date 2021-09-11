<?php

namespace App\Http\Controllers;

use App\Models\EquipmentModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function getUserEquipment(Request $request){
        //get the user 
        $user = $request->user();
        //get the user's equipment
        $equipments = EquipmentModel::where('user_id', $user->id)->get();
        $response = [
            "equipments"=> $equipments,
            "successful"=>true
        ];
        //return the response
        return response($response,200);
    }
    
    public function getUserEquipmentByID(Request $request){

        //get the values from the request
        $input = $request->all();
        //validate the values
        $validator = Validator::make($input, [
            'id' => 'required|integer'
        ]);
        //if the validation fails return the error
        if ($validator->fails()) {
            return response(['error' => $validator->errors(),"successful"=>false], 401);
        }
        //get the user
        $user = $request->user();
        //get the equipment
        $equipments = EquipmentModel::where('user_id', $user->id)->where('equipment_id', $input['id'])->get();
        //if the equipment is not found return an error
        if(count($equipments) > 0){
            $response = [
                "equipments"=>$equipments,
                "successful"=>true
            ];
            return response($response,200);
        }
        return response([ 'error'=> ['message' => 'Equipment not found']], 404);
        

    }   
}
