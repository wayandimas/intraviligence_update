<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefuelingReport extends Model
{
    use HasFactory;

    public $table = "refueling_report";
    protected $fillable = [
        'unit_pengisian',
        'tanggal_pengisian',
        'waktu_pengisian',
        'odo_meter',
        'jumlah_pengisian',
        'personil1',
        'personil2',
        'kembalian',
        'foto_struk',
    
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}

