<?php

namespace Database\Seeders;

use App\Models\VehicleClass;
use Illuminate\Database\Seeder;

class VehicleClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $vehicle = new VehicleClass;
        $vehicle->nama = 'Golongan I';
        $vehicle->save();

        $vehicle = new VehicleClass;
        $vehicle->nama = 'Golongan II';
        $vehicle->save();

        $vehicle = new VehicleClass;
        $vehicle->nama = 'Golongan III';
        $vehicle->save();

        $vehicle = new VehicleClass;
        $vehicle->nama = 'Golongan IV';
        $vehicle->save();

        $vehicle = new VehicleClass;
        $vehicle->nama = 'Golongan V';
        $vehicle->save();
    }
}
