<?php

namespace Database\Seeders;

use App\Models\SourceInformation;
use Illuminate\Database\Seeder;

class SourceInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $source = new SourceInformation;
        $source->nama = '801';
        $source->save();

        $source = new SourceInformation;
        $source->nama = '802';
        $source->save();

        $source = new SourceInformation;
        $source->nama = '803';
        $source->save();

        $source = new SourceInformation;
        $source->nama = 'Camar (PJR)';
        $source->save();

        $source = new SourceInformation;
        $source->nama = 'Derek';
        $source->save();

        $source = new SourceInformation;
        $source->nama = 'Operasional Lainnya';
        $source->save();

        $source = new SourceInformation;
        $source->nama = 'Security Tol';
        $source->save();

        $source = new SourceInformation;
        $source->nama = 'Senkom';
        $source->save();

        $source = new SourceInformation;
        $source->nama = 'Staff Pelayanan Lalu Lintas';
        $source->save();

        $source = new SourceInformation;
        $source->nama = 'TIS Officer';
        $source->save();

    }
}
