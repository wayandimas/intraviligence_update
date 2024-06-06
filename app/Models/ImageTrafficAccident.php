<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageTrafficAccident extends Model
{
    use HasFactory;
    public $table = "image_traffic_accident";
    protected $fillable = [
        'id_report',
        'nama'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
