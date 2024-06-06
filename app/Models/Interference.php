<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interference extends Model
{
    use HasFactory;
     protected $fillable = [
        'nama',
    
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
