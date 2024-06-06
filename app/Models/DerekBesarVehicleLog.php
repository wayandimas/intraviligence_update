<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DerekBesarVehicleLog extends Model
{
    use HasFactory;
    public $table = "derek_besar_vehicle_log";
    protected $fillable = [
        'personil',
        'shift',
        'km_awal',
        'ban_kanan_depan',
        'ban_kanan_belakang',
        'ban_kiri_depan',
        'ban_kiri_belakang',
        'ban_serep',
        'velg_roda_drop',
        'ket_roda_ban',
        'stnk',
        'lampu_dashboard',
        'lampu_depan',
        'lampu_belakang',
        'lampu_rem',
        'lampu_sein',
        'lampu_mundur',
        'lampu_kabut',
        'radio_tape',
        'klakson',
        'wiper',
        'speaker',
        'seat_belt',
        'ket_bagian_dalam',
        'dongkrak_hidrolik',
        'tangki',
        'winch_warm',
        'kait_hook',
        'kunci_roda',
        'dongkrak_buaya'
    ];
}
