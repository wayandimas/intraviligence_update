<?php

namespace Database\Seeders;

use App\Models\TypeActivity;
use Illuminate\Database\Seeder;

class TypeActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activity = new TypeActivity();
        $activity->nama = 'Pemantauan Aset Tol';
        $activity->save();

        $activity = new TypeActivity();
        $activity->nama = 'Pemantauan Kamtibmas Lainnya';
        $activity->save();

        $activity = new TypeActivity();
        $activity->nama = 'Pemantauan Kegiatan Wilayah Tol';
        $activity->save();

        $activity = new TypeActivity();
        $activity->nama = 'Pengamanan Benda Asing';
        $activity->save();

        $activity = new TypeActivity();
        $activity->nama = 'Pengamanan Hewan ';
        $activity->save();

        $activity = new TypeActivity();
        $activity->nama = 'Pengamanan Orang Gangguan Jiwa';
        $activity->save();

        $activity = new TypeActivity();
        $activity->nama = 'Pengamanan Tawura';
        $activity->save();

        $activity = new TypeActivity();
        $activity->nama = 'Pengamanan Kendaraan Roda Dua';
        $activity->save();

        $activity = new TypeActivity();
        $activity->nama = 'Penyuluhan Kendaraan Roda Dua';
        $activity->save();

        $activity = new TypeActivity();
        $activity->nama = 'Pemantauan Pengantar Jenazah';
        $activity->save();

        $activity = new TypeActivity();
        $activity->nama = 'Pemantauan Kendaraan Indikasi Overload Overdimensi';
        $activity->save();

        $activity = new TypeActivity();
        $activity->nama = 'Pengaturan Perjalanan VIP';
        $activity->save();

        $activity = new TypeActivity();
        $activity->nama = 'Kendaraan Melawan Arah di Off Ramp';
        $activity->save();


        $activity = new TypeActivity();
        $activity->nama = 'Kendaraan Melawan Arah di On Ramp';
        $activity->save();

        $activity = new TypeActivity();
        $activity->nama = 'Kendaraan Menarik';
        $activity->save();

        $activity = new TypeActivity();
        $activity->nama = 'Pemantauan Arus Lalu Lintas';
        $activity->save();

        $activity = new TypeActivity();
        $activity->nama = 'Penyebrang Jalan dan Penunggu Kendaraan';
        $activity->save();

        $activity = new TypeActivity();
        $activity->nama = 'Pemantauan Kegiatan Unjuk Rasa';
        $activity->save();

        $activity = new TypeActivity();
        $activity->nama = 'Kegiatan Perbaikan Peralatan IT';
        $activity->save();

        $activity = new TypeActivity();
        $activity->nama = 'Kegiatan Perbaikan Peralatan Gerbang Tol';
        $activity->save();

        $activity = new TypeActivity();
        $activity->nama = 'Kegiatan Pemiliharaan Jalan';
        $activity->save();

    }
}
