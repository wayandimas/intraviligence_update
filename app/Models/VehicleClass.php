<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleClass extends Model
{
    
    public $table = "vehicle_class";
    protected $fillable = [
        'nama',
    
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

     public function trafficAccidentReports()
    {
        return $this->belongsToMany(TrafficAccidentReport::class, 'traffic_accident_report_vehicle_class', 'vehicle_class_id', 'report_id');
    }
}
