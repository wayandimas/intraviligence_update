<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceReport extends Model
{
    use HasFactory;
    public $table = "maintenance_report";
    protected $fillable = [
        'unit_perawatan',
        'tanggal_perawatan',
        'odo_meter',
        'jenis_perawatan',
        'bengkel',
        'keterangan',
        'personil1',
        'personil2',
        'foto_odo_meter',
    
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
