<?php

namespace Database\Seeders;

use App\Models\MaintenanceUnit;
use Illuminate\Database\Seeder;

class MaintenanceUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maintenance = new MaintenanceUnit;
        $maintenance->nama = '801 - B 9224 EH - Mitsubishi Triton';
        $maintenance->save(); 

        $maintenance = new MaintenanceUnit;
        $maintenance->nama = '801 New - DD 8636 SV - Mitsubishi Triton';
        $maintenance->save(); 

        $maintenance = new MaintenanceUnit;
        $maintenance->nama = '802 - DD 8589 RS - Mitsubishi Triton';
        $maintenance->save(); 

        $maintenance = new MaintenanceUnit;
        $maintenance->nama = '803 - DD 8588 RS - Mitsubishi Triton';
        $maintenance->save(); 

        $maintenance = new MaintenanceUnit;
        $maintenance->nama = 'Ambulans - B 7630 AB - Mitsubishi L300';
        $maintenance->save(); 

        $maintenance = new MaintenanceUnit;
        $maintenance->nama = 'Derek Besar - B 9257 EH - Mitsubishi Fuso';
        $maintenance->save(); 

        $maintenance = new MaintenanceUnit;
        $maintenance->nama = 'Derek Kecil - DD 8551 KI - Toyota Dyna';
        $maintenance->save(); 

        $maintenance = new MaintenanceUnit;
        $maintenance->nama = 'Rescue - B 9705 FM - Mitsubishi L300';
        $maintenance->save(); 

        $maintenance = new MaintenanceUnit;
        $maintenance->nama = 'PJR 7015 - 122518-XIV - Toyota Vios';
        $maintenance->save(); 

        $maintenance = new MaintenanceUnit;
        $maintenance->nama = 'PJR 7014 - 122517-XIV - Toyota Vios';
        $maintenance->save(); 

        $maintenance = new MaintenanceUnit;
        $maintenance->nama = 'PJR 7011 - 122559-XIV - Mazda';
        $maintenance->save(); 

        $maintenance = new MaintenanceUnit;
        $maintenance->nama = 'Operasional Pelayanan Layanan Lalu Lintas - DD 1706 SJ - Mobilio';
        $maintenance->save(); 


    }
}
