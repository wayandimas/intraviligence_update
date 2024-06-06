<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrafficAccidentVictim extends Model
{
    use HasFactory;
    protected $table = 'traffic_accident_victim';
    protected $fillable = ['report_id', 'nama', 'umur', 'kondisi', 'tindakan'];
}
