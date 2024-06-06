<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $section = new Section;
        $section->nama = 'MMN';
        $section->save();

        $section = new Section;
        $section->nama = 'JTSE';
        $section->save();
        
        
    }
}
