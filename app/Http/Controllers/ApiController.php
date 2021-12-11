<?php

namespace App\Http\Controllers;

use App\Models\equipmentImagesModel;
use App\Models\EquipmentModel;
use App\Models\EquipmentTransferModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    public function getUserEquipment(Request $request)
    {
        //get the user 
        $user = $request->user();
        //get the user's equipment
        $equipments = EquipmentModel::with(['equipment_status', 'equipment_images', "equipment_type"])->where('user_id', $user->id)->get();
        $response = [
            "equipments" => $equipments,
            "successful" => true
        ];
        //return the response
        return response($response, 200);
    }

    public function getUserEquipmentByID(Request $request, $id)
    {
        //get the id from the url
        $data = ["id" => $id];
        //validate the values
        $validator = Validator::make($data, [
            'id' => 'required|integer'
        ]);
        //if the validation fails return the error
        if ($validator->fails()) {
            return response(['error' => $validator->errors(), "successful" => false], 401);
        }
        //get the user
        $user = $request->user();
        //get the equipment
        $equipments = EquipmentModel::with(['equipment_status', 'equipment_images', "equipment_type"])->where('user_id', $user->id)->where('equipment_id', $id)->get();
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

    /**
     * get the equipment_image by id
     * @param Request $request store the request
     * @param Integer $id store the id of the image
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     * @author Ali Ghareeb
     */
    public function getUserEquipmentImage(Request $request, $id)
    {
        //get the id from the url
        $data = ["id" => $id, 'lost' => $request->lost];
        //validate the values
        $validator = Validator::make($data, [
            'id' => 'required|integer',
            'lost' => 'boolean|nullable'
        ]);
        //if the validation fails return the error
        if ($validator->fails()) {
            return response(['error' => $validator->errors(), "successful" => false], 401);
        }
        //get the user
        $user = $request->user();
        //get the data from the database       
        $data = EquipmentModel::whereHas('equipment_images', function ($q) use ($id) {
            $q->where('equipment_image_id', '=', $id);
        })->get()->where('user_id', '=', $user->id);
        //if the equipment is not found return an error
        if (count($data) > 0) {
            return Storage::response($data[0]->equipment_images[0]->equipment_image_path);
        }
        return response(['error' => ['message' => 'Equipment image not found or the image do not belong to the user'], "successful" => false], 404);
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
            'images' => 'array|required',
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
            $fileName = $image->getClientOriginalName();
            //get the image extension
            $fileExtension = $image->getClientOriginalExtension();
            //check if the extension is allowed
            $check = in_array($fileExtension, $allowedFileTypes);
            //if the extension is allowed
            if ($check) {
                //save the image
                $path = $image->storeAs('/public/equipment_images/' . $equipment_id, $fileName);
                //save the images path to the database
                $equipmentImage = new EquipmentImagesModel();
                $equipmentImage->equipment_id = $equipment_id;
                $equipmentImage->equipment_image_path = $path;
                $equipmentImage->created_at = date('Y-m-d H:i:s');
                $inserted = $equipmentImage->save();
                if (!$inserted) {
                    return response(['successful' => false], 400);
                }
            } else {
                //if the extension is not allowed return an error
                return response(['error' => ['message' => 'File type not allowed'], "successful" => false], 400);
            }
        }
        //return the response
        return response(['successful' => true], 200);
    }



    public function updateUserEquipment(Request $request, $id)
    {
        //get the values from the request
        $input = $request->all();
        //validate the values
        $validator = Validator::make($input, [
            'equipment_name' => 'required|string',
            'equipment_description' => 'string|required',
            'equipment_status_id' => 'required|integer',
            'equipment_type_id' => 'required|integer',
        ]);
        //if the validation fails return the error
        if ($validator->fails()) {
            return response(['error' => $validator->errors(), "successful" => false], 401);
        }
        //get the user
        $user = $request->user();
        //check the equipment status if the item is marked as forTransfer
        if ($input['equipment_status_id'] == 6) {
            $inserted = EquipmentTransferModel::insert([
                "equipment_transfer_token" => Str::random(15),
                "equipment_id" => $id,
                "user_id" => $user->id,
                "created_at" => date('Y-m-d H:i:s')
            ]);
        }
        //update the equipment values
        $updated = EquipmentModel::where('user_id', $user->id)->where('equipment_id', $id)->update([
            'equipment_name' => $input['equipment_name'],
            'equipment_description' => $input['equipment_description'],
            'equipment_status_id' => $input['equipment_status_id'],
            'equipment_type_id' => $input['equipment_type_id'],
        ]);
        //if the equipment is not found return an error
        if ($updated) {
            return response(['successful' => true], 200);
        } else {
            return response(['error' => ['message' => 'Equipment not found'], "successful" => false], 404);
        }
    }

    public function getTransferToken(Request $request, $id)
    {
        //get the values from the request
        $input = ["equipment_id" => $id];

        //validate the values
        $validator = Validator::make($input, [
            'equipment_id' => 'required|integer'
        ]);
        //if the validation fails return the error
        if ($validator->fails()) {
            return response(['error' => $validator->errors(), "successful" => false], 401);
        }
        //get the user
        $user = $request->user();
        //get the transfer data of the equipment from the database
        $equipmentTransfer = EquipmentTransferModel::where("user_id", $user->id)->where("equipment_id", $input["equipment_id"])->get();

        // check if there is a transfer for this equipment that is valid
        if (!empty($equipmentTransfer)) {
            //get date of insert and add 5 minutes
            $expiryDate = Date("Y-m-d H:i:s", strtotime("5 minutes", strtotime($equipmentTransfer[0]->created_at)));

            //get current date
            $currentDate = date('Y-m-d H:i:s');
            if ($currentDate > $expiryDate) {
                return response(['error' => ['message' => 'Transfer time have expired'], "successful" => false], 410);
            }
            return response(['equipment_transfer' => $equipmentTransfer, 'successful' => true, 'expiryDate' => $expiryDate, 'currDate' => $currentDate], 200);
        }
        return response(['error' => ['message' => 'No transfer found'], "successful" => false], 404);
    }

    public function transferEquipment(Request $request, $token)
    {
        //get the values from the request
        $input = ["token" => $token];
        //validate the values
        $validator = Validator::make($input, [
            'token' => 'required|string'
        ]);
        //if the validation fails return the error
        if ($validator->fails()) {
            return response(['error' => $validator->errors(), "successful" => false], 401);
        }
        //get the user
        $userToTransfer = $request->user();
        $equipmentTransfer = EquipmentTransferModel::where("equipment_transfer_token", $token)->first();
        //check if the equipment transfer not found
        if (empty($equipmentTransfer)) {
            return response(['error' => ['message' => 'Equipment transfer not found'], "successful" => false], 404);
        }
        //get the equipment
        $equipment = EquipmentModel::with('equipment_status')->where('equipment_id', $equipmentTransfer['equipment_id'])->get();
        //if the equipment is not found return an error
        if (!empty($equipment)) {
            //check if the equipment marked as ForTransfer
            if ($equipment[0]->equipment_status_id == 6) {
                //check if the token given is valid
                if ($token != $equipmentTransfer["equipment_transfer_token"]) {
                    return response(['error' => ['message' => 'Invalid transfer token'], "successful" => false], 410);
                }
                // check that the transfer hasn't expired yet
                $expiryDate = Date("Y:M:s", strtotime("5 minutes", strtotime($equipmentTransfer["created_at"])));
                //get current date
                $currentDate = date('Y-m-d H:i:s');
                if ($currentDate > $expiryDate) {
                    return response(['error' => ['message' => 'Transfer time have expired'], "successful" => false], 410);
                }
                //update the equipment -> user_id to the new owner
                $updated = EquipmentModel::where('equipment_id', $equipmentTransfer['equipment_id'])->update([
                    'user_id' => $userToTransfer->id,
                    "equipment_status_id" => 1
                ]);

                //update the equipment transfer values
                if ($updated) {
                    $equipmentTransfer->equipment_transfer_token = '';
                    $equipmentTransfer->new_user_id = $userToTransfer->id;
                    $equipment->update_at = date('Y-m-d H:i:s');
                    $equipmentTransfer->save();
                    //return the response
                    return response(['successful' => true], 200);
                }
                return response(['error' => ['message' => 'Update failed'], "successful" => false], 404);
            }
        }
        return response(['error' => ['message' => 'Equipment not found'], "successful" => false], 404);
    }


    public function deleteUserEquipment(Request $request, $id)
    {
        //get the values from the request
        $input = ["id" => $id];
        //validate the values
        $validator = Validator::make($input, ["id" => 'required|integer']);
        //if the validation fails return the error
        if ($validator->fails()) {
            return response(['error' => $validator->errors(), "successful" => false], 401);
        }
        //get the user
        $user = $request->user();
        //get the equipment
        $equipment = EquipmentModel::where('user_id', $user->id)->where('equipment_id', $id)->get();
        //if the equipment is not found return an error
        if (count($equipment) > 0) {
            //delete the equipment
            $updated = EquipmentModel::where('user_id', $user->id)->where('equipment_id', $id)->update(
                [
                    'updated_at' => date('Y-m-d H:i:s'),
                    'equipment_status_id' => 5
                ]
            );
            //if the equipment is not found return an error
            if ($updated) {
                return response(['successful' => true], 200);
            }
        } else {
            return response(['error' => ['message' => 'Equipment not found'], "successful" => false], 404);
        }
    }
}
