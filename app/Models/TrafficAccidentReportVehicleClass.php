<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrafficAccidentReportVehicleClass extends Model
{
    use HasFactory;
    protected $table = 'traffic_accident_report_vehicle_class';

    protected $fillable = [
        'report_id', // Add any other fields that are fillable as well
        'vehicle_class_id',
        'nopol',
        // Add other fields here
    ];


}
