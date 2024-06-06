<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeActivity extends Model
{
    use HasFactory;
    public $table = "type_activity";

     protected $fillable = [
        'nama',
    
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
