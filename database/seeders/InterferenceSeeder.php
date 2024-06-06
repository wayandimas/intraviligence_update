<?php

namespace Database\Seeders;

use App\Models\Interference;
use Illuminate\Database\Seeder;

class InterferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
        $interference = new Interference;
        $interference->nama = '101-Bodi dan Rangka-Bumper';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '102-Bodi dan Rangka-Dashboard';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '103-Bodi dan Rangka-Kaca';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '104-Bodi dan Rangka-Kap';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '105-Bodi dan Rangka-Knalpot';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '106-Bodi dan Rangka-Pintu';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '201-Elektrikal-Aki';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '202-Elektrikal-Dinamo Stater';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '203-Elektrikal-Generator';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '204-Elektrikal-Kelistrikan Mesin';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '205-Elektrikal-Lampu';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '301-Kemudi dan Suspensi-As Roda';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '302-Kemudi dan Suspensi-Ban';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '303-Kemudi dan Suspensi-Baut Roda';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '304-Kemudi dan Suspensi-Bearing Roda';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '305-Kemudi dan Suspensi-Pedal';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '306-Kemudi dan Suspensi-Penggerak';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '307-Kemudi dan Suspensi-Power Stering';
        $interference->save();
        
        $interference = new Interference;
        $interference->nama = '308-Kemudi dan Suspensi-Rem';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '309-Kemudi dan Suspensi-Sistem ABS';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '310-Kemudi dan Suspensi-Stabilizer';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '311-Kemudi dan Suspensi-Suspensi';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '312-Kemudi dan Suspensi-Velg';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '401-Transmisi-Master Kopling';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '401-Transmisi-Master Kopling';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '402-Transmisi-Perseneling';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '501-Mesin-Filter Oli';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '502-Mesin-filter Solar';
        $interference->save();
        
        $interference = new Interference;
        $interference->nama = '503-Mesin-Injeksi';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '504-Mesin-Pompa Solar/Bensin';
        $interference->save();
        
        $interference = new Interference;
        $interference->nama = '505-Mesin-Radiator';
        $interference->save();

        $interference = new Interference;
        $interference->nama = '506-Mesin-Tangki-BBM';
        $interference->save();

    }
}
