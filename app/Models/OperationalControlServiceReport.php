<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationalControlServiceReport extends Model
{
    use HasFactory;
    public $table = "operational_control_service_report";
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
        'respon_time',
        'waktu_selesai',
        'durasi_penanganan',
        'jenis_kegiatan',
        'golongan_kegiatan',
        'jenis_kegiatan',
        'deskripsi_kegiatan',
        'asal_perjalanan',
        'tujuan_perjalanan',
        'personil1',
        'personil2',
        'personil3',
        'personil4',
        'personil5',
        'keterangan',
        'dokumentasi',
    
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
     public function image()
    {
        return $this->hasMany(ImageOperasional::class, 'id_report');
    }

}
