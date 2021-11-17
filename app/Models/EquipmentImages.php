<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentImages extends Model
{
    use HasFactory;

    protected $table = 'equipment_images';
    protected $primaryKey = 'equipment_image_id';
    protected $fillable = [
        'equipment_id', 
        'equipment_image_path',
        'created_at',
        'updated_at'
    ];
}
