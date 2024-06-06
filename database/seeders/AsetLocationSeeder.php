<?php

namespace Database\Seeders;

use App\Models\AsetLocation;
use Illuminate\Database\Seeder;

class AsetLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $location = new AsetLocation;
        $location->nama = 'Gerbang Tol Bira Barat';
        $location->save();

        $location = new AsetLocation;
        $location->nama = 'Gerbang Tol Bira Timur';
        $location->save();

        $location = new AsetLocation;
        $location->nama = 'Gerbang Tol Biringkanaya ';
        $location->save();

        $location = new AsetLocation;
        $location->nama = 'Gerbang Tol Cambaya';
        $location->save();

        $location = new AsetLocation;
        $location->nama = 'Gerbang Tol Kaluku Bodoa';
        $location->save();

        $location = new AsetLocation;
        $location->nama = 'Gerbang Tol Parangloe';
        $location->save();

        $location = new AsetLocation;
        $location->nama = 'Gerbang Tol Tallo Barat';
        $location->save();

        $location = new AsetLocation;
        $location->nama = 'Gerbang Tol Tallo Timur';
        $location->save();

        $location = new AsetLocation;
        $location->nama = 'Gerbang Tol Tallo Tamalanrea';
        $location->save();


    }
}
