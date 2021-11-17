<?php

namespace App\Http\Controllers;

use App\Models\EquipmentImages;
use App\Models\EquipmentModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function getUserEquipment(Request $request)
    {
        //get the user 
        $user = $request->user();
        //get the user's equipment
        $equipments = EquipmentModel::where('user_id', $user->id)->get();
        $response = [
            "equipments" => $equipments,
            "successful" => true
        ];
        //return the response
        return response($response, 200);
    }

    public function getUserEquipmentByID(Request $request)
    {

        //get the values from the request
        $input = $request->all();
        //validate the values
        $validator = Validator::make($input, [
            'id' => 'required|integer'
        ]);
        //if the validation fails return the error
        if ($validator->fails()) {
            return response(['error' => $validator->errors(), "successful" => false], 401);
        }
        //get the user
        $user = $request->user();
        //get the equipment
        $equipments = EquipmentModel::where('user_id', $user->id)->where('equipment_id', $input['id'])->get();
        //if the equipment is not found return an error
        if (count($equipments) > 0) {
            $response = [
                "equipments" => $equipments,
                "successful" => true
            ];
            return response($response, 200);
        }
        return response(['error' => ['message' => 'Equipment not found'], "successful" => false], 404);
    }

    public function setUserEquipment(Request $request)
    {
        //get the values from the request
        $input = $request->all();
        //validate the values
        $validator = Validator::make($input, [
            'equipment_name' => 'required|string',
            'equipment_description' => 'string|required',
            'equipment_status_id' => 'required|integer',
            'equipment_type_id' => 'required|integer',
            'images' => 'required',
        ]);
        //if the validation fails return the error
        if ($validator->fails()) {
            return response(['error' => $validator->errors(), "successful" => false], 401);
        }
        //get the user
        $user = $request->user();
        //create the equipment
        $equipment = new EquipmentModel();
        $equipment->equipment_name = $input['equipment_name'];
        $equipment->equipment_description = $input['equipment_description'];
        $equipment->equipment_status_id = $input['equipment_status_id'];
        $equipment->equipment_type_id = $input['equipment_type_id'];
        $equipment->user_id = $user->id;
        $equipment->save();

        //get the equipment id
        $equipment_id = $equipment->equipment_id;
        //get the images
        $images = $request->file('images');
        //allowed file types
        $allowedFileTypes = ['jpeg', 'jpg', 'png'];
        //loop through the images
        foreach ($images as $image) {
            //get the image name
            $fileName = $request->file('images')->getClientOriginalName();
            //get the image extension
            $fileExtension = $image->getClientOriginalExtension();
            //check if the extension is allowed
            $check = in_array($fileExtension, $allowedFileTypes);

            //if the extension is allowed
            if ($check) {
                //save the image
                $path = $request->file('images')->storeAs('/public/equipment_images/' . $equipment_id, $fileName);
                //save the images path to the database
                $equipmentImage = new EquipmentImages();
                $equipmentImage->equipment_id = $equipment_id;
                $equipmentImage->equipment_img_path = $path;
                $equipmentImage->created_at = date('Y-m-d H:i:s');
            }
        }

        //return the response
        return response(['successful' => true], 200);
    }
}
