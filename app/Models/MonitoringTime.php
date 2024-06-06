<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringTime extends Model
{
    use HasFactory;
    public $table = "monitoring_time";
     protected $fillable = [
        'shift',
        'start_time',
        'end_time'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
