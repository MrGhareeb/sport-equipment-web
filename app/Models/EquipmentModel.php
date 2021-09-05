<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentModel extends Model
{
    use HasFactory;

    protected $table = 'equipments';
    protected $primaryKey = 'equipment_id';

    protected $fillable = [
        'name',
        'description',
        'equipment_type_id',
        'equipment_status_id',
        'user_id'
    ];

    public function equipmentType(){
        return $this->belongsTo('EquipmentTypeModel');
    }

    public function equipment_status(){
        return $this->belongsTo(EquipmentStatusModel::class, 'equipment_status_id', 'equipment_status_id');
    }
}
