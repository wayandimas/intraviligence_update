<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatroliVehicleLog extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $table = "patroli_vehicle_log";
    protected $fillable = [
        'personil1',
        'personil2',
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
