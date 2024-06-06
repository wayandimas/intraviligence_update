<?php

namespace Database\Seeders;

use App\Models\VictimCondition;
use Illuminate\Database\Seeder;

class VictimConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $condition = new VictimCondition;
        $condition->nama = 'Luka Ringan';
        $condition->save();

        $condition = new VictimCondition;
        $condition->nama = 'Luka Berat';
        $condition->save();

        $condition = new VictimCondition;
        $condition->nama = 'Meninggal';
        $condition->save();

        $condition = new VictimCondition;
        $condition->nama = 'Tidak Luka';
        $condition->save();

    }
}
