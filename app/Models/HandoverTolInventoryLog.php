<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HandoverTolInventoryLog extends Model
{
    use HasFactory;

    public $table = "handover_tol_inventory_log";
    protected $fillable = [
        'personil',
        'shift',
        'jumlah_handy_talkie',
        'handy_talkie',
        'jumlah_batok_charger',
        'batok_charger',
        'jumlah_adapter_charger',
        'adapter_charger',
        'jumlah_tongkat_t',
        'tongkat_t',
        'jumlah_tali_sling',
        'tali_sling',
        'jumlah_amplifier',
        'amplifier',
        'jumlah_wireless',
        'wireless',
        'jumlah_alarm',
        'alarm',
        'jumlah_senter_lalin',
        'senter_lalin',
        'jumlah_apar',
        'apar',
        'jumlah_box_apar',
        'box_apar',
        'jumlah_ac',
        'ac',
        'jumlah_jas_hujan',
        'jas_hujan',
        'jumlah_layar_monitor',
        'layar_monitor',
        'jumlah_cctv',
        'cctv',
        'jumlah_lla',
        'lla',
        'jumlah_r_max',
        'r_max',
        'jumlah_r_21',
        'r_21',
        'jumlah_mesin_genset',
        'mesin_genset',
        'jumlah_accu',
        'accu',
        'jumlah_r_stop',
        'r_stop',
        'jumlah_r_palang',
        'r_palang',
        'jumlah_sepatu_boat',
        'sepatu_boat',
        'jumlah_payung',
        'payung',
        'jumlah_dispenser',
        'dispenser',
        'jumlah_galon',
        'galon',
        'jumlah_speaker_active',
        'speaker_active',
        'jumlah_rubber_cone',
        'rubber_cone',
        'keterangan'
    ];
     protected $hidden = [
        'created_at',
        'updated_at',
    ];
}

