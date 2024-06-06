<?php

namespace Database\Seeders;

use App\Models\VehicleType;
use Illuminate\Database\Seeder;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicle = new VehicleType;
        $vehicle->nama = 'Bus';
        $vehicle->save();

        $vehicle = new VehicleType;
        $vehicle->nama = 'Makrobus (Elf)';
        $vehicle->save();

        $vehicle = new VehicleType;
        $vehicle->nama = 'Minibus';
        $vehicle->save();

        $vehicle = new VehicleType;
        $vehicle->nama = 'Pickup (Box atau Losbak)';
        $vehicle->save();

        $vehicle = new VehicleType;
        $vehicle->nama = 'Sedan';
        $vehicle->save();

        $vehicle = new VehicleType;
        $vehicle->nama = 'Trailer (Kepala Truk dan Kereta Gandeng 4-6 Sumbu)';
        $vehicle->save();

        $vehicle = new VehicleType;
        $vehicle->nama = 'Tronton (Truk 3 Sumbu)';
        $vehicle->save();

        $vehicle = new VehicleType;
        $vehicle->nama = 'Truk (Box atau Tangki)';
        $vehicle->save();
    }
}
