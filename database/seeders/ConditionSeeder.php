<?php

namespace Database\Seeders;

use App\Models\Condition;
use Illuminate\Database\Seeder;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $condition = new Condition;
        $condition->nama = 'Baik';
        $condition->save();

        $condition = new Condition;
        $condition->nama = 'Rusak';
        $condition->save();

    }
}
