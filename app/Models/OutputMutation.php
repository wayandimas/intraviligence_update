<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutputMutation extends Model
{
    use HasFactory;
     public $table = "output_mutation";
     protected $fillable = [
        'no_mutation'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}

