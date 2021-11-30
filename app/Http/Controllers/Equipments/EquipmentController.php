<?php

namespace App\Http\Controllers\Equipments;

use App\Http\Controllers\Controller;
use App\Models\equipmentImagesModel;
use App\Models\EquipmentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EquipmentController extends Controller
{
    public function add(Request $request)
    {
        // validate the request
        $request->validate([
            'itemName' => 'required',
            'ItemDescription' => 'required',
            'status' => 'required',
            'equipmentType' => 'required',
        ]);
        //store the equipment in the database
        $equipment = new EquipmentModel();
        $equipment->equipment_name = $request->itemName;
        $equipment->equipment_description = $request->ItemDescription;
        $equipment->equipment_status_id = $request->status;
        $equipment->equipment_type_id = $request->equipmentType;
        $equipment->user_id = Auth::user()->id;
        $inserted = $equipment->save();
        if (!$inserted) {
            return redirect('/')->with('error', 'adding equipment failed');
        }
        //get the equipment id
        $equipment_id = $equipment->equipment_id;
        //get the images
        $images = $request->file('images');
        if ($images == null) {
            return redirect('/')->with('alert', 'Equipment has been added without an image');
        }
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
                    return redirect('/')->with('error', 'Equipment image has not been added');
                }
            } else {
                //if the extension is not allowed return an error
                return redirect('/')->with('error', 'File type is not allowed');
            }

            return redirect('/')->with('message', 'Equipment has been added');
        }
    }


    public function edit(Request $request)
    {
        // validate the request
        $input = $request->validate([
            'itemName' => 'required',
            'ItemDescription' => 'required',
            'status' => 'required',
            'equipmentType' => 'required',
            'equipmentId' => 'required'
        ]);
        //update the equipment in the database
        //get the user
        $user = $request->user();
        $updated = EquipmentModel::where('user_id', $user->id)->where('equipment_id', $input['equipmentId'])->update([
            'equipment_name' => $input['itemName'],
            'equipment_description' => $input['ItemDescription'],
            'equipment_status_id' => $input['status'],
            'equipment_type_id' => $input['equipmentType'],
        ]);
        //if the equipment is not found return an error
        if ($updated) {
            return redirect('/')->with('message', 'Equipment has been updated');
        }
        return redirect('/')->with('error', ' Error equipment has not been updated');
    }



    public function delete(Request $request, $id)
    {
        //get the user
        $user = $request->user();
        //get the equipment
        $equipment = EquipmentModel::where('user_id', $user->id)->where('equipment_id', $id)->first();
        //if the equipment is not found return an error
        if ($equipment == null) {
            return redirect('/')->with('error', 'Equipment not found');
        }
        //get the equipment images
        $equipmentImages = EquipmentImagesModel::where('equipment_id', $id)->get();
        //delete the equipment images from the storage
        foreach ($equipmentImages as $image) {
            Storage::delete($image->equipment_image_path);
        }
        //delete the images from the database
        EquipmentImagesModel::where('equipment_id', $id)->delete();
        //delete the equipment
        $deleted = $equipment->delete();
        //if the equipment is not deleted return an error
        if ($deleted) {
            return redirect('/')->with('message', 'Equipment has been deleted');
        }
        return redirect('/')->with('error', 'Error equipment has not been deleted');
    }
}
