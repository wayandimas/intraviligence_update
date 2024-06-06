<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAccident extends Model
{
    use HasFactory;
     public $table = "category_accident";

     protected $fillable = [
        'nama',
    
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
