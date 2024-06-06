<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityMutationServiceTol extends Model
{
    use HasFactory;
    public $table = "activity_mutation_service_tol";
     protected $fillable = [
        'personil1',
        'personil2',
        'unit',
        'waktu_pemantauan',
        'lokasi_pemantauan',
        'keterangan',
        
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
