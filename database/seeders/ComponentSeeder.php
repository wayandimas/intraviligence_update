<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Component;
class ComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $component = new Component;
        $component->nama = 'Ban Kanan Depan';
        $component->categori_id = 1;
        $component->alias = 'bkad';
        $component->save();

        $component = new Component;
        $component->nama = 'Ban Kanan Belakang';
        $component->categori_id = 1;
        $component->alias = 'bkab';
        $component->save();

        $component = new Component;
        $component->nama = 'Ban Kiri Depan';
        $component->categori_id = 1;
        $component->alias = 'bkid';
        $component->save();

        $component = new Component;
        $component->nama = 'Ban Kiri Belakang';
        $component->categori_id = 1;
        $component->alias = 'bkib';
        $component->save();

        $component = new Component;
        $component->nama = 'Ban Serep';
        $component->categori_id = 1;
        $component->alias = 'bs';
        $component->save();

        $component = new Component;
        $component->nama = 'Velg Roda & Drop';
        $component->categori_id = 1;
        $component->alias = 'vrd';
        $component->save();
        
        $component = new Component;
        $component->nama = 'Keterangan Bagian Roda dan Ban';
        $component->categori_id = 1;
        $component->alias = 'kbrdb';
        $component->save();

        $component = new Component;
        $component->nama = 'Ban Kanan Depan';
        $component->categori_id = 7;
        $component->alias = 'bkad';
        $component->save();

        $component = new Component;
        $component->nama = 'Ban Kanan Belakang';
        $component->categori_id = 7;
        $component->alias = 'bkab';
        $component->save();

        $component = new Component;
        $component->nama = 'Ban Kiri Depan';
        $component->categori_id = 7;
        $component->alias = 'bkid';
        $component->save();

        $component = new Component;
        $component->nama = 'Ban Kiri Belakang';
        $component->categori_id = 7;
        $component->alias = 'bkib';
        $component->save();

        $component = new Component;
        $component->nama = 'Ban Serep';
        $component->categori_id = 7;
        $component->alias = 'bs';
        $component->save();

        $component = new Component;
        $component->nama = 'Velg Roda & Drop';
        $component->categori_id = 7;
        $component->alias = 'vrd';
        $component->save();
        
        $component = new Component;
        $component->nama = 'Keterangan Bagian Roda dan Ban';
        $component->categori_id = 7;
        $component->alias = 'kbrdb';
        $component->save();

        $component = new Component;
        $component->nama = 'STNK';
        $component->categori_id = 2;
        $component->alias = 'stnk';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Dashboard';
        $component->categori_id = 2;
        $component->alias = 'ldb';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Depan';
        $component->categori_id = 2;
        $component->alias = 'ldp';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Belakang';
        $component->categori_id = 2;
        $component->alias = 'lbg';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Rem';
        $component->categori_id = 2;
        $component->alias = 'lr';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Sein';
        $component->categori_id = 2;
        $component->alias = 'lsn';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Mundur';
        $component->categori_id = 2;
        $component->alias = 'lm';
        $component->save();

        $component = new Component;
        $component->nama = 'Radio/Tape';
        $component->categori_id = 2;
        $component->alias = 'rt';
        $component->save();

        $component = new Component;
        $component->nama = 'Air Conditioner';
        $component->categori_id = 2;
        $component->alias = 'ac';
        $component->save();

        $component = new Component;
        $component->nama = 'Sandaran Kepala';
        $component->categori_id = 2;
        $component->alias = 'sk';
        $component->save();

        $component = new Component;
        $component->nama = 'Karpet';
        $component->categori_id = 2;
        $component->alias = 'kp';
        $component->save();

        $component = new Component;
        $component->nama = 'Sarung Jok';
        $component->categori_id = 2;
        $component->alias = 'sj';
        $component->save();

        $component = new Component;
        $component->nama = 'Klakson';
        $component->categori_id = 2;
        $component->alias = 'kl';
        $component->save();

        $component = new Component;
        $component->nama = 'Wiper';
        $component->categori_id = 2;
        $component->alias = 'wp';
        $component->save();

        $component = new Component;
        $component->nama = 'Speaker';
        $component->categori_id = 2;
        $component->alias = 'spr';
        $component->save();

        $component = new Component;
        $component->nama = 'Power Window';
        $component->categori_id = 2;
        $component->alias = 'pw';
        $component->save();

        $component = new Component;
        $component->nama = 'Seat Belt';
        $component->categori_id = 2;
        $component->alias = 'sb';
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Bagian Dalam';
        $component->categori_id = 2;
        $component->alias = 'kbd';
        $component->save();

        $component = new Component;
        $component->nama = 'STNK';
        $component->categori_id = 8;
        $component->alias = 'stnk';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Dashboard';
        $component->categori_id = 8;
        $component->alias = 'ldb';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Depan';
        $component->categori_id = 8;
        $component->alias = 'ldp';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Belakang';
        $component->categori_id = 8;
        $component->alias = 'lbg';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Rem';
        $component->categori_id = 8;
        $component->alias = 'lr';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Sein';
        $component->categori_id = 8;
        $component->alias = 'lsn';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Mundur';
        $component->categori_id = 8;
        $component->alias = 'lm';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Kabut';
        $component->categori_id = 8;
        $component->alias = 'lk';
        $component->save();

        $component = new Component;
        $component->nama = 'Radio/Tape';
        $component->categori_id = 8;
        $component->alias = 'rt';
        $component->save();

        $component = new Component;
        $component->nama = 'Klakson';
        $component->categori_id = 8;
        $component->alias = 'kl';
        $component->save();

        $component = new Component;
        $component->nama = 'Wiper';
        $component->categori_id = 8;
        $component->alias = 'wp';
        $component->save();

        $component = new Component;
        $component->nama = 'Speaker';
        $component->categori_id = 8;
        $component->alias = 'spr';
        $component->save();

        $component = new Component;
        $component->nama = 'Seat Belt';
        $component->categori_id = 8;
        $component->alias = 'sb';
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Bagian Dalam';
        $component->categori_id = 8;
        $component->alias = 'kbd';
        $component->save();

        $component = new Component;
        $component->nama = 'Kunci Roda';
        $component->categori_id = 3;
        $component->alias = 'kr';
        $component->save();

        $component = new Component;
        $component->nama = 'Dongkrak';
        $component->categori_id = 3;
        $component->alias = 'dr';
        $component->save();
        
        $component = new Component;
        $component->nama = 'P3K';
        $component->categori_id = 3;
        $component->alias = 'p3k';
        $component->save();
        
        $component = new Component;
        $component->nama = 'Keterangan Peralatan';
        $component->categori_id = 3;
        $component->alias = 'kpr';
        $component->save();

        $component = new Component;
        $component->nama = 'Dongrak Hidrolik 20 Ton';
        $component->categori_id = 9;
        $component->alias = 'dh';
        $component->save();

        $component = new Component;
        $component->nama = 'Tangki Oli Hidrolik';
        $component->categori_id = 9;
        $component->alias = 'toh';
        $component->save();
        
        $component = new Component;
        $component->nama = 'Winch Warm 5 Ton';
        $component->categori_id = 9;
        $component->alias = 'ww';
        $component->save();

        $component = new Component;
        $component->nama = 'Kait Hook';
        $component->categori_id = 9;
        $component->alias = 'kh';
        $component->save();

        $component = new Component;
        $component->nama = 'Kunci Roda';
        $component->categori_id = 9;
        $component->alias = 'kr';
        $component->save();

        $component = new Component;
        $component->nama = 'Dongkrak Buaya';
        $component->categori_id = 9;
        $component->alias = 'db';
        $component->save();

        $component = new Component;
        $component->nama = 'P3K';
        $component->categori_id = 9;
        $component->alias = 'p3k';
        $component->save();

        $component = new Component;
        $component->nama = 'Sarung Tangan';
        $component->categori_id = 9;
        $component->alias = 'st';
        $component->save();

        $component = new Component;
        $component->nama = 'Helm';
        $component->categori_id = 9;
        $component->alias = 'hm';
        $component->save();

        $component = new Component;
        $component->nama = 'Jas Hujan';
        $component->categori_id = 9;
        $component->alias = 'jh';
        $component->save();
        
        $component = new Component;
        $component->nama = 'Keterangan Peralatan';
        $component->categori_id = 9;
        $component->alias = 'kpr';
        $component->save();

        $component = new Component;
        $component->nama = 'Public Address';
        $component->categori_id = 4;
        $component->alias = 'pa';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Strobo (Rotary)';
        $component->categori_id = 4;
        $component->alias = 'lsb';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Sorot';
        $component->categori_id = 4;
        $component->alias = 'lpsr';
        $component->save();

        $component = new Component;
        $component->nama = 'APAR';
        $component->categori_id = 4;
        $component->alias = 'apar';
        $component->save();

        $component = new Component;
        $component->nama = 'Rubber Cone';
        $component->categori_id = 4;
        $component->alias = 'rc';
        $component->save();

        $component = new Component;
        $component->nama = 'Rambu Tanda Seru';
        $component->categori_id = 4;
        $component->alias = 'rts';
        $component->save();

        $component = new Component;
        $component->nama = 'Rambu Petunjuk Arah';
        $component->categori_id = 4;
        $component->alias = 'rpa';
        $component->save();

        $component = new Component;
        $component->nama = 'Flag (Bendera)';
        $component->categori_id = 4;
        $component->alias = 'flg';
        $component->save();

        $component = new Component;
        $component->nama = 'Oil Absorbent';
        $component->categori_id = 4;
        $component->alias = 'oat';
        $component->save();

        $component = new Component;
        $component->nama = 'Senter Charger';
        $component->categori_id = 4;
        $component->alias = 'scr';
        $component->save();

        $component = new Component;
        $component->nama = 'Sepatu Boat';
        $component->categori_id = 4;
        $component->alias = 'sbt';
        $component->save();

        $component = new Component;
        $component->nama = 'Jas Hujan';
        $component->categori_id = 4;
        $component->alias = 'jhn';
        $component->save();

        $component = new Component;
        $component->nama = 'Senter Lalin';
        $component->categori_id = 4;
        $component->alias = 'sln';
        $component->save();

        $component = new Component;
        $component->nama = 'Safety Glasses';
        $component->categori_id = 4;
        $component->alias = 'sgls';
        $component->save();

        $component = new Component;
        $component->nama = 'Helm';
        $component->categori_id = 4;
        $component->alias = 'hlm';
        $component->save();

        $component = new Component;
        $component->nama = 'Safety Gloves';
        $component->categori_id = 4;
        $component->alias = 'sgvs';
        $component->save();

        $component = new Component;
        $component->nama = 'Sekop';
        $component->categori_id = 4;
        $component->alias = 'skp';
        $component->save();

        $component = new Component;
        $component->nama = 'Sapu Lidi';
        $component->categori_id = 4;
        $component->alias = 'sli';
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Peralatan Tambahan';
        $component->categori_id = 4;
        $component->alias = 'kpt';
        $component->save();

        $component = new Component;
        $component->nama = 'Public Address';
        $component->categori_id = 10;
        $component->alias = 'pa';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu (Rotary)';
        $component->categori_id = 10;
        $component->alias = 'lsb';
        $component->save();

        $component = new Component;
        $component->nama = 'Webbing Sling';
        $component->categori_id = 10;
        $component->alias = 'ws';
        $component->save();

        $component = new Component;
        $component->nama = 'Parking Shock';
        $component->categori_id = 10;
        $component->alias = 'ps';
        $component->save();

        $component = new Component;
        $component->nama = 'Segel';
        $component->categori_id = 10;
        $component->alias = 'sl';
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Peralatan Tambahan';
        $component->categori_id = 10;
        $component->alias = 'kpt';
        $component->save();

        $component = new Component;
        $component->nama = 'Engine Condition';
        $component->categori_id = 5;
        $component->alias = 'ec';
        $component->save();
        
        $component = new Component;
        $component->nama = 'Air Accu';
        $component->categori_id = 5;
        $component->alias = 'acu';
        $component->save();

        $component = new Component;
        $component->nama = 'Air Radiator';
        $component->categori_id = 5;
        $component->alias = 'arr';
        $component->save();

        $component = new Component;
        $component->nama = 'Oli Mesin';
        $component->categori_id = 5;
        $component->alias = 'omn';
        $component->save();

        $component = new Component;
        $component->nama = 'Minyak Rem';
        $component->categori_id = 5;
        $component->alias = 'mr';
        $component->save();

        $component = new Component;
        $component->nama = 'Oil Power Steering';
        $component->categori_id = 5;
        $component->alias = 'ops';
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Engine';
        $component->categori_id = 5;
        $component->alias = 'keeng';
        $component->save();
    
        $component = new Component;
        $component->nama = 'Engine Condition';
        $component->categori_id = 11;
        $component->alias = 'ec';
        $component->save();
    
        $component = new Component;
        $component->nama = 'Running Test';
        $component->categori_id = 11;
        $component->alias = 'rtt';
        $component->save();
        
        $component = new Component;
        $component->nama = 'Air Radiator';
        $component->categori_id = 11;
        $component->alias = 'arr';
        $component->save();

        $component = new Component;
        $component->nama = 'Air Accu';
        $component->categori_id = 11;
        $component->alias = 'acu';
        $component->save();

        $component = new Component;
        $component->nama = 'Oli Mesin';
        $component->categori_id = 11;
        $component->alias = 'omn';
        $component->save();

        $component = new Component;
        $component->nama = 'Minyak Rem';
        $component->categori_id = 11;
        $component->alias = 'mr';
        $component->save();

        $component = new Component;
        $component->nama = 'APAR';
        $component->categori_id = 11;
        $component->alias = 'apr';
        $component->save();

        $component = new Component;
        $component->nama = 'Oil Power Steering';
        $component->categori_id = 11;
        $component->alias = 'ops';
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Engine';
        $component->categori_id = 11;
        $component->alias = 'keeng';
        $component->save();
    
        $component = new Component;
        $component->nama = 'Samping Kiri';
        $component->categori_id = 6;
        $component->alias = 'ski';
        $component->save();

        $component = new Component;
        $component->nama = 'Samping Kanan';
        $component->categori_id = 6;
        $component->alias = 'ska';
        $component->save();

        $component = new Component;
        $component->nama = 'Depan';
        $component->categori_id = 6;
        $component->alias = 'dpn';
        $component->save();

        $component = new Component;
        $component->nama = 'Belakang';
        $component->categori_id = 6;
        $component->alias = 'blg';
        $component->save();

        $component = new Component;
        $component->nama = 'Atas';
        $component->alias = 'ats';
        $component->categori_id = 6;
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Body dan Cat';
        $component->alias = 'kbdc';
        $component->categori_id = 6;
        $component->save();
       
        $component = new Component;
        $component->nama = 'Samping Kiri';
        $component->categori_id = 12;
        $component->alias = 'ski';
        $component->save();

        $component = new Component;
        $component->nama = 'Samping Kanan';
        $component->categori_id = 12;
        $component->alias = 'ska';
        $component->save();

        $component = new Component;
        $component->nama = 'Depan';
        $component->categori_id = 12;
        $component->alias = 'dpn';
        $component->save();

        $component = new Component;
        $component->nama = 'Belakang';
        $component->categori_id = 12;
        $component->alias = 'blg';
        $component->save();

        $component = new Component;
        $component->nama = 'Atas';
        $component->alias = 'ats';
        $component->categori_id = 12;
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Body dan Cat';
        $component->alias = 'kbdc';
        $component->categori_id = 12;
        $component->save();
       
        $component = new Component;
        $component->nama = 'Ban Kanan Depan';
        $component->categori_id = 19;
        $component->alias = 'bkad';
        $component->save();

        $component = new Component;
        $component->nama = 'Ban Kanan Belakang';
        $component->categori_id = 19;
        $component->alias = 'bkab';
        $component->save();

        $component = new Component;
        $component->nama = 'Ban Kiri Depan';
        $component->categori_id = 19;
        $component->alias = 'bkid';
        $component->save();

        $component = new Component;
        $component->nama = 'Ban Kiri Belakang';
        $component->categori_id = 19;
        $component->alias = 'bkib';
        $component->save();

        $component = new Component;
        $component->nama = 'Ban Serep';
        $component->categori_id = 19;
        $component->alias = 'bs';
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Bagian Roda dan Ban';
        $component->categori_id = 19;
        $component->alias = 'kbrdb';
        $component->save();
         
        $component = new Component;
        $component->nama = 'STNK';
        $component->categori_id = 20;
        $component->alias = 'stnk';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Dashboard';
        $component->categori_id = 20;
        $component->alias = 'ldb';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Depan';
        $component->categori_id = 20;
        $component->alias = 'ldp';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Belakang';
        $component->categori_id = 20;
        $component->alias = 'lbg';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Rem';
        $component->categori_id = 20;
        $component->alias = 'lr';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Sein';
        $component->categori_id = 20;
        $component->alias = 'lsn';
        $component->save();


        $component = new Component;
        $component->nama = 'Lampu Mundur';
        $component->categori_id = 20;
        $component->alias = 'lm';
        $component->save();

        $component = new Component;
        $component->nama = 'Air Conditioner';
        $component->categori_id = 20;
        $component->alias = 'ac';
        $component->save();

        $component = new Component;
        $component->nama = 'Klakson';
        $component->categori_id = 20;
        $component->alias = 'kl';
        $component->save();

        $component = new Component;
        $component->nama = 'Wiper';
        $component->categori_id = 20;
        $component->alias = 'wp';
        $component->save();

        $component = new Component;
        $component->nama = 'Seat Belt';
        $component->categori_id = 20;
        $component->alias = 'sb';
        $component->save();
        
        $component = new Component;
        $component->nama = 'Handle Kaca Pintu';
        $component->categori_id = 20;
        $component->alias = 'hkp';
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Bagian Dalam';
        $component->categori_id = 20;
        $component->alias = 'kbd';
        $component->save();

        $component = new Component;
        $component->nama = 'Kunci Roda';
        $component->categori_id = 21;
        $component->alias = 'kr';
        $component->save();

        $component = new Component;
        $component->nama = 'Dongkrak';
        $component->categori_id = 21;
        $component->alias = 'dr';
        $component->save();
        
        $component = new Component;
        $component->nama = 'P3K';
        $component->categori_id = 21;
        $component->alias = 'p3k';
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Peralatan';
        $component->categori_id = 21;
        $component->alias = 'kpr';
        $component->save();

        $component = new Component;
        $component->nama = 'Public Address';
        $component->categori_id = 22;
        $component->alias = 'pa';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Strobo (Rotary)';
        $component->categori_id = 22;
        $component->alias = 'lsb';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Sorot';
        $component->categori_id = 22;
        $component->alias = 'lpsr';
        $component->save();

        $component = new Component;
        $component->nama = 'APAR';
        $component->categori_id = 22;
        $component->alias = 'apar';
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Peralatan Tambahan';
        $component->categori_id = 22;
        $component->alias = 'kpt';
        $component->save();

        $component = new Component;
        $component->nama = 'Engine Condition';
        $component->categori_id = 23;
        $component->alias = 'ec';
        $component->save();
        
        $component = new Component;
        $component->nama = 'Running Tes';
        $component->categori_id = 23;
        $component->alias = 'rnts';
        $component->save();

        $component = new Component;
        $component->nama = 'Air Radiator';
        $component->categori_id = 23;
        $component->alias = 'arr';
        $component->save();

        $component = new Component;
        $component->nama = 'Oli';
        $component->categori_id = 23;
        $component->alias = 'ol';
        $component->save();

        $component = new Component;
        $component->nama = 'Minyak Rem';
        $component->categori_id = 23;
        $component->alias = 'mr';
        $component->save();

        $component = new Component;
        $component->nama = 'Oil Power Steering';
        $component->categori_id = 23;
        $component->alias = 'ops';
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Engine';
        $component->categori_id = 23;
        $component->alias = 'keeng';
        $component->save();

        $component = new Component;
        $component->nama = 'Samping Kiri';
        $component->categori_id = 24;
        $component->alias = 'ski';
        $component->save();

        $component = new Component;
        $component->nama = 'Samping Kanan';
        $component->categori_id = 24;
        $component->alias = 'ska';
        $component->save();

        $component = new Component;
        $component->nama = 'Depan';
        $component->categori_id = 24;
        $component->alias = 'dpn';
        $component->save();

        $component = new Component;
        $component->nama = 'Belakang';
        $component->categori_id = 24;
        $component->alias = 'blg';
        $component->save();

        $component = new Component;
        $component->nama = 'Atas';
        $component->alias = 'ats';
        $component->categori_id = 24;
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Body dan Cat';
        $component->alias = 'kbdc';
        $component->categori_id = 24;
        $component->save();
       
        $component = new Component;
        $component->nama = 'Cairan NaCl';
        $component->alias = 'cn';
        $component->categori_id = 25;
        $component->save();

        $component = new Component;
        $component->nama = 'Nirbekken';
        $component->alias = 'nbn';
        $component->categori_id = 25;
        $component->save();

        $component = new Component;
        $component->nama = 'Pinset Anatomi';
        $component->alias = 'piai';
        $component->categori_id = 25;
        $component->save();

        $component = new Component;
        $component->nama = 'Sunction Manual';
        $component->alias = 'sm';
        $component->categori_id = 25;
        $component->save();

        $component = new Component;
        $component->nama = 'Tabung O2';
        $component->alias = 'to2';
        $component->categori_id = 25;
        $component->save();

        $component = new Component;
        $component->nama = 'Tandu Skop';
        $component->alias = 'ts';
        $component->categori_id = 25;
        $component->save();

        $component = new Component;
        $component->nama = 'Brangkar';
        $component->alias = 'br';
        $component->categori_id = 25;
        $component->save();

        $component = new Component;
        $component->nama = 'Kantong Mayat';
        $component->alias = 'km';
        $component->categori_id = 25;
        $component->save();

        $component = new Component;
        $component->nama = 'Betadine';
        $component->alias = 'bte';
        $component->categori_id = 25;
        $component->save();

        $component = new Component;
        $component->nama = 'Alcohol';
        $component->alias = 'acl';
        $component->categori_id = 25;
        $component->save();

        $component = new Component;
        $component->nama = 'Kasa Steril';
        $component->alias = 'ks';
        $component->categori_id = 25;
        $component->save();

        $component = new Component;
        $component->nama = 'Perban Elastis';
        $component->alias = 'pe';
        $component->categori_id = 25;
        $component->save();

        $component = new Component;
        $component->nama = 'Kapas';
        $component->alias = 'kps';
        $component->categori_id = 25;
        $component->save();

        $component = new Component;
        $component->nama = 'Handskun';
        $component->alias = 'hdsn';
        $component->categori_id = 25;
        $component->save();

        $component = new Component;
        $component->nama = 'Selang O2';
        $component->alias = 'so2';
        $component->categori_id = 25;
        $component->save();

        $component = new Component;
        $component->nama = 'Extrication Collar';
        $component->alias = 'ecr';
        $component->categori_id = 25;
        $component->save();

        $component = new Component;
        $component->nama = 'Bidai Tiup';
        $component->alias = 'bt';
        $component->categori_id = 25;
        $component->save();

        $component = new Component;
        $component->nama = 'Masker';
        $component->alias = 'mrr';
        $component->categori_id = 25;
        $component->save();

        $component = new Component;
        $component->nama = 'Gunting';
        $component->alias = 'gg';
        $component->categori_id = 25;
        $component->save();

        $component = new Component;
        $component->nama = 'Plester';
        $component->alias = 'pr';
        $component->categori_id = 25;
        $component->save();
        
        $component = new Component;
        $component->nama = 'Ambu Bag Masker';
        $component->alias = 'abm';
        $component->categori_id = 25;
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Peralatan Medis';
        $component->alias = 'kpm';
        $component->categori_id = 25;
        $component->save();

        $component = new Component;
        $component->nama = 'Alat Sterilisator';
        $component->alias = 'asr';
        $component->categori_id = 26;
        $component->save();

        $component = new Component;
        $component->nama = 'Tempat Tidur Pasien';
        $component->alias = 'ttp';
        $component->categori_id = 26;
        $component->save();

        $component = new Component;
        $component->nama = 'Kantong Mayat';
        $component->alias = 'kmm';
        $component->categori_id = 26;
        $component->save();

        $component = new Component;
        $component->nama = 'Tensi Meter';
        $component->alias = 'tm';
        $component->categori_id = 26;
        $component->save();

        $component = new Component;
        $component->nama = 'Stetescop';
        $component->alias = 'sp';
        $component->categori_id = 26;
        $component->save();

        $component = new Component;
        $component->nama = 'Kotak P3K';
        $component->alias = 'kp3k';
        $component->categori_id = 26;
        $component->save();

        $component = new Component;
        $component->nama = 'Gunting Plester';
        $component->alias = 'gp';
        $component->categori_id = 26;
        $component->save();

        $component = new Component;
        $component->nama = 'Clem (Gunting Jipit)';
        $component->alias = 'gj';
        $component->categori_id = 26;
        $component->save();
        
        $component = new Component;
        $component->nama = 'Kasa Steril';
        $component->alias = 'ksm';
        $component->categori_id = 26;
        $component->save();

        $component = new Component;
        $component->nama = 'Kasa Gulung';
        $component->alias = 'kg';
        $component->categori_id = 26;
        $component->save();

        $component = new Component;
        $component->nama = 'Cairan NaCl';
        $component->alias = 'cnm';
        $component->categori_id = 26;
        $component->save();

        $component = new Component;
        $component->nama = 'Kapas';
        $component->alias = 'kpsm';
        $component->categori_id = 26;
        $component->save();

        $component = new Component;
        $component->nama = 'Hipafix';
        $component->alias = 'hx';
        $component->categori_id = 26;
        $component->save();

        $component = new Component;
        $component->nama = 'Tabung O2';
        $component->alias = 'to2m';
        $component->categori_id = 26;
        $component->save();

        $component = new Component;
        $component->nama = 'Betadine';
        $component->alias = 'btem';
        $component->categori_id = 26;
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Ruang Medis';
        $component->alias = 'krm';
        $component->categori_id = 26;
        $component->save();


        $component = new Component;
        $component->nama = 'Ban Kanan Depan';
        $component->categori_id = 27;
        $component->alias = 'bkaddb';
        $component->save();

        $component = new Component;
        $component->nama = 'Ban Kanan Belakang';
        $component->categori_id = 27;
        $component->alias = 'bkabdb';
        $component->save();

        $component = new Component;
        $component->nama = 'Ban Kiri Depan';
        $component->categori_id = 27;
        $component->alias = 'bkiddb';
        $component->save();

        $component = new Component;
        $component->nama = 'Ban Kiri Belakang';
        $component->categori_id = 27;
        $component->alias = 'bkibdb';
        $component->save();

        $component = new Component;
        $component->nama = 'Ban Serep';
        $component->categori_id = 27;
        $component->alias = 'bsdb';
        $component->save();
        
        $component = new Component;
        $component->nama = 'Keterangan Bagian Roda dan Ban';
        $component->categori_id = 27;
        $component->alias = 'kbrdbdb';
        $component->save();

        $component = new Component;
        $component->nama = 'STNK';
        $component->categori_id = 28;
        $component->alias = 'stnkdb';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Dashboard';
        $component->categori_id = 28;
        $component->alias = 'ldbdb';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Depan';
        $component->categori_id = 28;
        $component->alias = 'ldpdb';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Belakang';
        $component->categori_id = 28;
        $component->alias = 'lbgdb';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Rem';
        $component->categori_id = 28;
        $component->alias = 'lrdb';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Sein';
        $component->categori_id = 28;
        $component->alias = 'lsndb';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Mundur';
        $component->categori_id = 28;
        $component->alias = 'lmdb';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Kabut';
        $component->categori_id = 28;
        $component->alias = 'lktdb';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Strobo/LED(Rotary)';
        $component->categori_id = 28;
        $component->alias = 'lsbdb';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Sorot';
        $component->categori_id = 28;
        $component->alias = 'lpsrdb';
        $component->save();

        $component = new Component;
        $component->nama = 'Air Conditioner';
        $component->categori_id = 28;
        $component->alias = 'acdb';
        $component->save();

        $component = new Component;
        $component->nama = 'Klakson';
        $component->categori_id = 28;
        $component->alias = 'kldb';
        $component->save();

        $component = new Component;
        $component->nama = 'Wiper';
        $component->categori_id = 28;
        $component->alias = 'wpdb';
        $component->save();

        $component = new Component;
        $component->nama = 'Seat Belt';
        $component->categori_id = 28;
        $component->alias = 'sbdb';
        $component->save();

        $component = new Component;
        $component->nama = 'APAR';
        $component->categori_id = 28;
        $component->alias = 'apardb';
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Bagian Dalam';
        $component->categori_id = 28;
        $component->alias = 'kbddb';
        $component->save();

        $component = new Component;
        $component->nama = 'Balok';
        $component->categori_id = 29;
        $component->alias = 'blk';
        $component->save();
        
        $component = new Component;
        $component->nama = 'P3K';
        $component->categori_id = 29;
        $component->alias = 'p3kdb';
        $component->save();

        $component = new Component;
        $component->nama = 'Katrol';
        $component->categori_id = 29;
        $component->alias = 'ktrl';
        $component->save();

        $component = new Component;
        $component->nama = 'Dongkrak Hidrolik 20 Ton';
        $component->categori_id = 29;
        $component->alias = 'dht';
        $component->save();

        $component = new Component;
        $component->nama = 'Kunci Shock';
        $component->categori_id = 29;
        $component->alias = 'ks';
        $component->save();

        $component = new Component;
        $component->nama = 'Kunci Moment';
        $component->categori_id = 29;
        $component->alias = 'km';
        $component->save();

        $component = new Component;
        $component->nama = 'Kunci Pipa';
        $component->categori_id = 29;
        $component->alias = 'kp';
        $component->save();
        
        $component = new Component;
        $component->nama = 'Rantai 1/2" 2X10 M';
        $component->categori_id = 29;
        $component->alias = 'rnt';
        $component->save();

        $component = new Component;
        $component->nama = 'Tali Sling';
        $component->categori_id = 29;
        $component->alias = 'tsg';
        $component->save();

        $component = new Component;
        $component->nama = 'Rantai Besi';
        $component->categori_id = 29;
        $component->alias = 'rbs';
        $component->save();

        $component = new Component;
        $component->nama = 'Segel';
        $component->categori_id = 29;
        $component->alias = 'sgl';
        $component->save();

        $component = new Component;
        $component->nama = 'Selang Kompor';
        $component->categori_id = 29;
        $component->alias = 'skr';
        $component->save();

        $component = new Component;
        $component->nama = 'Helm';
        $component->categori_id = 29;
        $component->alias = 'hmdb';
        $component->save();

        $component = new Component;
        $component->nama = 'Jas Hujan';
        $component->categori_id = 29;
        $component->alias = 'jhdb';
        $component->save();
        
        $component = new Component;
        $component->nama = 'Sarung Tangan';
        $component->categori_id = 29;
        $component->alias = 'stdb';
        $component->save();

        $component = new Component;
        $component->nama = 'Sepatu Boat';
        $component->categori_id = 29;
        $component->alias = 'sbt';
        $component->save();

        $component = new Component;
        $component->nama = 'Senter Charger';
        $component->categori_id = 29;
        $component->alias = 'scr';
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Peralatan';
        $component->categori_id = 29;
        $component->alias = 'kprdb';
        $component->save();

        $component = new Component;
        $component->nama = 'Engine Condition';
        $component->categori_id = 30;
        $component->alias = 'ecdb';
        $component->save();

        $component = new Component;
        $component->nama = 'Running Test';
        $component->categori_id = 30;
        $component->alias = 'rtdb';
        $component->save();

        $component = new Component;
        $component->nama = 'Air Accu';
        $component->categori_id = 30;
        $component->alias = 'acudb';
        $component->save();

        $component = new Component;
        $component->nama = 'Air Radiator';
        $component->categori_id = 30;
        $component->alias = 'arrdb';
        $component->save();

        $component = new Component;
        $component->nama = 'Oli Mesin';
        $component->categori_id = 30;
        $component->alias = 'omndb';
        $component->save();

        $component = new Component;
        $component->nama = 'Minyak Rem';
        $component->categori_id = 30;
        $component->alias = 'mrdb';
        $component->save();

        $component = new Component;
        $component->nama = 'Oil Power Steering';
        $component->categori_id = 30;
        $component->alias = 'opsdb';
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Engine';
        $component->categori_id = 30;
        $component->alias = 'keengdb';
        $component->save();

        $component = new Component;
        $component->nama = 'Samping Kiri';
        $component->categori_id = 31;
        $component->alias = 'skidb';
        $component->save();

        $component = new Component;
        $component->nama = 'Samping Kanan';
        $component->categori_id = 31;
        $component->alias = 'skadb';
        $component->save();

        $component = new Component;
        $component->nama = 'Depan';
        $component->categori_id = 31;
        $component->alias = 'dpndb';
        $component->save();

        $component = new Component;
        $component->nama = 'Belakang';
        $component->categori_id = 31;
        $component->alias = 'blgdb';
        $component->save();

        $component = new Component;
        $component->nama = 'Atas';
        $component->alias = 'atsdb';
        $component->categori_id = 31;
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Body dan Cat';
        $component->alias = 'kbdcdb';
        $component->categori_id = 31;
        $component->save();

        $component = new Component;
        $component->nama = 'Ban Kanan Depan';
        $component->categori_id = 13;
        $component->alias = 'bkad';
        $component->save();

        $component = new Component;
        $component->nama = 'Ban Kanan Belakang';
        $component->categori_id = 13;
        $component->alias = 'bkab';
        $component->save();

        $component = new Component;
        $component->nama = 'Ban Kiri Depan';
        $component->categori_id = 13;
        $component->alias = 'bkid';
        $component->save();

        $component = new Component;
        $component->nama = 'Ban Kiri Belakang';
        $component->categori_id = 13;
        $component->alias = 'bkib';
        $component->save();

        $component = new Component;
        $component->nama = 'Ban Serep';
        $component->categori_id = 13;
        $component->alias = 'bs';
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Bagian Roda dan Ban';
        $component->categori_id = 13;
        $component->alias = 'kbrdb';
        $component->save();

        
        $component = new Component;
        $component->nama = 'STNK';
        $component->categori_id = 14;
        $component->alias = 'stnk';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Depan';
        $component->categori_id = 14;
        $component->alias = 'ldp';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Belakang';
        $component->categori_id = 14;
        $component->alias = 'lbg';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Rem';
        $component->categori_id = 14;
        $component->alias = 'lr';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Sein';
        $component->categori_id = 14;
        $component->alias = 'lsn';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Ruangan';
        $component->categori_id = 14;
        $component->alias = 'lrg';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Mundur';
        $component->categori_id = 14;
        $component->alias = 'lm';
        $component->save();


        $component = new Component;
        $component->nama = 'Klakson';
        $component->categori_id = 14;
        $component->alias = 'kl';
        $component->save();

        $component = new Component;
        $component->nama = 'Air Conditioner';
        $component->categori_id = 14;
        $component->alias = 'ac';
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Bagian Dalam';
        $component->categori_id = 14;
        $component->alias = 'kbd';
        $component->save();

        $component = new Component;
        $component->nama = 'Mobile Power Unit';
        $component->categori_id = 15;
        $component->alias = 'mpu';
        $component->save();

        $component = new Component;
        $component->nama = 'Spreaders Sp300 Lukas';
        $component->categori_id = 15;
        $component->alias = 'ssl';
        $component->save();

        $component = new Component;
        $component->nama = 'Cutter S 311 Lukas';
        $component->categori_id = 15;
        $component->alias = 'csl';
        $component->save();

        $component = new Component;
        $component->nama = 'Rescue Rams R 400';
        $component->categori_id = 15;
        $component->alias = 'rrr';
        $component->save();

        $component = new Component;
        $component->nama = 'Lrc-Ram Support';
        $component->categori_id = 15;
        $component->alias = 'lrs';
        $component->save();

        $component = new Component;
        $component->nama = 'Hose Extention 10M 2Roll';
        $component->categori_id = 15;
        $component->alias = 'herl';
        $component->save();

        $component = new Component;
        $component->nama = 'Vetter Air Liftingbag 2 Unit';
        $component->categori_id = 15;
        $component->alias = 'valu';
        $component->save();

        $component = new Component;
        $component->nama = 'Vetter Air-Attack 30"';
        $component->categori_id = 15;
        $component->alias = 'vaa';
        $component->save();

        $component = new Component;
        $component->nama = 'Air Cylinder';
        $component->categori_id = 15;
        $component->alias = 'acr';
        $component->save();

        $component = new Component;
        $component->nama = 'Spring Loaded';
        $component->categori_id = 15;
        $component->alias = 'sld';
        $component->save();

        $component = new Component;
        $component->nama = 'Pressure Regulator';
        $component->categori_id = 15;
        $component->alias = 'prr';
        $component->save();

        $component = new Component;
        $component->nama = 'Controller';
        $component->categori_id = 15;
        $component->alias = 'ctrl';
        $component->save();

        $component = new Component;
        $component->nama = 'Hydrant Portable';
        $component->categori_id = 15;
        $component->alias = 'hpl';
        $component->save();

        $component = new Component;
        $component->nama = 'Gasoline Cans';
        $component->categori_id = 15;
        $component->alias = 'gcs';
        $component->save();

        $component = new Component;
        $component->nama = 'Chainset';
        $component->categori_id = 15;
        $component->alias = 'cst';
        $component->save();

        $component = new Component;
        $component->nama = 'Fire Hose';
        $component->categori_id = 15;
        $component->alias = 'fhe';
        $component->save();

        $component = new Component;
        $component->nama = 'Nossel';
        $component->categori_id = 15;
        $component->alias = 'nsl';
        $component->save();

        $component = new Component;
        $component->nama = 'Water Hose';
        $component->categori_id = 15;
        $component->alias = 'whe';
        $component->save();

        $component = new Component;
        $component->nama = 'Generator Krisbow 3800W';
        $component->categori_id = 15;
        $component->alias = 'gkw';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Sorot Krisbow';
        $component->categori_id = 15;
        $component->alias = 'lsk';
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Peralatan';
        $component->categori_id = 15;
        $component->alias = 'kpr';
        $component->save();

        $component = new Component;
        $component->nama = 'Lampu Strobo';
        $component->categori_id = 16;
        $component->alias = 'lsb';
        $component->save();

        $component = new Component;
        $component->nama = 'Public Address';
        $component->categori_id = 16;
        $component->alias = 'pa';
        $component->save();

        $component = new Component;
        $component->nama = 'Raincoat';
        $component->categori_id = 16;
        $component->alias = 'rat';
        $component->save();

        $component = new Component;
        $component->nama = 'Bottle Jack 3 Ton';
        $component->categori_id = 16;
        $component->alias = 'bjt';
        $component->save();

        $component = new Component;
        $component->nama = 'Cable Cutter';
        $component->categori_id = 16;
        $component->alias = 'ccr';
        $component->save();

        $component = new Component;
        $component->nama = 'Apar 6 Kg';
        $component->categori_id = 16;
        $component->alias = 'apr6';
        $component->save();

        $component = new Component;
        $component->nama = 'Apar 9 Kg';
        $component->categori_id = 16;
        $component->alias = 'apr9';
        $component->save();

        $component = new Component;
        $component->nama = 'Safety Line';
        $component->categori_id = 16;
        $component->alias = 'sle';
        $component->save();

        $component = new Component;
        $component->nama = 'First Aid Kit';
        $component->categori_id = 16;
        $component->alias = 'fak';
        $component->save();

        $component = new Component;
        $component->nama = 'Thermal Blanket';
        $component->categori_id = 16;
        $component->alias = 'tbt';
        $component->save();

        $component = new Component;
        $component->nama = 'Kunci Roda';
        $component->categori_id = 16;
        $component->alias = 'kra';
        $component->save();

        $component = new Component;
        $component->nama = 'Cribing';
        $component->categori_id = 16;
        $component->alias = 'crg';
        $component->save();

        $component = new Component;
        $component->nama = 'Jerry Water';
        $component->categori_id = 16;
        $component->alias = 'jwr';
        $component->save();

        $component = new Component;
        $component->nama = 'Parking Chock';
        $component->categori_id = 16;
        $component->alias = 'pck';
        $component->save();

        $component = new Component;
        $component->nama = 'Webing Sling With Rachet';
        $component->categori_id = 16;
        $component->alias = 'wswr';
        $component->save();

        $component = new Component;
        $component->nama = 'Oil Absorbent';
        $component->categori_id = 16;
        $component->alias = 'oat';
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Peralatan Tambahan';
        $component->categori_id = 16;
        $component->alias = 'kpt';
        $component->save();
        
        $component = new Component;
        $component->nama = 'Safety Glove';
        $component->categori_id = 17;
        $component->alias = 'sgv';
        $component->save();
        
        $component = new Component;
        $component->nama = 'Safety Boots';
        $component->categori_id = 17;
        $component->alias = 'sbs';
        $component->save();
        
        $component = new Component;
        $component->nama = 'Safety Glasses';
        $component->categori_id = 17;
        $component->alias = 'sgls';
        $component->save();
        
        $component = new Component;
        $component->nama = 'Headlamp';
        $component->categori_id = 17;
        $component->alias = 'hlp';
        $component->save();
        
        $component = new Component;
        $component->nama = 'Helm Safety';
        $component->categori_id = 17;
        $component->alias = 'hsy';
        $component->save();
        
        $component = new Component;
        $component->nama = 'Apron';
        $component->categori_id = 17;
        $component->alias = 'apn';
        $component->save();

        $component = new Component;
        $component->nama = 'Knee & Body Protector';
        $component->categori_id = 17;
        $component->alias = 'kbp';
        $component->save();

        $component = new Component;
        $component->nama = 'Faceshiled';
        $component->categori_id = 17;
        $component->alias = 'fcd';
        $component->save();

        $component = new Component;
        $component->nama = 'Goggles';
        $component->categori_id = 17;
        $component->alias = 'ggs';
        $component->save();

        $component = new Component;
        $component->nama = 'Single Mask Respirator';
        $component->categori_id = 17;
        $component->alias = 'smr';
        $component->save();

        $component = new Component;
        $component->nama = 'Flip & Cover Protection';
        $component->categori_id = 17;
        $component->alias = 'fcp';
        $component->save();

        $component = new Component;
        $component->nama = 'Fire Boots';
        $component->categori_id = 17;
        $component->alias = 'fbs';
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Personal Protection Equipment';
        $component->categori_id = 17;
        $component->alias = 'kppe';
        $component->save();

        $component = new Component;
        $component->nama = 'Running Test';
        $component->categori_id = 18;
        $component->alias = 'rt';
        $component->save();

        $component = new Component;
        $component->nama = 'Air Radiator';
        $component->categori_id = 18;
        $component->alias = 'arr';
        $component->save();

        $component = new Component;
        $component->nama = 'Oil';
        $component->categori_id = 18;
        $component->alias = 'oil';
        $component->save();

        $component = new Component;
        $component->nama = 'Minyak Rem';
        $component->categori_id = 18;
        $component->alias = 'mr';
        $component->save();

        $component = new Component;
        $component->nama = 'Oil Power Stering';
        $component->categori_id = 18;
        $component->alias = 'ops';
        $component->save();

        $component = new Component;
        $component->nama = 'Keterangan Engine';
        $component->categori_id = 18;
        $component->alias = 'keeng';
        $component->save();
    }
}
