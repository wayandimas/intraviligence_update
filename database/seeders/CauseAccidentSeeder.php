<?php

namespace Database\Seeders;

use App\Models\CauseAccident;
use Illuminate\Database\Seeder;

class CauseAccidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accident = new CauseAccident;
        $accident->nama = 'Pengemudi';
        $accident->save();

        $accident = new CauseAccident;
        $accident->nama = 'Kendaraan';
        $accident->save();

        $accident = new CauseAccident;
        $accident->nama = 'Lingkungan';
        $accident->save();

        $accident = new CauseAccident;
        $accident->nama = 'Lain-Lain (Bencana Alam, Gangguan Kamtibmas dll)';
        $accident->save();

    }
}
