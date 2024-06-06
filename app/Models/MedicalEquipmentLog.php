<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalEquipmentLog extends Model
{
    use HasFactory;

     public $table = "medical_equipment_log";

     public function conditionStatus()
    {
        return $this->belongsTo(ConditionStatus::class,'id');
    }
     public function officer()
    {
        return $this->belongsTo(Officer::class,'id');
    }
}
