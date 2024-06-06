<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    use HasFactory;

    public $table = "vehicle_type";
    protected $fillable = [
        'nama',
    
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
