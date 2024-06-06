<?php

namespace App\Http\Controllers;


use App\Models\ActivityMutationServiceTol;
use App\Models\Category;
use App\Models\ConditionStatus;
use App\Models\Officer;
use App\Models\PatroliVehicleLog;
use App\Models\RescueVehicleLog;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Lang, Validator, Session;

class RescueController extends Controller
{
    public function index()
    {
        $id = 3;
         $time = Carbon::now();
       
         $today = $time->toDateString();
         $yesterday = $time->subDay()->toDateString();
         $tomorrow = $time->addDay(2)->toDateString();
         $hour = $time->hour;
         $minute = $time->minute;
         $startTime = Carbon::parse('06:30:00')->format('H:i:s');
         $endTimeToday = Carbon::parse('23:59:59')->format('H:i:s');
         $endTimeTomorrow = Carbon::parse('06:30:00')->format('H:i:s');
         // dd($today,$yesterday,$tomorrow);
         
         if (($hour == 6 && $minute >= 46) || ($hour > 6 && $hour < 14) || ($hour == 14 && $minute <= 30)){
         $jumlah_mutasi = ActivityMutationServiceTol::where('no_mutasi', 'LIKE', Auth::user()->nama.'-%')
         ->where(function ($query) use ($today, $tomorrow, $startTime, $endTimeToday, $endTimeTomorrow, $time) {
             $query->where(function ($q) use ($today, $startTime, $endTimeToday, $time) {
                 $q->whereDate('created_at', $today)
                   ->whereTime('created_at', '>=', $startTime)
                   ->whereTime('created_at', '<=', $time->format('H:i:s'));
             })
             ->orWhere(function ($q) use ($tomorrow, $endTimeTomorrow, $time) {
                 $q->whereDate('created_at', $tomorrow)
                   ->whereTime('created_at', '<=', $endTimeTomorrow)
                   ->whereTime('created_at', '<=', $time->format('H:i:s'));
             });
         })
         ->count();
             if ($jumlah_mutasi <16) {
                 $shift = 1;
             } elseif($jumlah_mutasi <32){
                 $shift = 2;
             } else{
                 $shift = 3;
             }
             
             
         }
         if (($hour == 14 && $minute >= 31) || ($hour > 14 && $hour < 22) || ($hour == 22 && $minute <= 30)){
             $jumlah_mutasi = ActivityMutationServiceTol::where('no_mutasi', 'LIKE', Auth::user()->nama.'-%')
         ->where(function ($query) use ($today, $tomorrow, $startTime, $endTimeToday, $endTimeTomorrow, $time) {
             $query->where(function ($q) use ($today, $startTime, $endTimeToday, $time) {
                 $q->whereDate('created_at', $today)
                   ->whereTime('created_at', '>=', $startTime)
                   ->whereTime('created_at', '<=', $time->format('H:i:s'));
             })
             ->orWhere(function ($q) use ($tomorrow, $endTimeTomorrow, $time) {
                 $q->whereDate('created_at', $tomorrow)
                   ->whereTime('created_at', '<=', $endTimeTomorrow)
                   ->whereTime('created_at', '<=', $time->format('H:i:s'));
             });
         })
         ->count();
             if ($jumlah_mutasi <16) {
                 $shift = 1;
             } elseif($jumlah_mutasi <32){
                 $shift = 2;
             } else{
                 $shift = 3;
             }
  
         }
         if (($hour == 22 && $minute >= 31) || ($hour > 22 && $hour < 24) || ($hour < 6) || ($hour == 6 && $minute <= 45)) {
         // dd($hour);
         if($hour>=0&&$hour<6 || $hour ==6 && $minute<=45) {
             $endTimeYesterday = Carbon::parse('06:30:00')->format('H:i:s');
             $starttime3 = Carbon::parse('06:45:00')->format('H:i:s');
             $jumlah_mutasi = ActivityMutationServiceTol::where('no_mutasi', 'LIKE', Auth::user()->nama.'-%')
             ->where(function ($query) use ($today, $yesterday, $starttime3, $endTimeYesterday, $time) {
                 $query->where(function ($q) use ($yesterday, $endTimeYesterday, $time) {
                     $q->whereDate('created_at', $yesterday)
                       ->whereTime('created_at', '>=', $endTimeYesterday);
                 })
                 ->orWhere(function ($q) use ($today, $starttime3, $time) {
                     $q->whereDate('created_at', $today)
                       ->whereTime('created_at', '<=', $starttime3);
                 });
             })
             ->count();
             //   dd($jumlah_mutasi);
                 if ($jumlah_mutasi <16) {
                     $shift = 1;
                 } elseif($jumlah_mutasi <32){
                     $shift = 2;
                 } else{
                     $shift = 3;
                 }
         }   else{
             $jumlah_mutasi = ActivityMutationServiceTol::where('no_mutasi', 'LIKE', Auth::user()->nama.'-%')
             ->where(function ($query) use ($today, $tomorrow, $startTime, $endTimeToday, $endTimeTomorrow, $time) {
                 $query->where(function ($q) use ($today, $startTime, $endTimeToday, $time) {
                     $q->whereDate('created_at', $today)
                       ->whereTime('created_at', '>=', $startTime)
                       ->whereTime('created_at', '<=', $time->format('H:i:s'));
                 })
                 ->orWhere(function ($q) use ($tomorrow, $endTimeTomorrow, $time) {
                     $q->whereDate('created_at', $tomorrow)
                       ->whereTime('created_at', '<=', $endTimeTomorrow)
                       ->whereTime('created_at', '<=', $time->format('H:i:s'));
                 });
             })
             ->count();
                 if ($jumlah_mutasi <16) {
                     $shift = 1;
                 } elseif($jumlah_mutasi <32){
                     $shift = 2;
                 } else{
                     $shift = 3;
                 }
         }
         
         }
  
        //  dd($jumlah_mutasi);
        $categories = Category::where('operasional_id', $id)->get();
        $datas = Officer::where('operasional_id', $id)->get();
        return view("pages.rescue.log-kelengkapan-kendaraan.index")->with(compact('categories', 'datas', 'shift'));
        
    }
    public function edit($id)
    {
        $datas = RescueVehicleLog::find($id);
        // dd($hour);
        $categories = Category::where('operasional_id', 3)->get();
        $p1= Officer::where('id', $datas->personil)->first();
        return view("pages.rescue.log-kelengkapan-kendaraan.edit")->with(compact('categories', 'datas', 'p1'));
        
    }

    public function store(Request $request){
       $errors = array();
   
        $personil['personil'] = $request->input('personil');
        if(empty( $personil['personil'])){
            $errors[] = 'Harap Isi Personil ' ;
        }

        $odo['odo'] = $request->input('odo');
        if(empty( $odo['odo'])){
            $errors[] = 'Harap Isi Odo Meter' ;
        }

        $bkad['bkad'] = $request->input('bkad');
        // dd(count($bkad['bkad']));
        if (isset($bkad['bkad']['status']) && isset($bkad['bkad']['kondisi'])) {
            $bkad = ConditionStatus::where('status', $bkad['bkad']['status'])->where('kondisi', $bkad['bkad']['kondisi'])->first('id');
        } 
        else if(isset($bkad['bkad']['status']) || isset($bkad['bkad']['kondisi'])) {
            if (isset($bkad['bkad']['status']) && $bkad['bkad']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Kanan Depan';
            }else if (isset($bkad['bkad']['kondisi']) && $bkad['bkad']['kondisi'] == 1){
                $errors[] = 'Harap Isi Status Ban Kanan Depan';
            } 
            else  {
        $bkad = ConditionStatus::where('status', $bkad['bkad']['status'])->first('id');
    }   
        }
          else {
        $errors[] = 'Harap Isi Ban Kanan Depan';
        }  
        
        $bkab['bkab'] = $request->input('bkab');
        if (isset($bkab['bkab']['status']) && isset($bkab['bkab']['kondisi'])) {
            $bkab = ConditionStatus::where('status', $bkab['bkab']['status'])->where('kondisi', $bkab['bkab']['kondisi'])->first('id');
        } else if(isset($bkab['bkab']['status']) || isset($bkab['bkab']['kondisi'])) {
           if (isset($bkab['bkab']['status']) && $bkab['bkab']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Kanan Belakang';
            }else if(isset($bkab['bkab']['kondisi']) && $bkab['bkab']['kondisi'] == 1){
                $errors[] = 'Harap Isi Status Ban Kanan Belakang';
            } 
            else{
                $bkab = ConditionStatus::where('status', $bkab['bkab']['status'])->first('id');
            }
        }
             else {
        $errors[] = 'Harap Isi Ban Kanan Belakang';
        }  
        $bkid['bkid'] = $request->input('bkid');
        if (isset($bkid['bkid']['status']) && isset($bkid['bkid']['kondisi'])) {
            $bkid = ConditionStatus::where('status', $bkid['bkid']['status'])->where('kondisi', $bkid['bkid']['kondisi'])->first('id');
        } else if (isset($bkid['bkid']['status']) || isset($bkid['bkid']['kondisi'])) {
            if (isset($bkid['bkid']['status']) && $bkid['bkid']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Kiri Depan';
            }  else if(isset($bkid['bkid']['kondisi'])){
                $errors[] = 'Harap Isi Status Ban Kiri Depan';
            }
            else   {
                $bkid = ConditionStatus::where('status', $bkid['bkid']['status'])->first('id');
            }
        } 
           else{
                $errors[] ='Harap Isi Ban Kiri Depan';
            } 
        $bkib['bkib'] = $request->input('bkib');
        if (isset($bkib['bkib']['status']) && isset($bkib['bkib']['kondisi'])) {
            $bkib = ConditionStatus::where('status', $bkib['bkib']['status'])->where('kondisi', $bkib['bkib']['kondisi'])->first('id');
        } else if(isset($bkib['bkib']['status']) || isset($bkib['bkib']['kondisi'])){
            if (isset($bkib['bkib']['status']) && $bkib['bkib']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Kiri Belakang';
            }  else if(isset($bkib['bkib']['kondisi'])){
                $errors[] = 'Harap Isi Status Ban Kiri Belakang';
            }
            else {
                $bkib = ConditionStatus::where('status', $bkib['bkib']['status'])->first('id');
            }
        } 
         else{
                $errors[] = 'Harap Isi Ban Kiri Belakang';
            } 
        $bs['bs'] = $request->input('bs');
        if (isset($bs['bs']['status']) && isset($bs['bs']['kondisi'])) {
            $bs = ConditionStatus::where('status', $bs['bs']['status'])->where('kondisi', $bs['bs']['kondisi'])->first('id');
        } else if (isset($bs['bs']['status']) || isset($bs['bs']['kondisi'])) {
            if (isset($bs['bs']['status']) && $bs['bs']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Serep';
            }  else if(isset($bs['bs']['kondisi'])){
                $errors[] = 'Harap Isi Status Ban Serep';
            }
            else  {
                $bs = ConditionStatus::where('status', $bs['bs']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Ban Serep';
            } 


        $kbrdb['kbrdb'] = $request->input('kbrdb');
        if(empty( $kbrdb['kbrdb'])){
            $errors[] = 'Harap Isi Keterangan Roda dan Ban' ;
        }
    
        $stnk['stnk'] = $request->input('stnk');
        if (isset($stnk['stnk']['status']) && isset($stnk['stnk']['kondisi'])) {
            $stnk = ConditionStatus::where('status', $stnk['stnk']['status'])->where('kondisi', $stnk['stnk']['kondisi'])->first('id');
        } else if (isset($stnk['stnk']['status']) || isset($stnk['stnk']['kondisi'])) {
            if (isset($stnk['stnk']['status']) && $stnk['stnk']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi STNK';
            }  else if(isset($stnk['stnk']['kondisi'])){
                $errors[] = 'Harap Isi Status STNK';
            }
            else  {
                $stnk = ConditionStatus::where('status', $stnk['stnk']['status'])->first('id');
            }
        } 
        else{
                $errors[] ='Harap Isi STNK';
            } 

        $ldp['ldp'] = $request->input('ldp');
        if (isset($ldp['ldp']['status']) && isset($ldp['ldp']['kondisi'])) {
            $ldp = ConditionStatus::where('status', $ldp['ldp']['status'])->where('kondisi', $ldp['ldp']['kondisi'])->first('id');
        } else if(isset($ldp['ldp']['status']) || isset($ldp['ldp']['kondisi'])) {
            if (isset($ldp['ldp']['status']) && $ldp['ldp']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Depan';
            }  else if(isset($ldp['ldp']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Depan';
            }
            else {
                $ldp = ConditionStatus::where('status', $ldp['ldp']['status'])->first('id');
            }
        } 
            else{
                $errors[] = 'Harap Isi Lampu Depan';
            }    
       
        $lbg['lbg'] = $request->input('lbg');
        if (isset($lbg['lbg']['status']) && isset($lbg['lbg']['kondisi'])) {
            $lbg = ConditionStatus::where('status', $lbg['lbg']['status'])->where('kondisi', $lbg['lbg']['kondisi'])->first('id');
        } else if(isset($lbg['lbg']['status']) || isset($lbg['lbg']['kondisi'])) {
            if (isset($lbg['lbg']['status']) && $lbg['lbg']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Belakang';
            }  else if(isset($lbg['lbg']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Belakang';
            }
            else   {
                $lbg = ConditionStatus::where('status', $lbg['lbg']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Lampu Belakang';
            }

        $lr['lr'] = $request->input('lr');
        if (isset($lr['lr']['status']) && isset($lr['lr']['kondisi'])) {
            $lr = ConditionStatus::where('status', $lr['lr']['status'])->where('kondisi', $lr['lr']['kondisi'])->first('id');
        } else if (isset($lr['lr']['status']) || isset($lr['lr']['kondisi'])){
            if (isset($lr['lr']['status']) && $lr['lr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Rem';
            }  else if(isset($lr['lr']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Rem';
        }
            else  {
                $lr = ConditionStatus::where('status', $lr['lr']['status'])->first('id');
            }
        }  
           else{
                $errors[] = 'Harap Isi Lampu Rem';
            }

        $lsn['lsn'] = $request->input('lsn');
        if (isset($lsn['lsn']['status']) && isset($lsn['lsn']['kondisi'])) {
            $lsn = ConditionStatus::where('status', $lsn['lsn']['status'])->where('kondisi', $lsn['lsn']['kondisi'])->first('id');
        } else if(isset($lsn['lsn']['status']) || isset($lsn['lsn']['kondisi'])) {
            if (isset($lsn['lsn']['status']) && $lsn['lsn']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Sein';
            }  else if(isset($lsn['lsn']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Sein';
        }
            else  {
                $lsn = ConditionStatus::where('status', $lsn['lsn']['status'])->first('id');
            }
        } 
         else{
                $errors[] = 'Harap Isi Lampu Sein';
            }

        $lrg['lrg'] = $request->input('lrg');
        if (isset($lrg['lrg']['status']) && isset($lrg['lrg']['kondisi'])) {
            $lrg = ConditionStatus::where('status', $lrg['lrg']['status'])->where('kondisi', $lrg['lrg']['kondisi'])->first('id');
        } else if(isset($lrg['lrg']['status']) || isset($lrg['lrg']['kondisi'])) {
            if (isset($lrg['lrg']['status']) && $lrg['lrg']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Ruangan';
            }  else if(isset($lrg['lrg']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Ruangan';
        }
            else  {
                $lrg = ConditionStatus::where('status', $lrg['lrg']['status'])->first('id');
            }
        } 
         else{
                $errors[] = 'Harap Isi Lampu Ruangan';
            }

        $lm['lm'] = $request->input('lm');
        if (isset($lm['lm']['status']) && isset($lm['lm']['kondisi'])) {
            $lm = ConditionStatus::where('status', $lm['lm']['status'])->where('kondisi', $lm['lm']['kondisi'])->first('id');
        } else if (isset($lm['lm']['status']) || isset($lm['lm']['kondisi'])) {
            if (isset($lm['lm']['status']) && $lm['lm']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Mundur';
            }  else if(isset($lm['lm']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Mundur';
        }
            else  {
                $lm = ConditionStatus::where('status', $lm['lm']['status'])->first('id');
            }
        } 
          else{
                $errors[]= 'Harap Isi Lampu Mundur';
            }

        $kl['kl'] = $request->input('kl');
        if (isset($kl['kl']['status']) && isset($kl['kl']['kondisi'])) {
            $kl = ConditionStatus::where('status', $kl['kl']['status'])->where('kondisi', $kl['kl']['kondisi'])->first('id');
        } else if (isset($kl['kl']['status']) || isset($kl['kl']['kondisi'])){
            if (isset($kl['kl']['status']) && $kl['kl']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Klakson';
            }  else if(isset($kl['kl']['kondisi'])){
                $errors[] = 'Harap Isi Status Klakson';
        }
            else  {
                $kl = ConditionStatus::where('status', $kl['kl']['status'])->first('id');
            }
        }  
           else{
                $errors[] ='Harap Isi Klakson';
            }

            
        $ac['ac'] = $request->input('ac');
        if (isset($ac['ac']['status']) && isset($ac['ac']['kondisi'])) {
            $ac = ConditionStatus::where('status', $ac['ac']['status'])->where('kondisi', $ac['ac']['kondisi'])->first('id');
        } else if (isset($ac['ac']['status']) || isset($ac['ac']['kondisi'])){
            if (isset($ac['ac']['status']) && $ac['ac']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Air Conditioner';
            }  else if(isset($ac['ac']['kondisi'])){
                $errors[] = 'Harap Isi Status Air Conditioner';
        }
            else   {
                $ac = ConditionStatus::where('status', $ac['ac']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Air Conditioner';
            }

        $kbd['kbd'] = $request->input('kbd');
        if(empty( $kbd['kbd'])){
            $errors[] = 'Harap Isi Keterangan Bagian Dalam' ;
        }
    
        $mpu['mpu'] = $request->input('mpu');
        if (isset($mpu['mpu']['status']) && isset($mpu['mpu']['kondisi'])) {
            $mpu = ConditionStatus::where('status', $mpu['mpu']['status'])->where('kondisi', $mpu['mpu']['kondisi'])->first('id');
        } else if(isset($mpu['mpu']['status']) || isset($mpu['mpu']['kondisi'])) {
            if (isset($mpu['mpu']['status']) && $mpu['mpu']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Mobile Power Unit';
            }  else if(isset($mpu['mpu']['kondisi'])){
                $errors[] = 'Harap Isi Status Mobile Power Unit';
        }
            else   {
                $mpu = ConditionStatus::where('status', $mpu['mpu']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Mobile Power Unit';
            }

        $ssl['ssl'] = $request->input('ssl');
        if (isset($ssl['ssl']['status']) && isset($ssl['ssl']['kondisi'])) {
            $ssl = ConditionStatus::where('status', $ssl['ssl']['status'])->where('kondisi', $ssl['ssl']['kondisi'])->first('id');
        } else if (isset($ssl['ssl']['status']) || isset($ssl['ssl']['kondisi'])){
            if (isset($ssl['ssl']['status']) && $ssl['ssl']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Spreaders Sp300 Lukas';
            }  else if(isset($ssl['ssl']['kondisi'])){
                $errors[] = 'Harap Isi Status Spreaders Sp300 Lukas';
        }
            else {
                $ssl = ConditionStatus::where('status', $ssl['ssl']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Spreaders Sp300 Lukas';
            }

        $csl['csl'] = $request->input('csl');
        if (isset($csl['csl']['status']) && isset($csl['csl']['kondisi'])) {
            $csl = ConditionStatus::where('status', $csl['csl']['status'])->where('kondisi', $csl['csl']['kondisi'])->first('id');
        } else if (isset($csl['csl']['status']) || isset($csl['csl']['kondisi'])){
            if (isset($csl['csl']['status']) && $csl['csl']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Cuttter S 311 Lukas';
            }  else if(isset($csl['csl']['kondisi'])){
                $errors[] = 'Harap Isi Status Cuttter S 311 Lukas';
        }
            else {
                $csl = ConditionStatus::where('status', $csl['csl']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Cuttter S 311 Lukas';
            }

        $rrr['rrr'] = $request->input('rrr');
        if (isset($rrr['rrr']['status']) && isset($rrr['rrr']['kondisi'])) {
            $rrr = ConditionStatus::where('status', $rrr['rrr']['status'])->where('kondisi', $rrr['rrr']['kondisi'])->first('id');
        } else if (isset($rrr['rrr']['status']) || isset($rrr['rrr']['kondisi'])){
            if (isset($rrr['rrr']['status']) && $rrr['rrr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Rescue Rams R 400';
            }  else if(isset($rrr['rrr']['kondisi'])){
                $errors[] = 'Harap Isi Status Rescue Rams R 400';
        }
            else {
                $rrr = ConditionStatus::where('status', $rrr['rrr']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Rescue Rams R 400';
            }

        $lrs['lrs'] = $request->input('lrs');
        if (isset($lrs['lrs']['status']) && isset($lrs['lrs']['kondisi'])) {
            $lrs = ConditionStatus::where('status', $lrs['lrs']['status'])->where('kondisi', $lrs['lrs']['kondisi'])->first('id');
        } else if (isset($lrs['lrs']['status']) || isset($lrs['lrs']['kondisi'])){
            if (isset($lrs['lrs']['status']) && $lrs['lrs']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lrc-Ram Support';
            }  else if(isset($lrs['lrs']['kondisi'])){
                $errors[] = 'Harap Isi Status Lrc-Ram Support';
        }
            else {
                $lrs = ConditionStatus::where('status', $lrs['lrs']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Lrc-Ram Support';
            }

        $herl['herl'] = $request->input('herl');
        if (isset($herl['herl']['status']) && isset($herl['herl']['kondisi'])) {
            $herl = ConditionStatus::where('status', $herl['herl']['status'])->where('kondisi', $herl['herl']['kondisi'])->first('id');
        } else if (isset($herl['herl']['status']) || isset($herl['herl']['kondisi'])){
            if (isset($herl['herl']['status']) && $herl['herl']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Hose Extention 10M 2Roll';
            }  else if(isset($herl['herl']['kondisi'])){
                $errors[] = 'Harap Isi Status Hose Extention 10M 2Roll';
        }
            else {
                $herl = ConditionStatus::where('status', $herl['herl']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Hose Extention 10M 2Roll';
            }

        $valu['valu'] = $request->input('valu');
        if (isset($valu['valu']['status']) && isset($valu['valu']['kondisi'])) {
            $valu = ConditionStatus::where('status', $valu['valu']['status'])->where('kondisi', $valu['valu']['kondisi'])->first('id');
        } else if (isset($valu['valu']['status']) || isset($valu['valu']['kondisi'])){
            if (isset($valu['valu']['status']) && $valu['valu']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Vetter Air Liftingbag 2 Unit';
            }  else if(isset($valu['valu']['kondisi'])){
                $errors[] = 'Harap Isi Status Vetter Air Liftingbag 2 Unit';
        }
            else {
                $valu = ConditionStatus::where('status', $valu['valu']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Vetter Air Liftingbag 2 Unit';
            }

        $vaa['vaa'] = $request->input('vaa');
        if (isset($vaa['vaa']['status']) && isset($vaa['vaa']['kondisi'])) {
            $vaa = ConditionStatus::where('status', $vaa['vaa']['status'])->where('kondisi', $vaa['vaa']['kondisi'])->first('id');
        } else if (isset($vaa['vaa']['status']) || isset($vaa['vaa']['kondisi'])){
            if (isset($vaa['vaa']['status']) && $vaa['vaa']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Vetter Air-Attack 30"';
            }  else if(isset($vaa['vaa']['kondisi'])){
                $errors[] = 'Harap Isi Status Vetter Air-Attack 30"';
        }
            else {
                $vaa = ConditionStatus::where('status', $vaa['vaa']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Vetter Air-Attack 30"';
            }

        $acr['acr'] = $request->input('acr');
        if (isset($acr['acr']['status']) && isset($acr['acr']['kondisi'])) {
            $acr = ConditionStatus::where('status', $acr['acr']['status'])->where('kondisi', $acr['acr']['kondisi'])->first('id');
        } else if (isset($acr['acr']['status']) || isset($acr['acr']['kondisi'])){
            if (isset($acr['acr']['status']) && $acr['acr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Air Cylinder';
            }  else if(isset($acr['acr']['kondisi'])){
                $errors[] = 'Harap Isi Status Air Cylinder';
        }
            else {
                $acr = ConditionStatus::where('status', $acr['acr']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Air Cylinder';
            }

        $sld['sld'] = $request->input('sld');
        if (isset($sld['sld']['status']) && isset($sld['sld']['kondisi'])) {
            $sld = ConditionStatus::where('status', $sld['sld']['status'])->where('kondisi', $sld['sld']['kondisi'])->first('id');
        } else if (isset($sld['sld']['status']) || isset($sld['sld']['kondisi'])){
            if (isset($sld['sld']['status']) && $sld['sld']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Spring Loaded';
            }  else if(isset($sld['sld']['kondisi'])){
                $errors[] = 'Harap Isi Status Spring Loaded';
        }
            else {
                $sld = ConditionStatus::where('status', $sld['sld']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Spring Loaded';
            }

        $prr['prr'] = $request->input('prr');
        if (isset($prr['prr']['status']) && isset($prr['prr']['kondisi'])) {
            $prr = ConditionStatus::where('status', $prr['prr']['status'])->where('kondisi', $prr['prr']['kondisi'])->first('id');
        } else if (isset($prr['prr']['status']) || isset($prr['prr']['kondisi'])){
            if (isset($prr['prr']['status']) && $prr['prr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Pressure Regulator';
            }  else if(isset($prr['prr']['kondisi'])){
                $errors[] = 'Harap Isi Status Pressure Regulator';
        }
            else {
                $prr = ConditionStatus::where('status', $prr['prr']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Pressure Regulator';
            }

        $ctrl['ctrl'] = $request->input('ctrl');
        if (isset($ctrl['ctrl']['status']) && isset($ctrl['ctrl']['kondisi'])) {
            $ctrl = ConditionStatus::where('status', $ctrl['ctrl']['status'])->where('kondisi', $ctrl['ctrl']['kondisi'])->first('id');
        } else if (isset($ctrl['ctrl']['status']) || isset($ctrl['ctrl']['kondisi'])){
            if (isset($ctrl['ctrl']['status']) && $ctrl['ctrl']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Controller';
            }  else if(isset($ctrl['ctrl']['kondisi'])){
                $errors[] = 'Harap Isi Status Controller';
        }
            else {
                $ctrl = ConditionStatus::where('status', $ctrl['ctrl']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Controller';
            }

        $hpl['hpl'] = $request->input('hpl');
        if (isset($hpl['hpl']['status']) && isset($hpl['hpl']['kondisi'])) {
            $hpl = ConditionStatus::where('status', $hpl['hpl']['status'])->where('kondisi', $hpl['hpl']['kondisi'])->first('id');
        } else if (isset($hpl['hpl']['status']) || isset($hpl['hpl']['kondisi'])){
            if (isset($hpl['hpl']['status']) && $hpl['hpl']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Hydrant Portable';
            }  else if(isset($hpl['hpl']['kondisi'])){
                $errors[] = 'Harap Isi Status Hydrant Portable';
        }
            else {
                $hpl = ConditionStatus::where('status', $hpl['hpl']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Hydrant Portable';
            }

        $gcs['gcs'] = $request->input('gcs');
        if (isset($gcs['gcs']['status']) && isset($gcs['gcs']['kondisi'])) {
            $gcs = ConditionStatus::where('status', $gcs['gcs']['status'])->where('kondisi', $gcs['gcs']['kondisi'])->first('id');
        } else if (isset($gcs['gcs']['status']) || isset($gcs['gcs']['kondisi'])){
            if (isset($gcs['gcs']['status']) && $gcs['gcs']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Gasoline Cans';
            }  else if(isset($gcs['gcs']['kondisi'])){
                $errors[] = 'Harap Isi Status Gasoline Cans';
        }
            else {
                $gcs = ConditionStatus::where('status', $gcs['gcs']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Gasoline Cans';
            }

        $cst['cst'] = $request->input('cst');
        if (isset($cst['cst']['status']) && isset($cst['cst']['kondisi'])) {
            $cst = ConditionStatus::where('status', $cst['cst']['status'])->where('kondisi', $cst['cst']['kondisi'])->first('id');
        } else if (isset($cst['cst']['status']) || isset($cst['cst']['kondisi'])){
            if (isset($cst['cst']['status']) && $cst['cst']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Chainset';
            }  else if(isset($cst['cst']['kondisi'])){
                $errors[] = 'Harap Isi Status Chainset';
        }
            else {
                $cst = ConditionStatus::where('status', $cst['cst']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Chainset';
            }

        $fhe['fhe'] = $request->input('fhe');
        if (isset($fhe['fhe']['status']) && isset($fhe['fhe']['kondisi'])) {
            $fhe = ConditionStatus::where('status', $fhe['fhe']['status'])->where('kondisi', $fhe['fhe']['kondisi'])->first('id');
        } else if (isset($fhe['fhe']['status']) || isset($fhe['fhe']['kondisi'])){
            if (isset($fhe['fhe']['status']) && $fhe['fhe']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Fire Hose';
            }  else if(isset($fhe['fhe']['kondisi'])){
                $errors[] = 'Harap Isi Status Fire Hose';
        }
            else {
                $fhe = ConditionStatus::where('status', $fhe['fhe']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Fire Hose';
            }

        $nsl['nsl'] = $request->input('nsl');
        if (isset($nsl['nsl']['status']) && isset($nsl['nsl']['kondisi'])) {
            $nsl = ConditionStatus::where('status', $nsl['nsl']['status'])->where('kondisi', $nsl['nsl']['kondisi'])->first('id');
        } else if (isset($nsl['nsl']['status']) || isset($nsl['nsl']['kondisi'])){
            if (isset($nsl['nsl']['status']) && $nsl['nsl']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Nossel';
            }  else if(isset($nsl['nsl']['kondisi'])){
                $errors[] = 'Harap Isi Status Nossel';
        }
            else {
                $nsl = ConditionStatus::where('status', $nsl['nsl']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Nossel';
            }

        $whe['whe'] = $request->input('whe');
        if (isset($whe['whe']['status']) && isset($whe['whe']['kondisi'])) {
            $whe = ConditionStatus::where('status', $whe['whe']['status'])->where('kondisi', $whe['whe']['kondisi'])->first('id');
        } else if (isset($whe['whe']['status']) || isset($whe['whe']['kondisi'])){
            if (isset($whe['whe']['status']) && $whe['whe']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Water Hose';
            }  else if(isset($whe['whe']['kondisi'])){
                $errors[] = 'Harap Isi Status Water Hose';
        }
            else {
                $whe = ConditionStatus::where('status', $whe['whe']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Water Hose';
            }

        $gkw['gkw'] = $request->input('gkw');
        if (isset($gkw['gkw']['status']) && isset($gkw['gkw']['kondisi'])) {
            $gkw = ConditionStatus::where('status', $gkw['gkw']['status'])->where('kondisi', $gkw['gkw']['kondisi'])->first('id');
        } else if (isset($gkw['gkw']['status']) || isset($gkw['gkw']['kondisi'])){
            if (isset($gkw['gkw']['status']) && $gkw['gkw']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Generator Krisbow 3800W';
            }  else if(isset($gkw['gkw']['kondisi'])){
                $errors[] = 'Harap Isi Status Generator Krisbow 3800W';
        }
            else {
                $gkw = ConditionStatus::where('status', $gkw['gkw']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Generator Krisbow 3800W';
            }

        $lsk['lsk'] = $request->input('lsk');
        if (isset($lsk['lsk']['status']) && isset($lsk['lsk']['kondisi'])) {
            $lsk = ConditionStatus::where('status', $lsk['lsk']['status'])->where('kondisi', $lsk['lsk']['kondisi'])->first('id');
        } else if (isset($lsk['lsk']['status']) || isset($lsk['lsk']['kondisi'])){
            if (isset($lsk['lsk']['status']) && $lsk['lsk']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Sorot Krisbow';
            }  else if(isset($lsk['lsk']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Sorot Krisbow';
        }
            else {
                $lsk = ConditionStatus::where('status', $lsk['lsk']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Lampu Sorot Krisbow';
            }

        $kpr['kpr'] = $request->input('kpr');
        if(empty( $kpr['kpr'])){
            $errors[] = 'Harap Isi Keterangan Peralatan' ;
        }
    
        $lsb['lsb'] = $request->input('lsb');
        if (isset($lsb['lsb']['status']) && isset($lsb['lsb']['kondisi'])) {
            $lsb = ConditionStatus::where('status', $lsb['lsb']['status'])->where('kondisi', $lsb['lsb']['kondisi'])->first('id');
        } else if (isset($lsb['lsb']['status']) || isset($lsb['lsb']['kondisi'])){
            if (isset($lsb['lsb']['status']) && $lsb['lsb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Strobo';
            }  else if(isset($lsb['lsb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Strobo';
        }
            else {
                $lsb = ConditionStatus::where('status', $lsb['lsb']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Lampu Strobo';
            }

        $pa['pa'] = $request->input('pa');
        if (isset($pa['pa']['status']) && isset($pa['pa']['kondisi'])) {
            $pa = ConditionStatus::where('status', $pa['pa']['status'])->where('kondisi', $pa['pa']['kondisi'])->first('id');
        } else if(isset($pa['pa']['status']) || isset($pa['pa']['kondisi'])) {
            if (isset($pa['pa']['status']) && $pa['pa']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Public Address';
            }  else if(isset($pa['pa']['kondisi'])){
                $errors[] = 'Harap Isi Status Public Address';
        }
            else  {
                $pa = ConditionStatus::where('status', $pa['pa']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Public Address';
            }

        $rat['rat'] = $request->input('rat');
        if (isset($rat['rat']['status']) && isset($rat['rat']['kondisi'])) {
            $rat = ConditionStatus::where('status', $rat['rat']['status'])->where('kondisi', $rat['rat']['kondisi'])->first('id');
        } else if  (isset($rat['rat']['status']) || isset($rat['rat']['kondisi'])) {
            if (isset($rat['rat']['status']) && $rat['rat']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Raincoat';
            }  else if(isset($rat['rat']['kondisi'])){
                $errors[] = 'Harap Isi Status Raincoat';
        }
            else {
                $rat = ConditionStatus::where('status', $rat['rat']['status'])->first('id');
            }
        } 
         else{
                $errors[] = 'Harap Isi Raincoat';
            }

        $bjt['bjt'] = $request->input('bjt');
        if (isset($bjt['bjt']['status']) && isset($bjt['bjt']['kondisi'])) {
            $bjt = ConditionStatus::where('status', $bjt['bjt']['status'])->where('kondisi', $bjt['bjt']['kondisi'])->first('id');
        } else if(isset($bjt['bjt']['status']) || isset($bjt['bjt']['kondisi'])) {
            if (isset($bjt['bjt']['status']) && $bjt['bjt']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Bottle Jack 3 Ton';
            }  else if(isset($bjt['bjt']['kondisi'])){
                $errors[] = 'Harap Isi Status Bottle Jack 3 Ton';
        }
            else   {
                $bjt = ConditionStatus::where('status', $bjt['bjt']['status'])->first('id');
            }
        }  
           else{
                $errors[] = 'Harap Isi Bottle Jack 3 Ton';
            }

        $ccr['ccr'] = $request->input('ccr');
        if (isset($ccr['ccr']['status']) && isset($ccr['ccr']['kondisi'])) {
            $ccr = ConditionStatus::where('status', $ccr['ccr']['status'])->where('kondisi', $ccr['ccr']['kondisi'])->first('id');
        } else if(isset($ccr['ccr']['status']) || isset($ccr['ccr']['kondisi'])){
            if (isset($ccr['ccr']['status']) && $ccr['ccr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Cable Cutter';
            }  else if(isset($ccr['ccr']['kondisi'])){
                $errors[] = 'Harap Isi Status Cable Cutter';
        }
            else {
                $ccr = ConditionStatus::where('status', $ccr['ccr']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Cable Cutter';
            }

        $apr6['apr6'] = $request->input('apr6');
        if (isset($apr6['apr6']['status']) && isset($apr6['apr6']['kondisi'])) {
            $apr6 = ConditionStatus::where('status', $apr6['apr6']['status'])->where('kondisi', $apr6['apr6']['kondisi'])->first('id');
        } else if(isset($apr6['apr6']['status']) || isset($apr6['apr6']['kondisi'])){
            if (isset($apr6['apr6']['status']) && $apr6['apr6']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Apar 6 Kg';
            }  else if(isset($apr6['apr6']['kondisi'])){
                $errors[] = 'Harap Isi Status Apar 6 Kg';
        }
            else{
                $apr6 = ConditionStatus::where('status', $apr6['apr6']['status'])->first('id');
            }
        }  
          else{
                $errors[] = 'Harap Isi Apar 6 Kg' ;
            }

        $apr9['apr9'] = $request->input('apr9');
        if (isset($apr9['apr9']['status']) && isset($apr9['apr9']['kondisi'])) {
            $apr9 = ConditionStatus::where('status', $apr9['apr9']['status'])->where('kondisi', $apr9['apr9']['kondisi'])->first('id');
        } else if(isset($apr9['apr9']['status']) || isset($apr9['apr9']['kondisi'])){
            if (isset($apr9['apr9']['status']) && $apr9['apr9']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Apar 9 Kg';
            }  else if(isset($apr9['apr9']['kondisi'])){
                $errors[] = 'Harap Isi Status Apar 9 Kg';
        }
            else   {
                $apr9 = ConditionStatus::where('status', $apr9['apr9']['status'])->first('id');
            }
        }  
           else{
                $errors[] = 'Harap Isi Apar 9 Kg';
            }

        $sle['sle'] = $request->input('sle');
        if (isset($sle['sle']['status']) && isset($sle['sle']['kondisi'])) {
            $sle = ConditionStatus::where('status', $sle['sle']['status'])->where('kondisi', $sle['sle']['kondisi'])->first('id');
        } else if(isset($sle['sle']['status']) || isset($sle['sle']['kondisi'])) {
            if (isset($sle['sle']['status']) && $sle['sle']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Safety Line';
            }  else if(isset($sle['sle']['kondisi'])){
                $errors[] = 'Harap Isi Status Safety Line';
        }
            else   {
                $sle = ConditionStatus::where('status', $sle['sle']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Safety Line';
            }

        $fak['fak'] = $request->input('fak');
        if (isset($fak['fak']['status']) && isset($fak['fak']['kondisi'])) {
            $fak = ConditionStatus::where('status', $fak['fak']['status'])->where('kondisi', $fak['fak']['kondisi'])->first('id');
        } else if (isset($fak['fak']['status']) || isset($fak['fak']['kondisi']))  {
            if (isset($fak['fak']['status']) && $fak['fak']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi First Aid Kit';
            }  else if(isset($fak['fak']['kondisi'])){
                $errors[] = 'Harap Isi Status First Aid Kit';
        }
            else  {
                $fak = ConditionStatus::where('status', $fak['fak']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi First Aid Kit';
            }

        $tbt['tbt'] = $request->input('tbt');
        if (isset($tbt['tbt']['status']) && isset($tbt['tbt']['kondisi'])) {
            $tbt = ConditionStatus::where('status', $tbt['tbt']['status'])->where('kondisi', $tbt['tbt']['kondisi'])->first('id');
        } else if(isset($tbt['tbt']['status']) || isset($tbt['tbt']['kondisi'])) {
            if (isset($tbt['tbt']['status']) && $tbt['tbt']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Thermal Blanket';
            }  else if(isset($tbt['tbt']['kondisi'])){
                $errors[] = 'Harap Isi Status Thermal Blanket';
        }
            else  {
                $tbt = ConditionStatus::where('status', $tbt['tbt']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Thermal Blanket';
            }

        $kra['kra'] = $request->input('kra');
        if (isset($kra['kra']['status']) && isset($kra['kra']['kondisi'])) {
            $kra = ConditionStatus::where('status', $kra['kra']['status'])->where('kondisi', $kra['kra']['kondisi'])->first('id');
        } else if(isset($kra['kra']['status']) || isset($kra['kra']['kondisi'])){
            if (isset($kra['kra']['status']) && $kra['kra']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kunci Roda';
            }  else if(isset($kra['kra']['kondisi'])){
                $errors[] = 'Harap Isi Status Kunci Roda';
        }
            else{
                $kra = ConditionStatus::where('status', $kra['kra']['status'])->first('id');
            }
        }  
          else{
                $errors[] ='Harap Isi Kunci Roda';
            }

        $crg['crg'] = $request->input('crg');
        if (isset($crg['crg']['status']) && isset($crg['crg']['kondisi'])) {
            $crg = ConditionStatus::where('status', $crg['crg']['status'])->where('kondisi', $crg['crg']['kondisi'])->first('id');
        } else if(isset($crg['crg']['status']) || isset($crg['crg']['kondisi'])){
            if (isset($crg['crg']['status']) && $crg['crg']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Cribing';
            }  else if(isset($crg['crg']['kondisi'])){
                $errors[] = 'Harap Isi Status Cribing';
        }
            else  {
                $crg = ConditionStatus::where('status', $crg['crg']['status'])->first('id');
            }
        }  
          else{
                $errors[] = 'Harap Isi Cribing';
            }

        $jwr['jwr'] = $request->input('jwr');
        if (isset($jwr['jwr']['status']) && isset($jwr['jwr']['kondisi'])) {
            $jwr = ConditionStatus::where('status', $jwr['jwr']['status'])->where('kondisi', $jwr['jwr']['kondisi'])->first('id');
        } else if (isset($jwr['jwr']['status']) || isset($jwr['jwr']['kondisi'])) {
            if (isset($jwr['jwr']['status']) && $jwr['jwr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Jerry Water';
            }  else if(isset($jwr['jwr']['kondisi'])){
                $errors[] = 'Harap Isi Status Jerry Water';
        }
            else {
                $jwr = ConditionStatus::where('status', $jwr['jwr']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Jerry Water';
            }

        $pck['pck'] = $request->input('pck');
        if (isset($pck['pck']['status']) && isset($pck['pck']['kondisi'])) {
            $pck = ConditionStatus::where('status', $pck['pck']['status'])->where('kondisi', $pck['pck']['kondisi'])->first('id');
        } else if(isset($pck['pck']['status']) || isset($pck['pck']['kondisi']))  {
            if (isset($pck['pck']['status']) && $pck['pck']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Parking Chock';
            }  else if(isset($pck['pck']['kondisi'])){
                $errors[] = 'Harap Isi Status Parking Chock';
        }
            else  {
                $pck = ConditionStatus::where('status', $pck['pck']['status'])->first('id');
            }
        }  
        else{
                $errors[] ='Harap Isi Parking Chock';
            }

        $wswr['wswr'] = $request->input('wswr');
        if (isset($wswr['wswr']['status']) && isset($wswr['wswr']['kondisi'])) {
            $wswr = ConditionStatus::where('status', $wswr['wswr']['status'])->where('kondisi', $wswr['wswr']['kondisi'])->first('id');
        } else if(isset($wswr['wswr']['status']) || isset($wswr['wswr']['kondisi']))  {
            if (isset($wswr['wswr']['status']) && $wswr['wswr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Webing Sling With Rachet';
            }  else if(isset($wswr['wswr']['kondisi'])){
                $errors[] = 'Harap Isi Status Webing Sling With Rachet';
        }
            else {
                $wswr = ConditionStatus::where('status', $wswr['wswr']['status'])->first('id');
            }
        }  
           else{
                $errors[] = 'Harap Isi Webing Sling With Rachet';
            }

        $oat['oat'] = $request->input('oat');
        if (isset($oat['oat']['status']) && isset($oat['oat']['kondisi'])) {
            $oat = ConditionStatus::where('status', $oat['oat']['status'])->where('kondisi', $oat['oat']['kondisi'])->first('id');
        } else if(isset($oat['oat']['status']) || isset($oat['oat']['kondisi'])) {
            if (isset($oat['oat']['status']) && $oat['oat']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Oil Absorbent';
            }  else if(isset($oat['oat']['kondisi'])){
                $errors[] = 'Harap Isi Status Oil Absorbent';
        }
            else {
                $oat = ConditionStatus::where('status', $oat['oat']['status'])->first('id');
            }
        }  
          else{
                $errors[] ='Harap Isi Oil Absorbent';
            }

        $kpt['kpt'] = $request->input('kpt');
        if(empty( $kpt['kpt'])){
            $errors[] = 'Harap Isi Keterangan Peralatan Tambahan' ;
        }
    

        $sgv['sgv'] = $request->input('sgv');
        if (isset($sgv['sgv']['status']) && isset($sgv['sgv']['kondisi'])) {
            $sgv = ConditionStatus::where('status', $sgv['sgv']['status'])->where('kondisi', $sgv['sgv']['kondisi'])->first('id');
        } else if(isset($sgv['sgv']['status']) || isset($sgv['sgv']['kondisi'])){
            if (isset($sgv['sgv']['status']) && $sgv['sgv']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Safety Glove';
            }  else if(isset($sgv['sgv']['kondisi'])){
                $errors[] = 'Harap Isi Status Safety Glove';
        }
            else {
                $sgv = ConditionStatus::where('status', $sgv['sgv']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Safety Glove';          
              }

        $sbs['sbs'] = $request->input('sbs');
        if (isset($sbs['sbs']['status']) && isset($sbs['sbs']['kondisi'])) {
            $sbs = ConditionStatus::where('status', $sbs['sbs']['status'])->where('kondisi', $sbs['sbs']['kondisi'])->first('id');
        } else if (isset($sbs['sbs']['status']) || isset($sbs['sbs']['kondisi'])){
            if (isset($sbs['sbs']['status']) && $sbs['sbs']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Safety Boots';
            }  else if(isset($sbs['sbs']['kondisi'])){
                $errors[] = 'Harap Isi Status Safety Boots';
        }
            else  {
                $sbs = ConditionStatus::where('status', $sbs['sbs']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Safety Boots';
            }

        $sgls['sgls'] = $request->input('sgls');
        if (isset($sgls['sgls']['status']) && isset($sgls['sgls']['kondisi'])) {
            $sgls = ConditionStatus::where('status', $sgls['sgls']['status'])->where('kondisi', $sgls['sgls']['kondisi'])->first('id');
        } else if  (isset($sgls['sgls']['status']) || isset($sgls['sgls']['kondisi'])){
            if (isset($sgls['sgls']['status']) && $sgls['sgls']['status'] == 1) {
                $sglsors[] = 'Harap Isi Kondisi Safety Glasses';
            }  else if(isset($sgls['sgls']['kondisi'])){
                $sglsors[] = 'Harap Isi Status Safety Glasses';
        }
            else {
                $sgls = ConditionStatus::where('status', $sgls['sgls']['status'])->first('id');
            }
        }  
          else{
                $errors[] = 'Harap Isi Safety Glasses';            }

        $hlp['hlp'] = $request->input('hlp');
        if (isset($hlp['hlp']['status']) && isset($hlp['hlp']['kondisi'])) {
            $hlp = ConditionStatus::where('status', $hlp['hlp']['status'])->where('kondisi', $hlp['hlp']['kondisi'])->first('id');
        } else if(isset($hlp['hlp']['status']) || isset($hlp['hlp']['kondisi'])){
            if (isset($hlp['hlp']['status']) && $hlp['hlp']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Headlamp';
            }  else if(isset($hlp['hlp']['kondisi'])){
                $errors[] = 'Harap Isi Status Headlamp';
        }
            else  {
                $hlp = ConditionStatus::where('status', $hlp['hlp']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Headlamp';
            }

        $hsy['hsy'] = $request->input('hsy');
        if (isset($hsy['hsy']['status']) && isset($hsy['hsy']['kondisi'])) {
            $hsy = ConditionStatus::where('status', $hsy['hsy']['status'])->where('kondisi', $hsy['hsy']['kondisi'])->first('id');
        } else if(isset($hsy['hsy']['status']) || isset($hsy['hsy']['kondisi'])){
            if (isset($hsy['hsy']['status']) && $hsy['hsy']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Helm Safety';
            }  else if(isset($hsy['hsy']['kondisi'])){
                $errors[] = 'Harap Isi Status Helm Safety';
        }
            else  {
                $hsy = ConditionStatus::where('status', $hsy['hsy']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Helm Safety';
            }

        $apn['apn'] = $request->input('apn');
        if (isset($apn['apn']['status']) && isset($apn['apn']['kondisi'])) {
            $apn = ConditionStatus::where('status', $apn['apn']['status'])->where('kondisi', $apn['apn']['kondisi'])->first('id');
        } else if(isset($apn['apn']['status']) || isset($apn['apn']['kondisi'])){
            if (isset($apn['apn']['status']) && $apn['apn']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Apron';
            }  else if(isset($apn['apn']['kondisi'])){
                $errors[] = 'Harap Isi Status Apron';
        }
            else  {
                $apn = ConditionStatus::where('status', $apn['apn']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Apron';
            }

        $kbp['kbp'] = $request->input('kbp');
        if (isset($kbp['kbp']['status']) && isset($kbp['kbp']['kondisi'])) {
            $kbp = ConditionStatus::where('status', $kbp['kbp']['status'])->where('kondisi', $kbp['kbp']['kondisi'])->first('id');
        } else if(isset($kbp['kbp']['status']) || isset($kbp['kbp']['kondisi'])){
            if (isset($kbp['kbp']['status']) && $kbp['kbp']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Knee & Body Protector';
            }  else if(isset($kbp['kbp']['kondisi'])){
                $errors[] = 'Harap Isi Status Knee & Body Protector';
        }
            else  {
                $kbp = ConditionStatus::where('status', $kbp['kbp']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Knee & Body Protector';
            }

        $fcd['fcd'] = $request->input('fcd');
        if (isset($fcd['fcd']['status']) && isset($fcd['fcd']['kondisi'])) {
            $fcd = ConditionStatus::where('status', $fcd['fcd']['status'])->where('kondisi', $fcd['fcd']['kondisi'])->first('id');
        } else if(isset($fcd['fcd']['status']) || isset($fcd['fcd']['kondisi'])){
            if (isset($fcd['fcd']['status']) && $fcd['fcd']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Faceshield';
            }  else if(isset($fcd['fcd']['kondisi'])){
                $errors[] = 'Harap Isi Status Faceshield';
        }
            else  {
                $fcd = ConditionStatus::where('status', $fcd['fcd']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Faceshield';
            }

        $ggs['ggs'] = $request->input('ggs');
        if (isset($ggs['ggs']['status']) && isset($ggs['ggs']['kondisi'])) {
            $ggs = ConditionStatus::where('status', $ggs['ggs']['status'])->where('kondisi', $ggs['ggs']['kondisi'])->first('id');
        } else if(isset($ggs['ggs']['status']) || isset($ggs['ggs']['kondisi'])){
            if (isset($ggs['ggs']['status']) && $ggs['ggs']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Goggles';
            }  else if(isset($ggs['ggs']['kondisi'])){
                $errors[] = 'Harap Isi Status Goggles';
        }
            else  {
                $ggs = ConditionStatus::where('status', $ggs['ggs']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Goggles';
            }

        $smr['smr'] = $request->input('smr');
        if (isset($smr['smr']['status']) && isset($smr['smr']['kondisi'])) {
            $smr = ConditionStatus::where('status', $smr['smr']['status'])->where('kondisi', $smr['smr']['kondisi'])->first('id');
        } else if(isset($smr['smr']['status']) || isset($smr['smr']['kondisi'])){
            if (isset($smr['smr']['status']) && $smr['smr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Single Mask Respirator';
            }  else if(isset($smr['smr']['kondisi'])){
                $errors[] = 'Harap Isi Status Single Mask Respirator';
        }
            else  {
                $smr = ConditionStatus::where('status', $smr['smr']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Single Mask Respirator';
            }

        $fcp['fcp'] = $request->input('fcp');
        if (isset($fcp['fcp']['status']) && isset($fcp['fcp']['kondisi'])) {
            $fcp = ConditionStatus::where('status', $fcp['fcp']['status'])->where('kondisi', $fcp['fcp']['kondisi'])->first('id');
        } else if(isset($fcp['fcp']['status']) || isset($fcp['fcp']['kondisi'])){
            if (isset($fcp['fcp']['status']) && $fcp['fcp']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Flip & Cover Protection';
            }  else if(isset($fcp['fcp']['kondisi'])){
                $errors[] = 'Harap Isi Status Flip & Cover Protection';
        }
            else  {
                $fcp = ConditionStatus::where('status', $fcp['fcp']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Flip & Cover Protection';
            }

        $fbs['fbs'] = $request->input('fbs');
        if (isset($fbs['fbs']['status']) && isset($fbs['fbs']['kondisi'])) {
            $fbs = ConditionStatus::where('status', $fbs['fbs']['status'])->where('kondisi', $fbs['fbs']['kondisi'])->first('id');
        } else if(isset($fbs['fbs']['status']) || isset($fbs['fbs']['kondisi'])){
            if (isset($fbs['fbs']['status']) && $fbs['fbs']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Fire Boots';
            }  else if(isset($fbs['fbs']['kondisi'])){
                $errors[] = 'Harap Isi Status Fire Boots';
        }
            else  {
                $fbs = ConditionStatus::where('status', $fbs['fbs']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Fire Boots';
            }

        $kppe['kppe'] = $request->input('kppe');
        if(empty( $kppe['kppe'])){
            $errors[] = 'Harap Isi Keterangan Personal Protection Equipment' ;
        }
    
        $rt['rt'] = $request->input('rt');
        if (isset($rt['rt']['status']) && isset($rt['rt']['kondisi'])) {
            $rt = ConditionStatus::where('status', $rt['rt']['status'])->where('kondisi', $rt['rt']['kondisi'])->first('id');
        } else if(isset($rt['rt']['status']) || isset($rt['rt']['kondisi'])){
            if (isset($rt['rt']['status']) && $rt['rt']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Running Test';
            }  else if(isset($rt['rt']['kondisi'])){
                $errors[] = 'Harap Isi Status Running Test';
        }
            else  {
                $rt = ConditionStatus::where('status', $rt['rt']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Running Test';
            }

        $arr['arr'] = $request->input('arr');
        if (isset($arr['arr']['status']) && isset($arr['arr']['kondisi'])) {
            $arr = ConditionStatus::where('status', $arr['arr']['status'])->where('kondisi', $arr['arr']['kondisi'])->first('id');
        } else if(isset($arr['arr']['status']) || isset($arr['arr']['kondisi'])){
            if (isset($arr['arr']['status']) && $arr['arr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Air Radiator';
            }  else if(isset($arr['arr']['kondisi'])){
                $errors[] = 'Harap Isi Status Air Radiator';
        }
            else  {
                $arr = ConditionStatus::where('status', $arr['arr']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Air Radiator';
            }

        $oil['oil'] = $request->input('oil');
        if (isset($oil['oil']['status']) && isset($oil['oil']['kondisi'])) {
            $oil = ConditionStatus::where('status', $oil['oil']['status'])->where('kondisi', $oil['oil']['kondisi'])->first('id');
        } else if(isset($oil['oil']['status']) || isset($oil['oil']['kondisi'])){
            if (isset($oil['oil']['status']) && $oil['oil']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Oil';
            }  else if(isset($oil['oil']['kondisi'])){
                $errors[] = 'Harap Isi Status Oil';
        }
            else  {
                $oil = ConditionStatus::where('status', $oil['oil']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Oil';
            }

        $mr['mr'] = $request->input('mr');
        if (isset($mr['mr']['status']) && isset($mr['mr']['kondisi'])) {
            $mr = ConditionStatus::where('status', $mr['mr']['status'])->where('kondisi', $mr['mr']['kondisi'])->first('id');
        } else if (isset($mr['mr']['status']) || isset($mr['mr']['kondisi'])){
            if (isset($mr['mr']['status']) && $mr['mr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Minyak Rem';
            }  else if(isset($mr['mr']['kondisi'])){
                $errors[] = 'Harap Isi Status Minyak Rem';
        }
            else   {
                $mr = ConditionStatus::where('status', $mr['mr']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Minyak Rem';
            }

        $ops['ops'] = $request->input('ops');
        if (isset($ops['ops']['status']) && isset($ops['ops']['kondisi'])) {
            $ops = ConditionStatus::where('status', $ops['ops']['status'])->where('kondisi', $ops['ops']['kondisi'])->first('id');
        } else if(isset($ops['ops']['status']) || isset($ops['ops']['kondisi'])) {
            if (isset($ops['ops']['status']) && $ops['ops']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Oil Power Steering';
            }  else if(isset($ops['ops']['kondisi'])){
                $errors[] = 'Harap Isi Status Oil Power Steering';
        }
            else {
                $ops = ConditionStatus::where('status', $ops['ops']['status'])->first('id');
            }
        }  
          else{
                $errors[] = 'Harap Isi Oil Power Steering';
            }
            
        $keeng['keeng'] = $request->input('keeng');
        if(empty( $keeng['keeng'])){
            $errors[] = 'Harap Isi Keterangan Engine' ;
        }
        
        if (count($errors) > 0) {
            // If there are errors, redirect back with the input data and errors.
            return redirect()->back()->withInput()->withErrors($errors);
        }  
       
        
        $today =Carbon::now(); 
        $date = $today->toDateString();
        $data = new RescueVehicleLog;
        $data->personil = (int)$request->personil;
        $request->session()->put('personilRescue',$request->personil);
        $data->shift = $request->shift;
        $data->km_awal = $request->odo;
        $data->ban_kanan_depan = $bkad->id;
        $data->ban_kanan_belakang = $bkab->id;
        $data->ban_kiri_depan = $bkid->id;
        $data->ban_kiri_belakang = $bkib->id;
        $data->ban_serep = $bs->id;
        $data->ket_roda_ban =$request->kbrdb;
        $data->stnk = $stnk->id;
        $data->lampu_depan = $ldp->id;
        $data->lampu_belakang = $lbg->id;
        $data->lampu_rem = $lr->id;
        $data->lampu_sein = $lsn->id;
        $data->lampu_mundur = $lm->id;
        $data->lampu_ruangan = $lrg->id;
        $data->air_conditioner = $ac->id;
        $data->klakson = $kl->id;
        $data->ket_bagian_dalam = $request->kbd;;
        $data->mobile_power_unit = $mpu->id;
        $data->spreaders = $ssl->id;
        $data->cutters = $csl->id;
        $data->rescue_rams = $rrr->id;
        $data->lrc_ram = $lrs->id;
        $data->hose_extention = $herl->id;
        $data->vetter_air_liftingbag = $valu->id;
        $data->vetter_air_attack = $vaa->id;
        $data->air_cylinder = $acr->id;
        $data->spring_loaded = $sld->id;
        $data->pressure_regulator = $prr->id;
        $data->controller = $ctrl->id;
        $data->hydrant_portable = $hpl->id;
        $data->gasoline_cans = $gcs->id;
        $data->chainset = $cst->id;
        $data->fire_hose = $fhe->id;
        $data->nossel = $nsl->id;
        $data->water_hose = $whe->id;
        $data->generator_krisbow = $gkw->id;
        $data->lampu_sorot_krisbow = $lsk->id;
        $data->ket_peralatan = $request->kpr;
        $data->public_adress = $pa->id;
        $data->lampu_strobo = $lsb->id;
        $data->raincoat  = $rat->id;
        $data->bottle_jack  = $bjt->id;
        $data->cable_cutter = $ccr->id;
        $data->apar_6kg =$apr6->id ;
        $data->apar_9kg  = $apr9->id;
        $data->safety_line  = $sle->id;
        $data->first_aid = $fak->id;
        $data->thermal_blanket= $tbt->id;
        $data->kunci_roda = $kra->id;
        $data->cribing = $crg->id;
        $data->jerry_water = $jwr->id;
        $data->parking_chock = $pck->id;
        $data->webing_sling = $wswr->id;
        $data->oil_absorbent = $oat->id;
        $data->ket_peralatan_tambahan = $request->kpt;
        $data->safety_glove  = $sgv->id;
        $data->safety_boots = $sbs->id;
        $data->safety_glasses = $sgls->id;
        $data->headlamp = $hlp->id;
        $data->helm_safety = $hsy->id;
        $data->apron = $apn->id;
        $data->knee = $kbp->id;
        $data->faceshild = $fcd->id;
        $data->goggles = $ggs->id;
        $data->single_mask = $smr->id;
        $data->flip_cover= $fcp->id;
        $data->fire_boots = $fbs->id;
        $data->ket_personal_protection = $request->kppe;
        $data->running_test = $rt->id;
        $data->air_radiator = $arr->id;
        $data->oil = $oil->id;
        $data->minyak_rem = $mr->id;
        $data->oil_power_steering = $ops->id;
        $data->ket_engine = $request->keeng;
        $data->unit = Auth::user()->nama.'-'.$date;
        $data->save();
      
        Session::flash('message', Lang::get('Data Berhasil Masuk'));
        return redirect()->route('dashboard-lalin.index');
}
    public function update(Request $request, $id){
       $errors = array();
   
        $personil['personil'] = $request->input('personil');
        if(empty( $personil['personil'])){
            $errors[] = 'Harap Isi Personil ' ;
        }

        $odo['odo'] = $request->input('odo');
        if(empty( $odo['odo'])){
            $errors[] = 'Harap Isi Odo Meter' ;
        }

        $bkad['bkad'] = $request->input('bkad');
        // dd(count($bkad['bkad']));
        if (isset($bkad['bkad']['status']) && isset($bkad['bkad']['kondisi'])) {
            $bkad = ConditionStatus::where('status', $bkad['bkad']['status'])->where('kondisi', $bkad['bkad']['kondisi'])->first('id');
        } 
        else if(isset($bkad['bkad']['status']) || isset($bkad['bkad']['kondisi'])) {
            if (isset($bkad['bkad']['status']) && $bkad['bkad']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Kanan Depan';
            }else if (isset($bkad['bkad']['kondisi']) && $bkad['bkad']['kondisi'] == 1){
                $errors[] = 'Harap Isi Status Ban Kanan Depan';
            } 
            else  {
        $bkad = ConditionStatus::where('status', $bkad['bkad']['status'])->first('id');
    }   
        }
          else {
        $errors[] = 'Harap Isi Ban Kanan Depan';
        }  
        
        $bkab['bkab'] = $request->input('bkab');
        if (isset($bkab['bkab']['status']) && isset($bkab['bkab']['kondisi'])) {
            $bkab = ConditionStatus::where('status', $bkab['bkab']['status'])->where('kondisi', $bkab['bkab']['kondisi'])->first('id');
        } else if(isset($bkab['bkab']['status']) || isset($bkab['bkab']['kondisi'])) {
           if (isset($bkab['bkab']['status']) && $bkab['bkab']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Kanan Belakang';
            }else if(isset($bkab['bkab']['kondisi']) && $bkab['bkab']['kondisi'] == 1){
                $errors[] = 'Harap Isi Status Ban Kanan Belakang';
            } 
            else{
                $bkab = ConditionStatus::where('status', $bkab['bkab']['status'])->first('id');
            }
        }
             else {
        $errors[] = 'Harap Isi Ban Kanan Belakang';
        }  
        $bkid['bkid'] = $request->input('bkid');
        if (isset($bkid['bkid']['status']) && isset($bkid['bkid']['kondisi'])) {
            $bkid = ConditionStatus::where('status', $bkid['bkid']['status'])->where('kondisi', $bkid['bkid']['kondisi'])->first('id');
        } else if (isset($bkid['bkid']['status']) || isset($bkid['bkid']['kondisi'])) {
            if (isset($bkid['bkid']['status']) && $bkid['bkid']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Kiri Depan';
            }  else if(isset($bkid['bkid']['kondisi'])){
                $errors[] = 'Harap Isi Status Ban Kiri Depan';
            }
            else   {
                $bkid = ConditionStatus::where('status', $bkid['bkid']['status'])->first('id');
            }
        } 
           else{
                $errors[] ='Harap Isi Ban Kiri Depan';
            } 
        $bkib['bkib'] = $request->input('bkib');
        if (isset($bkib['bkib']['status']) && isset($bkib['bkib']['kondisi'])) {
            $bkib = ConditionStatus::where('status', $bkib['bkib']['status'])->where('kondisi', $bkib['bkib']['kondisi'])->first('id');
        } else if(isset($bkib['bkib']['status']) || isset($bkib['bkib']['kondisi'])){
            if (isset($bkib['bkib']['status']) && $bkib['bkib']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Kiri Belakang';
            }  else if(isset($bkib['bkib']['kondisi'])){
                $errors[] = 'Harap Isi Status Ban Kiri Belakang';
            }
            else {
                $bkib = ConditionStatus::where('status', $bkib['bkib']['status'])->first('id');
            }
        } 
         else{
                $errors[] = 'Harap Isi Ban Kiri Belakang';
            } 
        $bs['bs'] = $request->input('bs');
        if (isset($bs['bs']['status']) && isset($bs['bs']['kondisi'])) {
            $bs = ConditionStatus::where('status', $bs['bs']['status'])->where('kondisi', $bs['bs']['kondisi'])->first('id');
        } else if (isset($bs['bs']['status']) || isset($bs['bs']['kondisi'])) {
            if (isset($bs['bs']['status']) && $bs['bs']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Serep';
            }  else if(isset($bs['bs']['kondisi'])){
                $errors[] = 'Harap Isi Status Ban Serep';
            }
            else  {
                $bs = ConditionStatus::where('status', $bs['bs']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Ban Serep';
            } 


        $kbrdb['kbrdb'] = $request->input('kbrdb');
        if(empty( $kbrdb['kbrdb'])){
            $errors[] = 'Harap Isi Keterangan Roda dan Ban' ;
        }
    
        $stnk['stnk'] = $request->input('stnk');
        if (isset($stnk['stnk']['status']) && isset($stnk['stnk']['kondisi'])) {
            $stnk = ConditionStatus::where('status', $stnk['stnk']['status'])->where('kondisi', $stnk['stnk']['kondisi'])->first('id');
        } else if (isset($stnk['stnk']['status']) || isset($stnk['stnk']['kondisi'])) {
            if (isset($stnk['stnk']['status']) && $stnk['stnk']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi STNK';
            }  else if(isset($stnk['stnk']['kondisi'])){
                $errors[] = 'Harap Isi Status STNK';
            }
            else  {
                $stnk = ConditionStatus::where('status', $stnk['stnk']['status'])->first('id');
            }
        } 
        else{
                $errors[] ='Harap Isi STNK';
            } 

        $ldp['ldp'] = $request->input('ldp');
        if (isset($ldp['ldp']['status']) && isset($ldp['ldp']['kondisi'])) {
            $ldp = ConditionStatus::where('status', $ldp['ldp']['status'])->where('kondisi', $ldp['ldp']['kondisi'])->first('id');
        } else if(isset($ldp['ldp']['status']) || isset($ldp['ldp']['kondisi'])) {
            if (isset($ldp['ldp']['status']) && $ldp['ldp']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Depan';
            }  else if(isset($ldp['ldp']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Depan';
            }
            else {
                $ldp = ConditionStatus::where('status', $ldp['ldp']['status'])->first('id');
            }
        } 
            else{
                $errors[] = 'Harap Isi Lampu Depan';
            }    
       
        $lbg['lbg'] = $request->input('lbg');
        if (isset($lbg['lbg']['status']) && isset($lbg['lbg']['kondisi'])) {
            $lbg = ConditionStatus::where('status', $lbg['lbg']['status'])->where('kondisi', $lbg['lbg']['kondisi'])->first('id');
        } else if(isset($lbg['lbg']['status']) || isset($lbg['lbg']['kondisi'])) {
            if (isset($lbg['lbg']['status']) && $lbg['lbg']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Belakang';
            }  else if(isset($lbg['lbg']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Belakang';
            }
            else   {
                $lbg = ConditionStatus::where('status', $lbg['lbg']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Lampu Belakang';
            }

        $lr['lr'] = $request->input('lr');
        if (isset($lr['lr']['status']) && isset($lr['lr']['kondisi'])) {
            $lr = ConditionStatus::where('status', $lr['lr']['status'])->where('kondisi', $lr['lr']['kondisi'])->first('id');
        } else if (isset($lr['lr']['status']) || isset($lr['lr']['kondisi'])){
            if (isset($lr['lr']['status']) && $lr['lr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Rem';
            }  else if(isset($lr['lr']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Rem';
        }
            else  {
                $lr = ConditionStatus::where('status', $lr['lr']['status'])->first('id');
            }
        }  
           else{
                $errors[] = 'Harap Isi Lampu Rem';
            }

        $lsn['lsn'] = $request->input('lsn');
        if (isset($lsn['lsn']['status']) && isset($lsn['lsn']['kondisi'])) {
            $lsn = ConditionStatus::where('status', $lsn['lsn']['status'])->where('kondisi', $lsn['lsn']['kondisi'])->first('id');
        } else if(isset($lsn['lsn']['status']) || isset($lsn['lsn']['kondisi'])) {
            if (isset($lsn['lsn']['status']) && $lsn['lsn']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Sein';
            }  else if(isset($lsn['lsn']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Sein';
        }
            else  {
                $lsn = ConditionStatus::where('status', $lsn['lsn']['status'])->first('id');
            }
        } 
         else{
                $errors[] = 'Harap Isi Lampu Sein';
            }

        $lrg['lrg'] = $request->input('lrg');
        if (isset($lrg['lrg']['status']) && isset($lrg['lrg']['kondisi'])) {
            $lrg = ConditionStatus::where('status', $lrg['lrg']['status'])->where('kondisi', $lrg['lrg']['kondisi'])->first('id');
        } else if(isset($lrg['lrg']['status']) || isset($lrg['lrg']['kondisi'])) {
            if (isset($lrg['lrg']['status']) && $lrg['lrg']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Ruangan';
            }  else if(isset($lrg['lrg']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Ruangan';
        }
            else  {
                $lrg = ConditionStatus::where('status', $lrg['lrg']['status'])->first('id');
            }
        } 
         else{
                $errors[] = 'Harap Isi Lampu Ruangan';
            }

        $lm['lm'] = $request->input('lm');
        if (isset($lm['lm']['status']) && isset($lm['lm']['kondisi'])) {
            $lm = ConditionStatus::where('status', $lm['lm']['status'])->where('kondisi', $lm['lm']['kondisi'])->first('id');
        } else if (isset($lm['lm']['status']) || isset($lm['lm']['kondisi'])) {
            if (isset($lm['lm']['status']) && $lm['lm']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Mundur';
            }  else if(isset($lm['lm']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Mundur';
        }
            else  {
                $lm = ConditionStatus::where('status', $lm['lm']['status'])->first('id');
            }
        } 
          else{
                $errors[]= 'Harap Isi Lampu Mundur';
            }

        $kl['kl'] = $request->input('kl');
        if (isset($kl['kl']['status']) && isset($kl['kl']['kondisi'])) {
            $kl = ConditionStatus::where('status', $kl['kl']['status'])->where('kondisi', $kl['kl']['kondisi'])->first('id');
        } else if (isset($kl['kl']['status']) || isset($kl['kl']['kondisi'])){
            if (isset($kl['kl']['status']) && $kl['kl']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Klakson';
            }  else if(isset($kl['kl']['kondisi'])){
                $errors[] = 'Harap Isi Status Klakson';
        }
            else  {
                $kl = ConditionStatus::where('status', $kl['kl']['status'])->first('id');
            }
        }  
           else{
                $errors[] ='Harap Isi Klakson';
            }

            
        $ac['ac'] = $request->input('ac');
        if (isset($ac['ac']['status']) && isset($ac['ac']['kondisi'])) {
            $ac = ConditionStatus::where('status', $ac['ac']['status'])->where('kondisi', $ac['ac']['kondisi'])->first('id');
        } else if (isset($ac['ac']['status']) || isset($ac['ac']['kondisi'])){
            if (isset($ac['ac']['status']) && $ac['ac']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Air Conditioner';
            }  else if(isset($ac['ac']['kondisi'])){
                $errors[] = 'Harap Isi Status Air Conditioner';
        }
            else   {
                $ac = ConditionStatus::where('status', $ac['ac']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Air Conditioner';
            }

        $kbd['kbd'] = $request->input('kbd');
        if(empty( $kbd['kbd'])){
            $errors[] = 'Harap Isi Keterangan Bagian Dalam' ;
        }
    
        $mpu['mpu'] = $request->input('mpu');
        if (isset($mpu['mpu']['status']) && isset($mpu['mpu']['kondisi'])) {
            $mpu = ConditionStatus::where('status', $mpu['mpu']['status'])->where('kondisi', $mpu['mpu']['kondisi'])->first('id');
        } else if(isset($mpu['mpu']['status']) || isset($mpu['mpu']['kondisi'])) {
            if (isset($mpu['mpu']['status']) && $mpu['mpu']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Mobile Power Unit';
            }  else if(isset($mpu['mpu']['kondisi'])){
                $errors[] = 'Harap Isi Status Mobile Power Unit';
        }
            else   {
                $mpu = ConditionStatus::where('status', $mpu['mpu']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Mobile Power Unit';
            }

        $ssl['ssl'] = $request->input('ssl');
        if (isset($ssl['ssl']['status']) && isset($ssl['ssl']['kondisi'])) {
            $ssl = ConditionStatus::where('status', $ssl['ssl']['status'])->where('kondisi', $ssl['ssl']['kondisi'])->first('id');
        } else if (isset($ssl['ssl']['status']) || isset($ssl['ssl']['kondisi'])){
            if (isset($ssl['ssl']['status']) && $ssl['ssl']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Spreaders Sp300 Lukas';
            }  else if(isset($ssl['ssl']['kondisi'])){
                $errors[] = 'Harap Isi Status Spreaders Sp300 Lukas';
        }
            else {
                $ssl = ConditionStatus::where('status', $ssl['ssl']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Spreaders Sp300 Lukas';
            }

        $csl['csl'] = $request->input('csl');
        if (isset($csl['csl']['status']) && isset($csl['csl']['kondisi'])) {
            $csl = ConditionStatus::where('status', $csl['csl']['status'])->where('kondisi', $csl['csl']['kondisi'])->first('id');
        } else if (isset($csl['csl']['status']) || isset($csl['csl']['kondisi'])){
            if (isset($csl['csl']['status']) && $csl['csl']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Cuttter S 311 Lukas';
            }  else if(isset($csl['csl']['kondisi'])){
                $errors[] = 'Harap Isi Status Cuttter S 311 Lukas';
        }
            else {
                $csl = ConditionStatus::where('status', $csl['csl']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Cuttter S 311 Lukas';
            }

        $rrr['rrr'] = $request->input('rrr');
        if (isset($rrr['rrr']['status']) && isset($rrr['rrr']['kondisi'])) {
            $rrr = ConditionStatus::where('status', $rrr['rrr']['status'])->where('kondisi', $rrr['rrr']['kondisi'])->first('id');
        } else if (isset($rrr['rrr']['status']) || isset($rrr['rrr']['kondisi'])){
            if (isset($rrr['rrr']['status']) && $rrr['rrr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Rescue Rams R 400';
            }  else if(isset($rrr['rrr']['kondisi'])){
                $errors[] = 'Harap Isi Status Rescue Rams R 400';
        }
            else {
                $rrr = ConditionStatus::where('status', $rrr['rrr']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Rescue Rams R 400';
            }

        $lrs['lrs'] = $request->input('lrs');
        if (isset($lrs['lrs']['status']) && isset($lrs['lrs']['kondisi'])) {
            $lrs = ConditionStatus::where('status', $lrs['lrs']['status'])->where('kondisi', $lrs['lrs']['kondisi'])->first('id');
        } else if (isset($lrs['lrs']['status']) || isset($lrs['lrs']['kondisi'])){
            if (isset($lrs['lrs']['status']) && $lrs['lrs']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lrc-Ram Support';
            }  else if(isset($lrs['lrs']['kondisi'])){
                $errors[] = 'Harap Isi Status Lrc-Ram Support';
        }
            else {
                $lrs = ConditionStatus::where('status', $lrs['lrs']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Lrc-Ram Support';
            }

        $herl['herl'] = $request->input('herl');
        if (isset($herl['herl']['status']) && isset($herl['herl']['kondisi'])) {
            $herl = ConditionStatus::where('status', $herl['herl']['status'])->where('kondisi', $herl['herl']['kondisi'])->first('id');
        } else if (isset($herl['herl']['status']) || isset($herl['herl']['kondisi'])){
            if (isset($herl['herl']['status']) && $herl['herl']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Hose Extention 10M 2Roll';
            }  else if(isset($herl['herl']['kondisi'])){
                $errors[] = 'Harap Isi Status Hose Extention 10M 2Roll';
        }
            else {
                $herl = ConditionStatus::where('status', $herl['herl']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Hose Extention 10M 2Roll';
            }

        $valu['valu'] = $request->input('valu');
        if (isset($valu['valu']['status']) && isset($valu['valu']['kondisi'])) {
            $valu = ConditionStatus::where('status', $valu['valu']['status'])->where('kondisi', $valu['valu']['kondisi'])->first('id');
        } else if (isset($valu['valu']['status']) || isset($valu['valu']['kondisi'])){
            if (isset($valu['valu']['status']) && $valu['valu']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Vetter Air Liftingbag 2 Unit';
            }  else if(isset($valu['valu']['kondisi'])){
                $errors[] = 'Harap Isi Status Vetter Air Liftingbag 2 Unit';
        }
            else {
                $valu = ConditionStatus::where('status', $valu['valu']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Vetter Air Liftingbag 2 Unit';
            }

        $vaa['vaa'] = $request->input('vaa');
        if (isset($vaa['vaa']['status']) && isset($vaa['vaa']['kondisi'])) {
            $vaa = ConditionStatus::where('status', $vaa['vaa']['status'])->where('kondisi', $vaa['vaa']['kondisi'])->first('id');
        } else if (isset($vaa['vaa']['status']) || isset($vaa['vaa']['kondisi'])){
            if (isset($vaa['vaa']['status']) && $vaa['vaa']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Vetter Air-Attack 30"';
            }  else if(isset($vaa['vaa']['kondisi'])){
                $errors[] = 'Harap Isi Status Vetter Air-Attack 30"';
        }
            else {
                $vaa = ConditionStatus::where('status', $vaa['vaa']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Vetter Air-Attack 30"';
            }

        $acr['acr'] = $request->input('acr');
        if (isset($acr['acr']['status']) && isset($acr['acr']['kondisi'])) {
            $acr = ConditionStatus::where('status', $acr['acr']['status'])->where('kondisi', $acr['acr']['kondisi'])->first('id');
        } else if (isset($acr['acr']['status']) || isset($acr['acr']['kondisi'])){
            if (isset($acr['acr']['status']) && $acr['acr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Air Cylinder';
            }  else if(isset($acr['acr']['kondisi'])){
                $errors[] = 'Harap Isi Status Air Cylinder';
        }
            else {
                $acr = ConditionStatus::where('status', $acr['acr']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Air Cylinder';
            }

        $sld['sld'] = $request->input('sld');
        if (isset($sld['sld']['status']) && isset($sld['sld']['kondisi'])) {
            $sld = ConditionStatus::where('status', $sld['sld']['status'])->where('kondisi', $sld['sld']['kondisi'])->first('id');
        } else if (isset($sld['sld']['status']) || isset($sld['sld']['kondisi'])){
            if (isset($sld['sld']['status']) && $sld['sld']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Spring Loaded';
            }  else if(isset($sld['sld']['kondisi'])){
                $errors[] = 'Harap Isi Status Spring Loaded';
        }
            else {
                $sld = ConditionStatus::where('status', $sld['sld']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Spring Loaded';
            }

        $prr['prr'] = $request->input('prr');
        if (isset($prr['prr']['status']) && isset($prr['prr']['kondisi'])) {
            $prr = ConditionStatus::where('status', $prr['prr']['status'])->where('kondisi', $prr['prr']['kondisi'])->first('id');
        } else if (isset($prr['prr']['status']) || isset($prr['prr']['kondisi'])){
            if (isset($prr['prr']['status']) && $prr['prr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Pressure Regulator';
            }  else if(isset($prr['prr']['kondisi'])){
                $errors[] = 'Harap Isi Status Pressure Regulator';
        }
            else {
                $prr = ConditionStatus::where('status', $prr['prr']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Pressure Regulator';
            }

        $ctrl['ctrl'] = $request->input('ctrl');
        if (isset($ctrl['ctrl']['status']) && isset($ctrl['ctrl']['kondisi'])) {
            $ctrl = ConditionStatus::where('status', $ctrl['ctrl']['status'])->where('kondisi', $ctrl['ctrl']['kondisi'])->first('id');
        } else if (isset($ctrl['ctrl']['status']) || isset($ctrl['ctrl']['kondisi'])){
            if (isset($ctrl['ctrl']['status']) && $ctrl['ctrl']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Controller';
            }  else if(isset($ctrl['ctrl']['kondisi'])){
                $errors[] = 'Harap Isi Status Controller';
        }
            else {
                $ctrl = ConditionStatus::where('status', $ctrl['ctrl']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Controller';
            }

        $hpl['hpl'] = $request->input('hpl');
        if (isset($hpl['hpl']['status']) && isset($hpl['hpl']['kondisi'])) {
            $hpl = ConditionStatus::where('status', $hpl['hpl']['status'])->where('kondisi', $hpl['hpl']['kondisi'])->first('id');
        } else if (isset($hpl['hpl']['status']) || isset($hpl['hpl']['kondisi'])){
            if (isset($hpl['hpl']['status']) && $hpl['hpl']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Hydrant Portable';
            }  else if(isset($hpl['hpl']['kondisi'])){
                $errors[] = 'Harap Isi Status Hydrant Portable';
        }
            else {
                $hpl = ConditionStatus::where('status', $hpl['hpl']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Hydrant Portable';
            }

        $gcs['gcs'] = $request->input('gcs');
        if (isset($gcs['gcs']['status']) && isset($gcs['gcs']['kondisi'])) {
            $gcs = ConditionStatus::where('status', $gcs['gcs']['status'])->where('kondisi', $gcs['gcs']['kondisi'])->first('id');
        } else if (isset($gcs['gcs']['status']) || isset($gcs['gcs']['kondisi'])){
            if (isset($gcs['gcs']['status']) && $gcs['gcs']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Gasoline Cans';
            }  else if(isset($gcs['gcs']['kondisi'])){
                $errors[] = 'Harap Isi Status Gasoline Cans';
        }
            else {
                $gcs = ConditionStatus::where('status', $gcs['gcs']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Gasoline Cans';
            }

        $cst['cst'] = $request->input('cst');
        if (isset($cst['cst']['status']) && isset($cst['cst']['kondisi'])) {
            $cst = ConditionStatus::where('status', $cst['cst']['status'])->where('kondisi', $cst['cst']['kondisi'])->first('id');
        } else if (isset($cst['cst']['status']) || isset($cst['cst']['kondisi'])){
            if (isset($cst['cst']['status']) && $cst['cst']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Chainset';
            }  else if(isset($cst['cst']['kondisi'])){
                $errors[] = 'Harap Isi Status Chainset';
        }
            else {
                $cst = ConditionStatus::where('status', $cst['cst']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Chainset';
            }

        $fhe['fhe'] = $request->input('fhe');
        if (isset($fhe['fhe']['status']) && isset($fhe['fhe']['kondisi'])) {
            $fhe = ConditionStatus::where('status', $fhe['fhe']['status'])->where('kondisi', $fhe['fhe']['kondisi'])->first('id');
        } else if (isset($fhe['fhe']['status']) || isset($fhe['fhe']['kondisi'])){
            if (isset($fhe['fhe']['status']) && $fhe['fhe']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Fire Hose';
            }  else if(isset($fhe['fhe']['kondisi'])){
                $errors[] = 'Harap Isi Status Fire Hose';
        }
            else {
                $fhe = ConditionStatus::where('status', $fhe['fhe']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Fire Hose';
            }

        $nsl['nsl'] = $request->input('nsl');
        if (isset($nsl['nsl']['status']) && isset($nsl['nsl']['kondisi'])) {
            $nsl = ConditionStatus::where('status', $nsl['nsl']['status'])->where('kondisi', $nsl['nsl']['kondisi'])->first('id');
        } else if (isset($nsl['nsl']['status']) || isset($nsl['nsl']['kondisi'])){
            if (isset($nsl['nsl']['status']) && $nsl['nsl']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Nossel';
            }  else if(isset($nsl['nsl']['kondisi'])){
                $errors[] = 'Harap Isi Status Nossel';
        }
            else {
                $nsl = ConditionStatus::where('status', $nsl['nsl']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Nossel';
            }

        $whe['whe'] = $request->input('whe');
        if (isset($whe['whe']['status']) && isset($whe['whe']['kondisi'])) {
            $whe = ConditionStatus::where('status', $whe['whe']['status'])->where('kondisi', $whe['whe']['kondisi'])->first('id');
        } else if (isset($whe['whe']['status']) || isset($whe['whe']['kondisi'])){
            if (isset($whe['whe']['status']) && $whe['whe']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Water Hose';
            }  else if(isset($whe['whe']['kondisi'])){
                $errors[] = 'Harap Isi Status Water Hose';
        }
            else {
                $whe = ConditionStatus::where('status', $whe['whe']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Water Hose';
            }

        $gkw['gkw'] = $request->input('gkw');
        if (isset($gkw['gkw']['status']) && isset($gkw['gkw']['kondisi'])) {
            $gkw = ConditionStatus::where('status', $gkw['gkw']['status'])->where('kondisi', $gkw['gkw']['kondisi'])->first('id');
        } else if (isset($gkw['gkw']['status']) || isset($gkw['gkw']['kondisi'])){
            if (isset($gkw['gkw']['status']) && $gkw['gkw']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Generator Krisbow 3800W';
            }  else if(isset($gkw['gkw']['kondisi'])){
                $errors[] = 'Harap Isi Status Generator Krisbow 3800W';
        }
            else {
                $gkw = ConditionStatus::where('status', $gkw['gkw']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Generator Krisbow 3800W';
            }

        $lsk['lsk'] = $request->input('lsk');
        if (isset($lsk['lsk']['status']) && isset($lsk['lsk']['kondisi'])) {
            $lsk = ConditionStatus::where('status', $lsk['lsk']['status'])->where('kondisi', $lsk['lsk']['kondisi'])->first('id');
        } else if (isset($lsk['lsk']['status']) || isset($lsk['lsk']['kondisi'])){
            if (isset($lsk['lsk']['status']) && $lsk['lsk']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Sorot Krisbow';
            }  else if(isset($lsk['lsk']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Sorot Krisbow';
        }
            else {
                $lsk = ConditionStatus::where('status', $lsk['lsk']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Lampu Sorot Krisbow';
            }

        $kpr['kpr'] = $request->input('kpr');
        if(empty( $kpr['kpr'])){
            $errors[] = 'Harap Isi Keterangan Peralatan' ;
        }
    
        $lsb['lsb'] = $request->input('lsb');
        if (isset($lsb['lsb']['status']) && isset($lsb['lsb']['kondisi'])) {
            $lsb = ConditionStatus::where('status', $lsb['lsb']['status'])->where('kondisi', $lsb['lsb']['kondisi'])->first('id');
        } else if (isset($lsb['lsb']['status']) || isset($lsb['lsb']['kondisi'])){
            if (isset($lsb['lsb']['status']) && $lsb['lsb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Strobo';
            }  else if(isset($lsb['lsb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Strobo';
        }
            else {
                $lsb = ConditionStatus::where('status', $lsb['lsb']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Lampu Strobo';
            }

        $pa['pa'] = $request->input('pa');
        if (isset($pa['pa']['status']) && isset($pa['pa']['kondisi'])) {
            $pa = ConditionStatus::where('status', $pa['pa']['status'])->where('kondisi', $pa['pa']['kondisi'])->first('id');
        } else if(isset($pa['pa']['status']) || isset($pa['pa']['kondisi'])) {
            if (isset($pa['pa']['status']) && $pa['pa']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Public Address';
            }  else if(isset($pa['pa']['kondisi'])){
                $errors[] = 'Harap Isi Status Public Address';
        }
            else  {
                $pa = ConditionStatus::where('status', $pa['pa']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Public Address';
            }

        $rat['rat'] = $request->input('rat');
        if (isset($rat['rat']['status']) && isset($rat['rat']['kondisi'])) {
            $rat = ConditionStatus::where('status', $rat['rat']['status'])->where('kondisi', $rat['rat']['kondisi'])->first('id');
        } else if  (isset($rat['rat']['status']) || isset($rat['rat']['kondisi'])) {
            if (isset($rat['rat']['status']) && $rat['rat']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Raincoat';
            }  else if(isset($rat['rat']['kondisi'])){
                $errors[] = 'Harap Isi Status Raincoat';
        }
            else {
                $rat = ConditionStatus::where('status', $rat['rat']['status'])->first('id');
            }
        } 
         else{
                $errors[] = 'Harap Isi Raincoat';
            }

        $bjt['bjt'] = $request->input('bjt');
        if (isset($bjt['bjt']['status']) && isset($bjt['bjt']['kondisi'])) {
            $bjt = ConditionStatus::where('status', $bjt['bjt']['status'])->where('kondisi', $bjt['bjt']['kondisi'])->first('id');
        } else if(isset($bjt['bjt']['status']) || isset($bjt['bjt']['kondisi'])) {
            if (isset($bjt['bjt']['status']) && $bjt['bjt']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Bottle Jack 3 Ton';
            }  else if(isset($bjt['bjt']['kondisi'])){
                $errors[] = 'Harap Isi Status Bottle Jack 3 Ton';
        }
            else   {
                $bjt = ConditionStatus::where('status', $bjt['bjt']['status'])->first('id');
            }
        }  
           else{
                $errors[] = 'Harap Isi Bottle Jack 3 Ton';
            }

        $ccr['ccr'] = $request->input('ccr');
        if (isset($ccr['ccr']['status']) && isset($ccr['ccr']['kondisi'])) {
            $ccr = ConditionStatus::where('status', $ccr['ccr']['status'])->where('kondisi', $ccr['ccr']['kondisi'])->first('id');
        } else if(isset($ccr['ccr']['status']) || isset($ccr['ccr']['kondisi'])){
            if (isset($ccr['ccr']['status']) && $ccr['ccr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Cable Cutter';
            }  else if(isset($ccr['ccr']['kondisi'])){
                $errors[] = 'Harap Isi Status Cable Cutter';
        }
            else {
                $ccr = ConditionStatus::where('status', $ccr['ccr']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Cable Cutter';
            }

        $apr6['apr6'] = $request->input('apr6');
        if (isset($apr6['apr6']['status']) && isset($apr6['apr6']['kondisi'])) {
            $apr6 = ConditionStatus::where('status', $apr6['apr6']['status'])->where('kondisi', $apr6['apr6']['kondisi'])->first('id');
        } else if(isset($apr6['apr6']['status']) || isset($apr6['apr6']['kondisi'])){
            if (isset($apr6['apr6']['status']) && $apr6['apr6']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Apar 6 Kg';
            }  else if(isset($apr6['apr6']['kondisi'])){
                $errors[] = 'Harap Isi Status Apar 6 Kg';
        }
            else{
                $apr6 = ConditionStatus::where('status', $apr6['apr6']['status'])->first('id');
            }
        }  
          else{
                $errors[] = 'Harap Isi Apar 6 Kg' ;
            }

        $apr9['apr9'] = $request->input('apr9');
        if (isset($apr9['apr9']['status']) && isset($apr9['apr9']['kondisi'])) {
            $apr9 = ConditionStatus::where('status', $apr9['apr9']['status'])->where('kondisi', $apr9['apr9']['kondisi'])->first('id');
        } else if(isset($apr9['apr9']['status']) || isset($apr9['apr9']['kondisi'])){
            if (isset($apr9['apr9']['status']) && $apr9['apr9']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Apar 9 Kg';
            }  else if(isset($apr9['apr9']['kondisi'])){
                $errors[] = 'Harap Isi Status Apar 9 Kg';
        }
            else   {
                $apr9 = ConditionStatus::where('status', $apr9['apr9']['status'])->first('id');
            }
        }  
           else{
                $errors[] = 'Harap Isi Apar 9 Kg';
            }

        $sle['sle'] = $request->input('sle');
        if (isset($sle['sle']['status']) && isset($sle['sle']['kondisi'])) {
            $sle = ConditionStatus::where('status', $sle['sle']['status'])->where('kondisi', $sle['sle']['kondisi'])->first('id');
        } else if(isset($sle['sle']['status']) || isset($sle['sle']['kondisi'])) {
            if (isset($sle['sle']['status']) && $sle['sle']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Safety Line';
            }  else if(isset($sle['sle']['kondisi'])){
                $errors[] = 'Harap Isi Status Safety Line';
        }
            else   {
                $sle = ConditionStatus::where('status', $sle['sle']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Safety Line';
            }

        $fak['fak'] = $request->input('fak');
        if (isset($fak['fak']['status']) && isset($fak['fak']['kondisi'])) {
            $fak = ConditionStatus::where('status', $fak['fak']['status'])->where('kondisi', $fak['fak']['kondisi'])->first('id');
        } else if (isset($fak['fak']['status']) || isset($fak['fak']['kondisi']))  {
            if (isset($fak['fak']['status']) && $fak['fak']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi First Aid Kit';
            }  else if(isset($fak['fak']['kondisi'])){
                $errors[] = 'Harap Isi Status First Aid Kit';
        }
            else  {
                $fak = ConditionStatus::where('status', $fak['fak']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi First Aid Kit';
            }

        $tbt['tbt'] = $request->input('tbt');
        if (isset($tbt['tbt']['status']) && isset($tbt['tbt']['kondisi'])) {
            $tbt = ConditionStatus::where('status', $tbt['tbt']['status'])->where('kondisi', $tbt['tbt']['kondisi'])->first('id');
        } else if(isset($tbt['tbt']['status']) || isset($tbt['tbt']['kondisi'])) {
            if (isset($tbt['tbt']['status']) && $tbt['tbt']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Thermal Blanket';
            }  else if(isset($tbt['tbt']['kondisi'])){
                $errors[] = 'Harap Isi Status Thermal Blanket';
        }
            else  {
                $tbt = ConditionStatus::where('status', $tbt['tbt']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Thermal Blanket';
            }

        $kra['kra'] = $request->input('kra');
        if (isset($kra['kra']['status']) && isset($kra['kra']['kondisi'])) {
            $kra = ConditionStatus::where('status', $kra['kra']['status'])->where('kondisi', $kra['kra']['kondisi'])->first('id');
        } else if(isset($kra['kra']['status']) || isset($kra['kra']['kondisi'])){
            if (isset($kra['kra']['status']) && $kra['kra']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kunci Roda';
            }  else if(isset($kra['kra']['kondisi'])){
                $errors[] = 'Harap Isi Status Kunci Roda';
        }
            else{
                $kra = ConditionStatus::where('status', $kra['kra']['status'])->first('id');
            }
        }  
          else{
                $errors[] ='Harap Isi Kunci Roda';
            }

        $crg['crg'] = $request->input('crg');
        if (isset($crg['crg']['status']) && isset($crg['crg']['kondisi'])) {
            $crg = ConditionStatus::where('status', $crg['crg']['status'])->where('kondisi', $crg['crg']['kondisi'])->first('id');
        } else if(isset($crg['crg']['status']) || isset($crg['crg']['kondisi'])){
            if (isset($crg['crg']['status']) && $crg['crg']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Cribing';
            }  else if(isset($crg['crg']['kondisi'])){
                $errors[] = 'Harap Isi Status Cribing';
        }
            else  {
                $crg = ConditionStatus::where('status', $crg['crg']['status'])->first('id');
            }
        }  
          else{
                $errors[] = 'Harap Isi Cribing';
            }

        $jwr['jwr'] = $request->input('jwr');
        if (isset($jwr['jwr']['status']) && isset($jwr['jwr']['kondisi'])) {
            $jwr = ConditionStatus::where('status', $jwr['jwr']['status'])->where('kondisi', $jwr['jwr']['kondisi'])->first('id');
        } else if (isset($jwr['jwr']['status']) || isset($jwr['jwr']['kondisi'])) {
            if (isset($jwr['jwr']['status']) && $jwr['jwr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Jerry Water';
            }  else if(isset($jwr['jwr']['kondisi'])){
                $errors[] = 'Harap Isi Status Jerry Water';
        }
            else {
                $jwr = ConditionStatus::where('status', $jwr['jwr']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Jerry Water';
            }

        $pck['pck'] = $request->input('pck');
        if (isset($pck['pck']['status']) && isset($pck['pck']['kondisi'])) {
            $pck = ConditionStatus::where('status', $pck['pck']['status'])->where('kondisi', $pck['pck']['kondisi'])->first('id');
        } else if(isset($pck['pck']['status']) || isset($pck['pck']['kondisi']))  {
            if (isset($pck['pck']['status']) && $pck['pck']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Parking Chock';
            }  else if(isset($pck['pck']['kondisi'])){
                $errors[] = 'Harap Isi Status Parking Chock';
        }
            else  {
                $pck = ConditionStatus::where('status', $pck['pck']['status'])->first('id');
            }
        }  
        else{
                $errors[] ='Harap Isi Parking Chock';
            }

        $wswr['wswr'] = $request->input('wswr');
        if (isset($wswr['wswr']['status']) && isset($wswr['wswr']['kondisi'])) {
            $wswr = ConditionStatus::where('status', $wswr['wswr']['status'])->where('kondisi', $wswr['wswr']['kondisi'])->first('id');
        } else if(isset($wswr['wswr']['status']) || isset($wswr['wswr']['kondisi']))  {
            if (isset($wswr['wswr']['status']) && $wswr['wswr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Webing Sling With Rachet';
            }  else if(isset($wswr['wswr']['kondisi'])){
                $errors[] = 'Harap Isi Status Webing Sling With Rachet';
        }
            else {
                $wswr = ConditionStatus::where('status', $wswr['wswr']['status'])->first('id');
            }
        }  
           else{
                $errors[] = 'Harap Isi Webing Sling With Rachet';
            }

        $oat['oat'] = $request->input('oat');
        if (isset($oat['oat']['status']) && isset($oat['oat']['kondisi'])) {
            $oat = ConditionStatus::where('status', $oat['oat']['status'])->where('kondisi', $oat['oat']['kondisi'])->first('id');
        } else if(isset($oat['oat']['status']) || isset($oat['oat']['kondisi'])) {
            if (isset($oat['oat']['status']) && $oat['oat']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Oil Absorbent';
            }  else if(isset($oat['oat']['kondisi'])){
                $errors[] = 'Harap Isi Status Oil Absorbent';
        }
            else {
                $oat = ConditionStatus::where('status', $oat['oat']['status'])->first('id');
            }
        }  
          else{
                $errors[] ='Harap Isi Oil Absorbent';
            }

        $kpt['kpt'] = $request->input('kpt');
        if(empty( $kpt['kpt'])){
            $errors[] = 'Harap Isi Keterangan Peralatan Tambahan' ;
        }
    

        $sgv['sgv'] = $request->input('sgv');
        if (isset($sgv['sgv']['status']) && isset($sgv['sgv']['kondisi'])) {
            $sgv = ConditionStatus::where('status', $sgv['sgv']['status'])->where('kondisi', $sgv['sgv']['kondisi'])->first('id');
        } else if(isset($sgv['sgv']['status']) || isset($sgv['sgv']['kondisi'])){
            if (isset($sgv['sgv']['status']) && $sgv['sgv']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Safety Glove';
            }  else if(isset($sgv['sgv']['kondisi'])){
                $errors[] = 'Harap Isi Status Safety Glove';
        }
            else {
                $sgv = ConditionStatus::where('status', $sgv['sgv']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Safety Glove';          
              }

        $sbs['sbs'] = $request->input('sbs');
        if (isset($sbs['sbs']['status']) && isset($sbs['sbs']['kondisi'])) {
            $sbs = ConditionStatus::where('status', $sbs['sbs']['status'])->where('kondisi', $sbs['sbs']['kondisi'])->first('id');
        } else if (isset($sbs['sbs']['status']) || isset($sbs['sbs']['kondisi'])){
            if (isset($sbs['sbs']['status']) && $sbs['sbs']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Safety Boots';
            }  else if(isset($sbs['sbs']['kondisi'])){
                $errors[] = 'Harap Isi Status Safety Boots';
        }
            else  {
                $sbs = ConditionStatus::where('status', $sbs['sbs']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Safety Boots';
            }

        $sgls['sgls'] = $request->input('sgls');
        if (isset($sgls['sgls']['status']) && isset($sgls['sgls']['kondisi'])) {
            $sgls = ConditionStatus::where('status', $sgls['sgls']['status'])->where('kondisi', $sgls['sgls']['kondisi'])->first('id');
        } else if  (isset($sgls['sgls']['status']) || isset($sgls['sgls']['kondisi'])){
            if (isset($sgls['sgls']['status']) && $sgls['sgls']['status'] == 1) {
                $sglsors[] = 'Harap Isi Kondisi Safety Glasses';
            }  else if(isset($sgls['sgls']['kondisi'])){
                $sglsors[] = 'Harap Isi Status Safety Glasses';
        }
            else {
                $sgls = ConditionStatus::where('status', $sgls['sgls']['status'])->first('id');
            }
        }  
          else{
                $errors[] = 'Harap Isi Safety Glasses';            }

        $hlp['hlp'] = $request->input('hlp');
        if (isset($hlp['hlp']['status']) && isset($hlp['hlp']['kondisi'])) {
            $hlp = ConditionStatus::where('status', $hlp['hlp']['status'])->where('kondisi', $hlp['hlp']['kondisi'])->first('id');
        } else if(isset($hlp['hlp']['status']) || isset($hlp['hlp']['kondisi'])){
            if (isset($hlp['hlp']['status']) && $hlp['hlp']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Headlamp';
            }  else if(isset($hlp['hlp']['kondisi'])){
                $errors[] = 'Harap Isi Status Headlamp';
        }
            else  {
                $hlp = ConditionStatus::where('status', $hlp['hlp']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Headlamp';
            }

        $hsy['hsy'] = $request->input('hsy');
        if (isset($hsy['hsy']['status']) && isset($hsy['hsy']['kondisi'])) {
            $hsy = ConditionStatus::where('status', $hsy['hsy']['status'])->where('kondisi', $hsy['hsy']['kondisi'])->first('id');
        } else if(isset($hsy['hsy']['status']) || isset($hsy['hsy']['kondisi'])){
            if (isset($hsy['hsy']['status']) && $hsy['hsy']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Helm Safety';
            }  else if(isset($hsy['hsy']['kondisi'])){
                $errors[] = 'Harap Isi Status Helm Safety';
        }
            else  {
                $hsy = ConditionStatus::where('status', $hsy['hsy']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Helm Safety';
            }

        $apn['apn'] = $request->input('apn');
        if (isset($apn['apn']['status']) && isset($apn['apn']['kondisi'])) {
            $apn = ConditionStatus::where('status', $apn['apn']['status'])->where('kondisi', $apn['apn']['kondisi'])->first('id');
        } else if(isset($apn['apn']['status']) || isset($apn['apn']['kondisi'])){
            if (isset($apn['apn']['status']) && $apn['apn']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Apron';
            }  else if(isset($apn['apn']['kondisi'])){
                $errors[] = 'Harap Isi Status Apron';
        }
            else  {
                $apn = ConditionStatus::where('status', $apn['apn']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Apron';
            }

        $kbp['kbp'] = $request->input('kbp');
        if (isset($kbp['kbp']['status']) && isset($kbp['kbp']['kondisi'])) {
            $kbp = ConditionStatus::where('status', $kbp['kbp']['status'])->where('kondisi', $kbp['kbp']['kondisi'])->first('id');
        } else if(isset($kbp['kbp']['status']) || isset($kbp['kbp']['kondisi'])){
            if (isset($kbp['kbp']['status']) && $kbp['kbp']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Knee & Body Protector';
            }  else if(isset($kbp['kbp']['kondisi'])){
                $errors[] = 'Harap Isi Status Knee & Body Protector';
        }
            else  {
                $kbp = ConditionStatus::where('status', $kbp['kbp']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Knee & Body Protector';
            }

        $fcd['fcd'] = $request->input('fcd');
        if (isset($fcd['fcd']['status']) && isset($fcd['fcd']['kondisi'])) {
            $fcd = ConditionStatus::where('status', $fcd['fcd']['status'])->where('kondisi', $fcd['fcd']['kondisi'])->first('id');
        } else if(isset($fcd['fcd']['status']) || isset($fcd['fcd']['kondisi'])){
            if (isset($fcd['fcd']['status']) && $fcd['fcd']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Faceshield';
            }  else if(isset($fcd['fcd']['kondisi'])){
                $errors[] = 'Harap Isi Status Faceshield';
        }
            else  {
                $fcd = ConditionStatus::where('status', $fcd['fcd']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Faceshield';
            }

        $ggs['ggs'] = $request->input('ggs');
        if (isset($ggs['ggs']['status']) && isset($ggs['ggs']['kondisi'])) {
            $ggs = ConditionStatus::where('status', $ggs['ggs']['status'])->where('kondisi', $ggs['ggs']['kondisi'])->first('id');
        } else if(isset($ggs['ggs']['status']) || isset($ggs['ggs']['kondisi'])){
            if (isset($ggs['ggs']['status']) && $ggs['ggs']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Goggles';
            }  else if(isset($ggs['ggs']['kondisi'])){
                $errors[] = 'Harap Isi Status Goggles';
        }
            else  {
                $ggs = ConditionStatus::where('status', $ggs['ggs']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Goggles';
            }

        $smr['smr'] = $request->input('smr');
        if (isset($smr['smr']['status']) && isset($smr['smr']['kondisi'])) {
            $smr = ConditionStatus::where('status', $smr['smr']['status'])->where('kondisi', $smr['smr']['kondisi'])->first('id');
        } else if(isset($smr['smr']['status']) || isset($smr['smr']['kondisi'])){
            if (isset($smr['smr']['status']) && $smr['smr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Single Mask Respirator';
            }  else if(isset($smr['smr']['kondisi'])){
                $errors[] = 'Harap Isi Status Single Mask Respirator';
        }
            else  {
                $smr = ConditionStatus::where('status', $smr['smr']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Single Mask Respirator';
            }

        $fcp['fcp'] = $request->input('fcp');
        if (isset($fcp['fcp']['status']) && isset($fcp['fcp']['kondisi'])) {
            $fcp = ConditionStatus::where('status', $fcp['fcp']['status'])->where('kondisi', $fcp['fcp']['kondisi'])->first('id');
        } else if(isset($fcp['fcp']['status']) || isset($fcp['fcp']['kondisi'])){
            if (isset($fcp['fcp']['status']) && $fcp['fcp']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Flip & Cover Protection';
            }  else if(isset($fcp['fcp']['kondisi'])){
                $errors[] = 'Harap Isi Status Flip & Cover Protection';
        }
            else  {
                $fcp = ConditionStatus::where('status', $fcp['fcp']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Flip & Cover Protection';
            }

        $fbs['fbs'] = $request->input('fbs');
        if (isset($fbs['fbs']['status']) && isset($fbs['fbs']['kondisi'])) {
            $fbs = ConditionStatus::where('status', $fbs['fbs']['status'])->where('kondisi', $fbs['fbs']['kondisi'])->first('id');
        } else if(isset($fbs['fbs']['status']) || isset($fbs['fbs']['kondisi'])){
            if (isset($fbs['fbs']['status']) && $fbs['fbs']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Fire Boots';
            }  else if(isset($fbs['fbs']['kondisi'])){
                $errors[] = 'Harap Isi Status Fire Boots';
        }
            else  {
                $fbs = ConditionStatus::where('status', $fbs['fbs']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Fire Boots';
            }

        $kppe['kppe'] = $request->input('kppe');
        if(empty( $kppe['kppe'])){
            $errors[] = 'Harap Isi Keterangan Personal Protection Equipment' ;
        }
    
        $rt['rt'] = $request->input('rt');
        if (isset($rt['rt']['status']) && isset($rt['rt']['kondisi'])) {
            $rt = ConditionStatus::where('status', $rt['rt']['status'])->where('kondisi', $rt['rt']['kondisi'])->first('id');
        } else if(isset($rt['rt']['status']) || isset($rt['rt']['kondisi'])){
            if (isset($rt['rt']['status']) && $rt['rt']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Running Test';
            }  else if(isset($rt['rt']['kondisi'])){
                $errors[] = 'Harap Isi Status Running Test';
        }
            else  {
                $rt = ConditionStatus::where('status', $rt['rt']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Running Test';
            }

        $arr['arr'] = $request->input('arr');
        if (isset($arr['arr']['status']) && isset($arr['arr']['kondisi'])) {
            $arr = ConditionStatus::where('status', $arr['arr']['status'])->where('kondisi', $arr['arr']['kondisi'])->first('id');
        } else if(isset($arr['arr']['status']) || isset($arr['arr']['kondisi'])){
            if (isset($arr['arr']['status']) && $arr['arr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Air Radiator';
            }  else if(isset($arr['arr']['kondisi'])){
                $errors[] = 'Harap Isi Status Air Radiator';
        }
            else  {
                $arr = ConditionStatus::where('status', $arr['arr']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Air Radiator';
            }

        $oil['oil'] = $request->input('oil');
        if (isset($oil['oil']['status']) && isset($oil['oil']['kondisi'])) {
            $oil = ConditionStatus::where('status', $oil['oil']['status'])->where('kondisi', $oil['oil']['kondisi'])->first('id');
        } else if(isset($oil['oil']['status']) || isset($oil['oil']['kondisi'])){
            if (isset($oil['oil']['status']) && $oil['oil']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Oil';
            }  else if(isset($oil['oil']['kondisi'])){
                $errors[] = 'Harap Isi Status Oil';
        }
            else  {
                $oil = ConditionStatus::where('status', $oil['oil']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Oil';
            }

        $mr['mr'] = $request->input('mr');
        if (isset($mr['mr']['status']) && isset($mr['mr']['kondisi'])) {
            $mr = ConditionStatus::where('status', $mr['mr']['status'])->where('kondisi', $mr['mr']['kondisi'])->first('id');
        } else if (isset($mr['mr']['status']) || isset($mr['mr']['kondisi'])){
            if (isset($mr['mr']['status']) && $mr['mr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Minyak Rem';
            }  else if(isset($mr['mr']['kondisi'])){
                $errors[] = 'Harap Isi Status Minyak Rem';
        }
            else   {
                $mr = ConditionStatus::where('status', $mr['mr']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Minyak Rem';
            }

        $ops['ops'] = $request->input('ops');
        if (isset($ops['ops']['status']) && isset($ops['ops']['kondisi'])) {
            $ops = ConditionStatus::where('status', $ops['ops']['status'])->where('kondisi', $ops['ops']['kondisi'])->first('id');
        } else if(isset($ops['ops']['status']) || isset($ops['ops']['kondisi'])) {
            if (isset($ops['ops']['status']) && $ops['ops']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Oil Power Steering';
            }  else if(isset($ops['ops']['kondisi'])){
                $errors[] = 'Harap Isi Status Oil Power Steering';
        }
            else {
                $ops = ConditionStatus::where('status', $ops['ops']['status'])->first('id');
            }
        }  
          else{
                $errors[] = 'Harap Isi Oil Power Steering';
            }
            
        $keeng['keeng'] = $request->input('keeng');
        if(empty( $keeng['keeng'])){
            $errors[] = 'Harap Isi Keterangan Engine' ;
        }
        
        if (count($errors) > 0) {
            // If there are errors, redirect back with the input data and errors.
            return redirect()->back()->withInput()->withErrors($errors);
        }  
       
        
        
        $data = RescueVehicleLog::find($id);
        $data->personil = (int)$request->personil;
        $request->session()->put('personilRescue',$request->personil);
        $data->shift = $request->shift;
        $data->km_awal = $request->odo;
        $data->ban_kanan_depan = $bkad->id;
        $data->ban_kanan_belakang = $bkab->id;
        $data->ban_kiri_depan = $bkid->id;
        $data->ban_kiri_belakang = $bkib->id;
        $data->ban_serep = $bs->id;
        $data->ket_roda_ban =$request->kbrdb;
        $data->stnk = $stnk->id;
        $data->lampu_depan = $ldp->id;
        $data->lampu_belakang = $lbg->id;
        $data->lampu_rem = $lr->id;
        $data->lampu_sein = $lsn->id;
        $data->lampu_mundur = $lm->id;
        $data->lampu_ruangan = $lrg->id;
        $data->air_conditioner = $ac->id;
        $data->klakson = $kl->id;
        $data->ket_bagian_dalam = $request->kbd;;
        $data->mobile_power_unit = $mpu->id;
        $data->spreaders = $ssl->id;
        $data->cutters = $csl->id;
        $data->rescue_rams = $rrr->id;
        $data->lrc_ram = $lrs->id;
        $data->hose_extention = $herl->id;
        $data->vetter_air_liftingbag = $valu->id;
        $data->vetter_air_attack = $vaa->id;
        $data->air_cylinder = $acr->id;
        $data->spring_loaded = $sld->id;
        $data->pressure_regulator = $prr->id;
        $data->controller = $ctrl->id;
        $data->hydrant_portable = $hpl->id;
        $data->gasoline_cans = $gcs->id;
        $data->chainset = $cst->id;
        $data->fire_hose = $fhe->id;
        $data->nossel = $nsl->id;
        $data->water_hose = $whe->id;
        $data->generator_krisbow = $gkw->id;
        $data->lampu_sorot_krisbow = $lsk->id;
        $data->ket_peralatan = $request->kpr;
        $data->public_adress = $pa->id;
        $data->lampu_strobo = $lsb->id;
        $data->raincoat  = $rat->id;
        $data->bottle_jack  = $bjt->id;
        $data->cable_cutter = $ccr->id;
        $data->apar_6kg =$apr6->id ;
        $data->apar_9kg  = $apr9->id;
        $data->safety_line  = $sle->id;
        $data->first_aid = $fak->id;
        $data->thermal_blanket= $tbt->id;
        $data->kunci_roda = $kra->id;
        $data->cribing = $crg->id;
        $data->jerry_water = $jwr->id;
        $data->parking_chock = $pck->id;
        $data->webing_sling = $wswr->id;
        $data->oil_absorbent = $oat->id;
        $data->ket_peralatan_tambahan = $request->kpt;
        $data->safety_glove  = $sgv->id;
        $data->safety_boots = $sbs->id;
        $data->safety_glasses = $sgls->id;
        $data->headlamp = $hlp->id;
        $data->helm_safety = $hsy->id;
        $data->apron = $apn->id;
        $data->knee = $kbp->id;
        $data->faceshild = $fcd->id;
        $data->goggles = $ggs->id;
        $data->single_mask = $smr->id;
        $data->flip_cover= $fcp->id;
        $data->fire_boots = $fbs->id;
        $data->ket_personal_protection = $request->kppe;
        $data->running_test = $rt->id;
        $data->air_radiator = $arr->id;
        $data->oil = $oil->id;
        $data->minyak_rem = $mr->id;
        $data->oil_power_steering = $ops->id;
        $data->ket_engine = $request->keeng;
        $data->save();

        Session::flash('message', Lang::get('Data Berhasil Diedit'));
      if(Auth::user()->operasional_id==10){
           return redirect()->route('admin.lapenam.ceklis');
      }
     
        return redirect()->route('lapenam.ceklis');
}
       public function export($id)
    {
        try {
            $cek = RescueVehicleLog::where('id',$id)
            ->first();
            //  dd($cek);
        if ($cek) {
            $date = $cek->created_at;
        }
    
            $data = RescueVehicleLog::whereBetween('shift',[1,3])->where('unit',$cek->unit)
                // ->where('created_at', $date)
                ->get()
                ->toArray();
                // dd($data);
        } catch (\Exception $errors) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['message' => Lang::get('Data Not Found')]);
        }

        // dd($data['no_mutasi']);
        $pdf = Pdf::loadView('pdf.pemeriksaan-kendaraan-rescue', compact('data'));

        return $pdf->stream('Log Kelengkapan Rescue' . '.pdf');
    }
}


