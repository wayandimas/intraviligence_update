<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringLocation extends Model
{
    use HasFactory;
    public $table = "monitoring_locations";
     protected $fillable = [
        'nama',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
