<?php

namespace Database\Seeders;

use App\Models\Lane;
use Illuminate\Database\Seeder;

class LaneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $lane = new Lane;
        $lane->nama = '1';
        $lane->save();

        $lane = new Lane;
        $lane->nama = '2';
        $lane->save();

        $lane = new Lane;
        $lane->nama = 'Bahu Luar';
        $lane->save();

        $lane = new Lane;
        $lane->nama = 'Bahu Dalam';
        $lane->save();

    }
}
