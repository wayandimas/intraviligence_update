<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->nama = '801';
        $user->password = Hash::make('delapan0satu');
        $user->operasional_id = 1;
        $user->save();

        $user = new User;
        $user->nama = '802';
        $user->password = Hash::make('delapan0dua');
        $user->operasional_id = 1;
        $user->save();

        $user = new User;
        $user->nama = '803';
        $user->password = Hash::make('delapan0tiga');
        $user->operasional_id = 1;
        $user->save();

        $user = new User;
        $user->nama = 'Derek';
        $user->password = Hash::make('derek123');
        $user->operasional_id = 2;
        $user->save();

        
        $user = new User;
        $user->nama = 'Rescue';
        $user->password = Hash::make('rescue123');
        $user->operasional_id = 3;
        $user->save();

        
        $user = new User;
        $user->nama = 'Ambulans';
        $user->password = Hash::make('ambulans123');
        $user->operasional_id = 4;
        $user->save();

        
        $user = new User;
        $user->nama = 'Gerbang Tol Cambaya';
        $user->password = Hash::make('cambaya123');
        $user->operasional_id = 5;
        $user->save();


        
        $user = new User;
        $user->nama = 'Gerbang Tol Kaluku Badoa';
        $user->password = Hash::make('kalukubadoa123');
        $user->operasional_id = 5;
        $user->save();

        
        $user = new User;
        $user->nama = 'Gerbang Tol Tallo Timur';
        $user->password = Hash::make('tallotimur123');
        $user->operasional_id = 5;
        $user->save();

        
        $user = new User;
        $user->nama = 'Gerbang Tol Tallo Barat';
        $user->password = Hash::make('tallobarat123');
        $user->operasional_id = 5;
        $user->save();

        
        $user = new User;
        $user->nama = 'Gerbang Tol Tamalanrea';
        $user->password = Hash::make('tamalanrea123');
        $user->operasional_id = 5;
        $user->save();

        $user = new User;
        $user->nama = 'Gerbang Tol Parangloe';
        $user->password = Hash::make('parangloe123');
        $user->operasional_id = 5;
        $user->save();

        $user = new User;
        $user->nama = 'Gerbang Tol Bira Timur';
        $user->password = Hash::make('biratimur123');
        $user->operasional_id = 5;
        $user->save();

        $user = new User;
        $user->nama = 'Gerbang Tol Bira Barat';
        $user->password = Hash::make('birabarat123');
        $user->operasional_id = 5;
        $user->save();

        $user = new User;
        $user->nama = 'Gerbang Tol Biringkanaya';
        $user->password = Hash::make('biringkanaya123');
        $user->operasional_id = 5;
        $user->save();

        $user = new User;
        $user->nama = 'Admin';
        $user->password = Hash::make('admin12tiga');
        $user->operasional_id = 10;
        $user->save();

        $user = new User;
        $user->nama = 'Koordinator Pelayanan Jalan Tol';
        $user->password = Hash::make('pelayanan123');
        $user->operasional_id = 7;
        $user->save();

        $user = new User;
        $user->nama = 'Koordinator ERT';
        $user->password = Hash::make('ert123');
        $user->operasional_id = 8;
        $user->save();

        $user = new User;
        $user->nama = 'Koordinator Security';
        $user->password = Hash::make('security123');
        $user->operasional_id = 9;
        $user->save();

        $user = new User;
        $user->nama = 'Senkom';
        $user->password = Hash::make('senkom123');
        $user->operasional_id = 11;
        $user->save();

        $user = new User;
        $user->nama = 'Intravilligence';
        $user->password = Hash::make('intravilligence123');
        $user->operasional_id = 12;
        $user->save();

        $user = new User;
        $user->nama = 'Super Admin';
        $user->password = Hash::make('superadmin123');
        $user->operasional_id = 13;
        $user->save();

        $user = new User;
        $user->nama = 'Garuda';
        $user->password = Hash::make('garuda123');
        $user->operasional_id = 10;
        $user->save();

        
        
    }
     protected $hidden = [
        'password',
        'created_at',
        'updated_at',
    ];
}
