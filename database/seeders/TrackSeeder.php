<?php

namespace Database\Seeders;

use App\Models\Track;
use Illuminate\Database\Seeder;

class TrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $track = new Track;
       $track->nama = 'A';
       $track->save();
       
       $track = new Track;
       $track->nama = 'B';
       $track->save();
    }
}
