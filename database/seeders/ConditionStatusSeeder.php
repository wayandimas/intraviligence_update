<?php

namespace Database\Seeders;

use App\Models\ConditionStatus;
use Illuminate\Database\Seeder;

class ConditionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $condition_status = new ConditionStatus;
        $condition_status->status = true;
        $condition_status->kondisi= true;
        $condition_status->save();

        $condition_status = new ConditionStatus;
        $condition_status->status = true;
        $condition_status->kondisi= false;
        $condition_status->save();

        $condition_status = new ConditionStatus;
        $condition_status->status = false;
        $condition_status->kondisi= false;
        $condition_status->save();
     

    }
}
