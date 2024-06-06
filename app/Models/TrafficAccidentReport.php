<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrafficAccidentReport extends Model
{
    use HasFactory;
    protected $table = 'traffic_accident_report';

    // Relasi dengan VehicleClass
    public function vehicleClasses()
    {
        return $this->belongsToMany(VehicleClass::class, 'traffic_accident_report_vehicle_class', 'report_id', 'vehicle_class_id');
    }
    public function detail()
    {
        return $this->hasMany(TrafficAccidentReportVehicleClass::class, 'report_id');
    }
    public function image()
    {
        return $this->hasMany(ImageTrafficAccident::class, 'id_report');
    }
}
