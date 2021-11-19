<?php

namespace App\Http\Controllers;

use App\Models\equipmentImagesModel;
use App\Models\EquipmentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipmentController extends Controller
{
    public function add(Request $request){
        // validate the request
        $request->validate([
            'itemName' => 'required',
            'ItemDescription'=>'required',
            'status'=>'required',
            'equipmentType'=>'required',
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
        if($images == null){
            return redirect('/')->with('message', 'Equipment has been added without an image');
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
            }else{
                //if the extension is not allowed return an error
                return redirect('/')->with('error', 'File type is not allowed');
            }

        return redirect('/')->with('message', 'Equipment has been added');
       

    }
}
}
