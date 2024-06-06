<?php

namespace Database\Seeders;

use App\Models\LossAccident;
use Illuminate\Database\Seeder;

class LossAccidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $loss = new LossAccident;
        $loss->nama = 'Kecelakaan dengan Kerugian Aset Tol';
        $loss->save();

        $loss = new LossAccident;
        $loss->nama = 'Kecelakaan tidak dengan Kerugian Aset Tol';
        $loss->save();

    }
}
