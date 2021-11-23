<?php

namespace App\Http\Controllers\EquipmentStatuses;

use App\Http\Controllers\Controller;
use App\Models\EquipmentStatusModel;
use Illuminate\Http\Request;

class ApiEquipmentStatusesController extends Controller
{
    //
    public function getAllEquipmentStatuses(Request $request){
        //get all equipment statuses
        $data = EquipmentStatusModel::all();
        //return the response
        return response([
            "equipment_statuses" => $data,
            "successful" => true
        ], 200);
    }
}
