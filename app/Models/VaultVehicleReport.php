<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaultVehicleReport extends Model
{
    use HasFactory;
    public $table = "vault_vehicle_report";
    protected $fillable = [
        'stasioning',
        'seksi',
        'stasioning',
        'jalur',
        'lajur',
        'cuaca',
        'sumber_informasi',
        'tanggal_kejadian',
        'waktu_kejadian',
        'waktu_sampai',
        'respond_time',
        'waktu_selesai',
        'durasi_penanganan',
        'jenis_gangguan',
        'golongan_kendaraan',
        'jenis_kendaraan',
        'plat_nomor',
        'asal_perjalanan',
        'tujuan_perjalanan',
        'personil1',
        'personil2',
        'personil3',
        'petugas_derek',
        'unit_derek',
        'waktu_dibutuhkan',
        'waktu_sampai_tkp',
        'respond_time_derek',
        'keterangan',
        'dokumentasi',
    
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function image()
    {
        return $this->hasMany(ImageVault::class, 'id_report');
    }
}
