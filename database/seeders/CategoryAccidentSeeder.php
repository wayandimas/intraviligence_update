<?php

namespace Database\Seeders;

use App\Models\CategoryAccident;
use Illuminate\Database\Seeder;

class CategoryAccidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new CategoryAccident;
        $category->nama = 'Kecelakaan dengan Kerugian Materi';
        $category->save();

        $category = new CategoryAccident;
        $category->nama = 'Kecelakaan dengan Korban Luka';
        $category->save();

        $category = new CategoryAccident;
        $category->nama = 'Kecelakaan dengan Korban Meninggal';
        $category->save();

    }
}
