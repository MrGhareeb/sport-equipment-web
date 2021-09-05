<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentStatusModel extends Model
{
    use HasFactory;
    protected $table = 'equipment_status';
    protected $primaryKey = 'equipment_status_id';

    protected $fillable = [
        'equipment_status_id',
        'equipment_status_value',
    ];

}
