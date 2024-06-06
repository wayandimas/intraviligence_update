<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmbulanceVehicleLog extends Model
{
    use HasFactory;
    public $table = "ambulance_vehicle_log";
    protected $fillable = [
        'personil',
        'shift',
        'km_awal',
        'ban_kanan_depan',
        'ban_kanan_belakang',
        'ban_kiri_depan',
        'ban_kiri_belakang',
        'ban_serep',
        'ket_roda_ban',
        'stnk',
        'lampu_dashboard',
        'lampu_depan',
        'lampu_belakang',
        'lampu_rem',
        'lampu_sein',
        'air_conditioner',
        'klakson',
        'wiper',
        'speaker',
        'seat_belt',
        'handle_kaca_pintu',
        'ket_bagian_dalam',
        'kunci_roda',
        'p3k',
        'dongkrak',
        'ket_peralatan',
        'public_address',
        'lampu_strobo',
        'lampu_sorot',
        'apar',
        'ket_peralatan_tambahan',
        'engine_condition',
        'running_tes',
        'air_radiator',
        'oli',
        'minyak_rem',
        'oli_powering_steering',
        'ket_engine',
        'samping_kiri',
        'samping_kanan',
        'depan',
        'belakang',
        'atas',
        'ket_body_cat'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

     public function conditionStatus()
    {
        return $this->belongsTo(ConditionStatus::class,'id');
    }
     public function officer()
    {
        return $this->belongsTo(Officer::class,'id');
    }
}
