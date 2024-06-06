<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Operasional;
class OperasionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $operasional = new Operasional;
        $operasional->nama = 'Patroli';
        $operasional->save();

        $operasional = new Operasional;
        $operasional->nama = 'Derek';
        $operasional->save();

        $operasional = new Operasional;
        $operasional->nama = 'Rescue';
        $operasional->save();

        $operasional = new Operasional;
        $operasional->nama = 'Ambulans';
        $operasional->save();

        $operasional = new Operasional;
        $operasional->nama = 'Security';
        $operasional->save();

        $operasional = new Operasional;
        $operasional->nama = 'Kosong';
        $operasional->save();

        $operasional = new Operasional;
        $operasional->nama = 'Kord-Pelayanan-Jalan-Tol';
        $operasional->save();

        $operasional = new Operasional;
        $operasional->nama = 'Kord-ERT';
        $operasional->save();

        $operasional = new Operasional;
        $operasional->nama = 'Kord-Security';
        $operasional->save();

        $operasional = new Operasional;
        $operasional->nama = 'Admin';
        $operasional->save();

        $operasional = new Operasional;
        $operasional->nama = 'Senkom';
        $operasional->save();

        $operasional = new Operasional;
        $operasional->nama = 'Intravilligence';
        $operasional->save();

        $operasional = new Operasional;
        $operasional->nama = 'Super Admin';
        $operasional->save();

        $operasional = new Operasional;
        $operasional->nama = 'TIS';
        $operasional->save();



        
    }
}
