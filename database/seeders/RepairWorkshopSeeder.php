<?php

namespace Database\Seeders;

use App\Models\RepairWorkshop;
use Illuminate\Database\Seeder;

class RepairWorkshopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $repair = new RepairWorkshop;
        $repair->nama = 'Hankook Mahaputra Pettarani';
        $repair->save();

        $repair = new RepairWorkshop;
        $repair->nama = 'Hankook Mahaputra Bandang';
        $repair->save();

        $repair = new RepairWorkshop;
        $repair->nama = 'Hankook Mahaputra Mandai';
        $repair->save();

        $repair = new RepairWorkshop;
        $repair->nama = 'Bengkel Kurnia Rapokalling';
        $repair->save();

        $repair = new RepairWorkshop;
        $repair->nama = 'Bengkel Garasi 767';
        $repair->save();

        $repair = new RepairWorkshop;
        $repair->nama = 'Bengkel Fajar';
        $repair->save();

        $repair = new RepairWorkshop;
        $repair->nama = 'Servis Dinamo "Saiful" Pettarani';
        $repair->save();

        $repair = new RepairWorkshop;
        $repair->nama = 'Bosowa Berlian';
        $repair->save();

        $repair = new RepairWorkshop;
        $repair->nama = 'Sumber Mas Ban';
        $repair->save();


    }
}
