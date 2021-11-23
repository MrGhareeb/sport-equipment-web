<?php

namespace App\Http\Controllers\EquipmentTypes;

use App\Http\Controllers\Controller;
use App\Models\EquipmentTypeModel;
use Illuminate\Http\Request;

class ApiEquipmentTypesController extends Controller
{
    public function getAllEquipmentTypes(Request $request)
    {
        //get all equipment types
        $data = EquipmentTypeModel::all();
        //return the response
        return response([
            "equipment_types" => $data,
            "successful" => true
        ], 200);
    }
}
