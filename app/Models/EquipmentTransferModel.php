<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentTransferModel extends Model
{
    use HasFactory;
    protected $table = 'equipment_transfer';
    protected $primaryKey = 'equipment_transfer_id';
    protected $fillable = [
        'equipment_transfer_id',
        'user_id',
        'equipment_id',
        'new_user_id',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'equipment_transfer_id'
    ];
}
