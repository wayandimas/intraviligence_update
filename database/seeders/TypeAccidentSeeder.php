<?php

namespace Database\Seeders;

use App\Models\TypeAccident;
use Illuminate\Database\Seeder;

class TypeAccidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accident = new TypeAccident;
        $accident->nama = 'Tunggal-Kecelakaan Sendiri';
        $accident->save();

        $accident = new TypeAccident;
        $accident->nama = 'Tunggal-Menabrak Objek Tetap';
        $accident->save();

        $accident = new TypeAccident;
        $accident->nama = 'Tunggal-Menabrak Penyeberang Jalan';
        $accident->save();

        $accident = new TypeAccident;
        $accident->nama = 'Ganda-Tabrak Depan Belakang';
        $accident->save();

        $accident = new TypeAccident;
        $accident->nama = 'Ganda-Tabrak Depan Depan';
        $accident->save();

        $accident = new TypeAccident;
        $accident->nama = 'Ganda-Tabrak Depan Samping';
        $accident->save();

        $accident = new TypeAccident;
        $accident->nama = 'Ganda-Lain Lain';
        $accident->save();

        $accident = new TypeAccident;
        $accident->nama = 'Beruntun-Tabrak Depan Belakang';
        $accident->save();

        $accident = new TypeAccident;
        $accident->nama = 'Beruntun-Tabrak Depan Depan';
        $accident->save();

        $accident = new TypeAccident;
        $accident->nama = 'Beruntun-Tabrak Depan Samping';
        $accident->save();
        
        $accident = new TypeAccident;
        $accident->nama = 'Beruntun-Lain Lain ';
        $accident->save();
    }
}
