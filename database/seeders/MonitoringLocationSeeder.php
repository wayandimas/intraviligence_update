<?php

namespace Database\Seeders;

use App\Models\MonitoringLocation;
use Illuminate\Database\Seeder;

class MonitoringLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $monitoringLocation = new MonitoringLocation;
        $monitoringLocation->nama = 'Seksi I';
        $monitoringLocation->save(); 

        $monitoringLocation = new MonitoringLocation;
        $monitoringLocation->nama = 'Seksi II';
        $monitoringLocation->save(); 

        $monitoringLocation = new MonitoringLocation;
        $monitoringLocation->nama = 'Seksi III';
        $monitoringLocation->save(); 

        $monitoringLocation = new MonitoringLocation;
        $monitoringLocation->nama = 'Seksi IV';
        $monitoringLocation->save(); 

        $monitoringLocation = new MonitoringLocation;
        $monitoringLocation->nama = 'Kantor Satelit';
        $monitoringLocation->save(); 

        $monitoringLocation = new MonitoringLocation;
        $monitoringLocation->nama = 'Kantor Lalin';
        $monitoringLocation->save(); 

        $monitoringLocation = new MonitoringLocation;
        $monitoringLocation->nama = 'Kantor Cambayya';
        $monitoringLocation->save(); 

        $monitoringLocation = new MonitoringLocation;
        $monitoringLocation->nama = 'Kantor Kaluku Bodoa';
        $monitoringLocation->save(); 

        $monitoringLocation = new MonitoringLocation;
        $monitoringLocation->nama = 'Kantor Pusat';
        $monitoringLocation->save(); 

        $monitoringLocation = new MonitoringLocation;
        $monitoringLocation->nama = 'Lokasi Lainnya';
        $monitoringLocation->save(); 
    }
}
