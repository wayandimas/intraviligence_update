<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SourceInformation extends Model
{
    use HasFactory;

     public $table = "source_informations";
    protected $fillable = [
        'nama',
    
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
