<?php

namespace Database\Seeders;

use App\Models\Weather;
use Illuminate\Database\Seeder;

class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $weather = new Weather;
        $weather->nama = 'Cerah';
        $weather->save();

        $weather = new Weather;
        $weather->nama = 'Gerimis';
        $weather->save();

        $weather = new Weather;
        $weather->nama = 'Hujan';
        $weather->save();

        $weather = new Weather;
        $weather->nama = 'Mendung';
        $weather->save();
    }
}
