<?php

namespace Database\Seeders;

use App\Models\MaintenanceType;
use Illuminate\Database\Seeder;

class MaintenanceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maintenance = new MaintenanceType;
        $maintenance->nama = 'Pergantian Oli Mesin';
        $maintenance->save(); 

        $maintenance = new MaintenanceType;
        $maintenance->nama = 'Pergantian Saringan Oli';
        $maintenance->save();

        $maintenance = new MaintenanceType;
        $maintenance->nama = 'Pergantian Oli Gardan';
        $maintenance->save();

        $maintenance = new MaintenanceType;
        $maintenance->nama = 'Pergantian Oli Perseneling';
        $maintenance->save();

        $maintenance = new MaintenanceType;
        $maintenance->nama = 'Pergantian Saringan Udara';
        $maintenance->save();

        $maintenance = new MaintenanceType;
        $maintenance->nama = 'Pergantian Saringan Solar';
        $maintenance->save();

        $maintenance = new MaintenanceType;
        $maintenance->nama = 'Pergantian Ban';
        $maintenance->save();

        $maintenance = new MaintenanceType;
        $maintenance->nama = 'Pergantian Kampas Rem';
        $maintenance->save();

        $maintenance = new MaintenanceType;
        $maintenance->nama = 'Spooring';
        $maintenance->save();

        $maintenance = new MaintenanceType;
        $maintenance->nama = 'Balancing';
        $maintenance->save();

        $maintenance = new MaintenanceType;
        $maintenance->nama = 'Pergantian Aki';
        $maintenance->save();

        $maintenance = new MaintenanceType;
        $maintenance->nama = 'Pencucian Radiator';
        $maintenance->save();

        $maintenance = new MaintenanceType;
        $maintenance->nama = 'Pergantian Lampu Utama';
        $maintenance->save();

        $maintenance = new MaintenanceType;
        $maintenance->nama = 'Pergantian Lampu Sein';
        $maintenance->save();

        $maintenance = new MaintenanceType;
        $maintenance->nama = 'Pergantian Lampu Rem';
        $maintenance->save();

        $maintenance = new MaintenanceType;
        $maintenance->nama = 'Pergantian Lampu Senja';
        $maintenance->save();

        $maintenance = new MaintenanceType;
        $maintenance->nama = 'Pergantian Sparepat Lainnya (Tulis di keterangan)';
        $maintenance->save();


    }
}
