<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
    use HasFactory;
     public $table = "condition";
    protected $fillable = [
        'nama'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
