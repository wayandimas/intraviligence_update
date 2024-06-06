<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsetLocation extends Model
{
    use HasFactory;
     public $table = "aset_location";
     protected $fillable = [
        'nama'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
