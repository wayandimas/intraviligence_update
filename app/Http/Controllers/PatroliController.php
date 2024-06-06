<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Component;
use App\Models\ConditionStatus;
use App\Models\Officer;
use App\Models\PatroliVehicleLog;
use App\Models\MonitoringTime;
use App\Models\ActivityMutationServiceTol;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Lang, Validator, Session, Auth;

class PatroliController extends Controller
{
    //
    public function index()
    {
        $id = 1;
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
        // dd($jumlah_mutasi);
        $categories = Category::where('operasional_id', 1)->get();
        $datas = Officer::where('operasional_id', $id)->get();
        return view("pages.patroli.log-kelengkapan-kendaraan.index")->with(compact('categories', 'datas', 'shift', 'jumlah_mutasi'));
        
    }

    public function store(Request $request){


    $errors = array();
   
        $personil1['personil1'] = $request->input('personil1');
        if(empty( $personil1['personil1'])){
            $errors[] = 'Harap Isi Personil 1' ;
        }

        $personil2['personil2'] = $request->input('personil2');
        if(empty( $personil2['personil2'])){
            $errors[] = 'Harap Isi Personil 2' ;
        }

        $odo['odo'] = $request->input('odo');
        if(empty( $odo['odo'])){
            $errors[] = 'Harap Isi Odo Meter' ;
        }

        $bkad['bkad'] = $request->input('bkad');
        // dd(count($bkad['bkad']));
        if (isset($bkad['bkad']['status']) && isset($bkad['bkad']['kondisi'])) {
            $bkad = ConditionStatus::where('status', $bkad['bkad']['status'])->where('kondisi', $bkad['bkad']['kondisi'])->first('id');
        } elseif(isset($bkad['bkad']['status']) || isset($bkad['bkad']['kondisi'])){
            if (isset($bkad['bkad']['status']) && $bkad['bkad']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Kanan Depan';
            }else if (isset($bkad['bkad']['kondisi']) && $bkad['bkad']['kondisi'] == 1){
                $errors[] = 'Harap Isi Status Ban Kanan Depan';
            } 
            else {
                $bkad = ConditionStatus::where('status', $bkad['bkad']['status'])->first('id');
            }
        }
        else{
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

        $vrd['vrd'] = $request->input('vrd');
        if (isset($vrd['vrd']['status']) && isset($vrd['vrd']['kondisi'])) {
            $vrd = ConditionStatus::where('status', $vrd['vrd']['status'])->where('kondisi', $vrd['vrd']['kondisi'])->first('id');
        } else if(isset($vrd['vrd']['status']) || isset($vrd['vrd']['kondisi'])) {
            if (isset($vrd['vrd']['status']) && $vrd['vrd']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Velg Roda & Drop';
            }  else if(isset($vrd['vrd']['kondisi'])){
                $errors[] = 'Harap Isi Status Velg Roda & Drop';
            }
            else {
                $vrd = ConditionStatus::where('status', $vrd['vrd']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Velg Roda & Drop';
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
        $ldb['ldb'] = $request->input('ldb');
        if (isset($ldb['ldb']['status']) && isset($ldb['ldb']['kondisi'])) {
            $ldb = ConditionStatus::where('status', $ldb['ldb']['status'])->where('kondisi', $ldb['ldb']['kondisi'])->first('id');
        } else if(isset($ldb['ldb']['status']) || isset($ldb['ldb']['kondisi'])) {
            if (isset($ldb['ldb']['status']) && $ldb['ldb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Dashboard';
            }  else if(isset($ldb['ldb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Dashboard';
            }
            else {
                $ldb = ConditionStatus::where('status', $ldb['ldb']['status'])->first('id');
            }
        } 
         else{
                $errors[] = 'Harap Isi Lampu Dashboard';
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

        $rt['rt'] = $request->input('rt');
        if (isset($rt['rt']['status']) && isset($rt['rt']['kondisi'])) {
            $rt = ConditionStatus::where('status', $rt['rt']['status'])->where('kondisi', $rt['rt']['kondisi'])->first('id');
        } else if(isset($rt['rt']['status']) || isset($rt['rt']['kondisi'])) {
            if (isset($rt['rt']['status']) && $rt['rt']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Radio/Tape';
            }  else if(isset($rt['rt']['kondisi'])){
                $errors[] = 'Harap Isi Status Radio/Tape';
        }
            else  {
                $rt = ConditionStatus::where('status', $rt['rt']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Radio/Tape';
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

        $sk['sk'] = $request->input('sk');
        if (isset($sk['sk']['status']) && isset($sk['sk']['kondisi'])) {
            $sk = ConditionStatus::where('status', $sk['sk']['status'])->where('kondisi', $sk['sk']['kondisi'])->first('id');
        } else if (isset($sk['sk']['status']) || isset($sk['sk']['kondisi'])){
            if (isset($sk['sk']['status']) && $sk['sk']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Sandaran Kepala';
            }  else if(isset($sk['sk']['kondisi'])){
                $errors[] = 'Harap Isi Status Sandaran Kepala';
        }
            else {
                $sk = ConditionStatus::where('status', $sk['sk']['status'])->first('id');
            }
        }  
           else{
                $errors[] ='Harap Isi Sandaran Kepala';
            }

        $kp['kp'] = $request->input('kp');
        if (isset($kp['kp']['status']) && isset($kp['kp']['kondisi'])) {
            $kp = ConditionStatus::where('status', $kp['kp']['status'])->where('kondisi', $kp['kp']['kondisi'])->first('id');
        } else if(isset($kp['kp']['status']) || isset($kp['kp']['kondisi'])) {
            if (isset($kp['kp']['status']) && $kp['kp']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Karpet';
            }  else if(isset($kp['kp']['kondisi'])){
                $errors[] = 'Harap Isi Status Karpet';
        }
            else {
                $kp = ConditionStatus::where('status', $kp['kp']['status'])->first('id');
            }
        }  
        else{
                $errors[] = 'Harap Isi Karpet';
            }

        $sj['sj'] = $request->input('sj');
        if (isset($sj['sj']['status']) && isset($sj['sj']['kondisi'])) {
            $sj = ConditionStatus::where('status', $sj['sj']['status'])->where('kondisi', $sj['sj']['kondisi'])->first('id');
        } else if (isset($sj['sj']['status']) || isset($sj['sj']['kondisi'])) {
            if (isset($sj['sj']['status']) && $sj['sj']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Sarung Jok';
            }  else if(isset($sj['sj']['kondisi'])){
                $errors[] = 'Harap Isi Status Sarung Jok';
        }
            else {
                $sj = ConditionStatus::where('status', $sj['sj']['status'])->first('id');
            }
        } 
          else{
                $errors[] ='Harap Isi Sarung Jok';
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

        $wp['wp'] = $request->input('wp');
        if (isset($wp['wp']['status']) && isset($wp['wp']['kondisi'])) {
            $wp = ConditionStatus::where('status', $wp['wp']['status'])->where('kondisi', $wp['wp']['kondisi'])->first('id');
        } else if (isset($wp['wp']['status']) || isset($wp['wp']['kondisi'])) {
            if (isset($wp['wp']['status']) && $wp['wp']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Wiper';
            }  else if(isset($wp['wp']['kondisi'])){
                $errors[] = 'Harap Isi Status Wiper';
        }
            else  {
                $wp = ConditionStatus::where('status', $wp['wp']['status'])->first('id');
            }  
        } 
         else{
                $errors[] ='Harap Isi Wiper';
            }

        $spr['spr'] = $request->input('spr');
        if (isset($spr['spr']['status']) && isset($spr['spr']['kondisi'])) {
            $spr = ConditionStatus::where('status', $spr['spr']['status'])->where('kondisi', $spr['spr']['kondisi'])->first('id');
        } else if(isset($spr['spr']['status']) || isset($spr['spr']['kondisi'])) {
            if (isset($spr['spr']['status']) && $spr['spr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Speaker';
            }  else if(isset($spr['spr']['kondisi'])){
                $errors[] = 'Harap Isi Status Speaker';
        }
            else  {
                $spr = ConditionStatus::where('status', $spr['spr']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Speaker';
            }

        $pw['pw'] = $request->input('pw');
        if (isset($pw['pw']['status']) && isset($pw['pw']['kondisi'])) {
            $pw = ConditionStatus::where('status', $pw['pw']['status'])->where('kondisi', $pw['pw']['kondisi'])->first('id');
        } else if (isset($pw['pw']['status']) || isset($pw['pw']['kondisi'])) {
            if (isset($pw['pw']['status']) && $pw['pw']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Power Window';
            }  else if(isset($pw['pw']['kondisi'])){
                $errors[] = 'Harap Isi Status Power Window';
        }
            else {
                $pw = ConditionStatus::where('status', $pw['pw']['status'])->first('id');
            } 
        }  
         else{
                $errors[] = 'Harap Isi Power Window';
            }

        $sb['sb'] = $request->input('sb');
        if (isset($sb['sb']['status']) && isset($sb['sb']['kondisi'])) {
            $sb = ConditionStatus::where('status', $sb['sb']['status'])->where('kondisi', $sb['sb']['kondisi'])->first('id');
        } else if (isset($sb['sb']['status']) || isset($sb['sb']['kondisi']))  {
            if (isset($sb['sb']['status']) && $sb['sb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Seat Belt';
            }  else if(isset($sb['sb']['kondisi'])){
                $errors[] = 'Harap Isi Status Seat Belt';
        }
            else  {
                $sb = ConditionStatus::where('status', $sb['sb']['status'])->first('id');
            }
        }  
           else{
                $errors[] = 'Harap Isi Seat Belt';
            }

            
        $kbd['kbd'] = $request->input('kbd');
        if(empty( $kbd['kbd'])){
            $errors[] = 'Harap Isi Keterangan Bagian Dalam' ;
        }
    
        $kr['kr'] = $request->input('kr');
        if (isset($kr['kr']['status']) && isset($kr['kr']['kondisi'])) {
            $kr = ConditionStatus::where('status', $kr['kr']['status'])->where('kondisi', $kr['kr']['kondisi'])->first('id');
        } else if(isset($kr['kr']['status']) || isset($kr['kr']['kondisi'])) {
            if (isset($kr['kr']['status']) && $kr['kr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kunci Roda';
            }  else if(isset($kr['kr']['kondisi'])){
                $errors[] = 'Harap Isi Status Kunci Roda';
        }
            else   {
                $kr = ConditionStatus::where('status', $kr['kr']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Kunci Roda';
            }

        $dr['dr'] = $request->input('dr');
        if (isset($dr['dr']['status']) && isset($dr['dr']['kondisi'])) {
            $dr = ConditionStatus::where('status', $dr['dr']['status'])->where('kondisi', $dr['dr']['kondisi'])->first('id');
        } else if (isset($dr['dr']['status']) || isset($dr['dr']['kondisi'])){
            if (isset($dr['dr']['status']) && $dr['dr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Dongkrak';
            }  else if(isset($dr['dr']['kondisi'])){
                $errors[] = 'Harap Isi Status Dongkrak';
        }
            else {
                $dr = ConditionStatus::where('status', $dr['dr']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Dongkrak';
            }

        $p3k['p3k'] = $request->input('p3k');
        if (isset($p3k['p3k']['status']) && isset($p3k['p3k']['kondisi'])) {
            $p3k = ConditionStatus::where('status', $p3k['p3k']['status'])->where('kondisi', $p3k['p3k']['kondisi'])->first('id');
        } else if(isset($p3k['p3k']['status']) || isset($p3k['p3k']['kondisi'])) {
            if (isset($p3k['p3k']['status']) && $p3k['p3k']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi P3K';
            }  else if(isset($p3k['p3k']['kondisi'])){
                $errors[] = 'Harap Isi Status P3K';
        }
            else {
                $p3k = ConditionStatus::where('status', $p3k['p3k']['status'])->first('id');
            }
        }  
           else{
                $errors[] = 'Harap Isi P3K';
            }

            
        $kpr['kpr'] = $request->input('kpr');
        if(empty( $kpr['kpr'])){
            $errors[] = 'Harap Isi Keterangan Peralatan' ;
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

        $lsb['lsb'] = $request->input('lsb');
        if (isset($lsb['lsb']['status']) && isset($lsb['lsb']['kondisi'])) {
            $lsb = ConditionStatus::where('status', $lsb['lsb']['status'])->where('kondisi', $lsb['lsb']['kondisi'])->first('id');
        } else if (isset($lsb['lsb']['status']) || isset($lsb['lsb']['kondisi'])){
            if (isset($lsb['lsb']['status']) && $lsb['lsb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Strobo (Rotary)';
            }  else if(isset($lsb['lsb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Strobo (Rotary)';
        }
            else {
                $lsb = ConditionStatus::where('status', $lsb['lsb']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Lampu Strobo (Rotary)';
            }

        $apar['apar'] = $request->input('apar');
        if (isset($apar['apar']['status']) && isset($apar['apar']['kondisi'])) {
            $apar = ConditionStatus::where('status', $apar['apar']['status'])->where('kondisi', $apar['apar']['kondisi'])->first('id');
        } else if(isset($apar['apar']['status']) || isset($apar['apar']['kondisi'])){
            if (isset($apar['apar']['status']) && $apar['apar']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi APAR';
            }  else if(isset($apar['apar']['kondisi'])){
                $errors[] = 'Harap Isi Status APAR';
        }
            else{
                $apar = ConditionStatus::where('status', $apar['apar']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi APAR';
            }

        $lpsr['lpsr'] = $request->input('lpsr');
        if (isset($lpsr['lpsr']['status']) && isset($lpsr['lpsr']['kondisi'])) {
            $lpsr = ConditionStatus::where('status', $lpsr['lpsr']['status'])->where('kondisi', $lpsr['lpsr']['kondisi'])->first('id');
        } else if  (isset($lpsr['lpsr']['status']) || isset($lpsr['lpsr']['kondisi'])) {
            if (isset($lpsr['lpsr']['status']) && $lpsr['lpsr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Sorot';
            }  else if(isset($lpsr['lpsr']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Sorot';
        }
            else {
                $lpsr = ConditionStatus::where('status', $lpsr['lpsr']['status'])->first('id');
            }
        } 
         else{
                $errors[] = 'Harap Isi Lampu Sorot';
            }

        $rc['rc'] = $request->input('rc');
        if (isset($rc['rc']['status']) && isset($rc['rc']['kondisi'])) {
            $rc = ConditionStatus::where('status', $rc['rc']['status'])->where('kondisi', $rc['rc']['kondisi'])->first('id');
        } else if(isset($rc['rc']['status']) || isset($rc['rc']['kondisi'])) {
            if (isset($rc['rc']['status']) && $rc['rc']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Rubber Cone';
            }  else if(isset($rc['rc']['kondisi'])){
                $errors[] = 'Harap Isi Status Rubber Cone';
        }
            else   {
                $rc = ConditionStatus::where('status', $rc['rc']['status'])->first('id');
            }
        }  
           else{
                $errors[] = 'Harap Isi Rubber Cone';
            }

        $rts['rts'] = $request->input('rts');
        if (isset($rts['rts']['status']) && isset($rts['rts']['kondisi'])) {
            $rts = ConditionStatus::where('status', $rts['rts']['status'])->where('kondisi', $rts['rts']['kondisi'])->first('id');
        } else if(isset($rts['rts']['status']) || isset($rts['rts']['kondisi'])){
            if (isset($rts['rts']['status']) && $rts['rts']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Rambu Tanda Seru';
            }  else if(isset($rts['rts']['kondisi'])){
                $errors[] = 'Harap Isi Status Rambu Tanda Seru';
        }
            else {
                $rts = ConditionStatus::where('status', $rts['rts']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Rambu Tanda Seru';
            }

        $rpa['rpa'] = $request->input('rpa');
        if (isset($rpa['rpa']['status']) && isset($rpa['rpa']['kondisi'])) {
            $rpa = ConditionStatus::where('status', $rpa['rpa']['status'])->where('kondisi', $rpa['rpa']['kondisi'])->first('id');
        } else if(isset($rpa['rpa']['status']) || isset($rpa['rpa']['kondisi'])){
            if (isset($rpa['rpa']['status']) && $rpa['rpa']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Rambu Petunjuk Arah';
            }  else if(isset($rpa['rpa']['kondisi'])){
                $errors[] = 'Harap Isi Status Rambu Petunjuk Arah';
        }
            else{
                $rpa = ConditionStatus::where('status', $rpa['rpa']['status'])->first('id');
            }
        }  
          else{
                $errors[] = 'Harap Isi Rambu Petunjuk Arah' ;
            }

        $flg['flg'] = $request->input('flg');
        if (isset($flg['flg']['status']) && isset($flg['flg']['kondisi'])) {
            $flg = ConditionStatus::where('status', $flg['flg']['status'])->where('kondisi', $flg['flg']['kondisi'])->first('id');
        } else if(isset($flg['flg']['status']) || isset($flg['flg']['kondisi'])){
            if (isset($flg['flg']['status']) && $flg['flg']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Flag (Bendera)';
            }  else if(isset($flg['flg']['kondisi'])){
                $errors[] = 'Harap Isi Status Flag (Bendera)';
        }
            else   {
                $flg = ConditionStatus::where('status', $flg['flg']['status'])->first('id');
            }
        }  
           else{
                $errors[] = 'Harap Isi Flag (Bendera)';
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
            else   {
                $oat = ConditionStatus::where('status', $oat['oat']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Oil Absorbent';
            }

        $scr['scr'] = $request->input('scr');
        if (isset($scr['scr']['status']) && isset($scr['scr']['kondisi'])) {
            $scr = ConditionStatus::where('status', $scr['scr']['status'])->where('kondisi', $scr['scr']['kondisi'])->first('id');
        } else if (isset($scr['scr']['status']) || isset($scr['scr']['kondisi']))  {
            if (isset($scr['scr']['status']) && $scr['scr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Senter Charger';
            }  else if(isset($scr['scr']['kondisi'])){
                $errors[] = 'Harap Isi Status Senter Charger';
        }
            else  {
                $scr = ConditionStatus::where('status', $scr['scr']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Senter Charger';
            }

        $sbt['sbt'] = $request->input('sbt');
        if (isset($sbt['sbt']['status']) && isset($sbt['sbt']['kondisi'])) {
            $sbt = ConditionStatus::where('status', $sbt['sbt']['status'])->where('kondisi', $sbt['sbt']['kondisi'])->first('id');
        } else if(isset($sbt['sbt']['status']) || isset($sbt['sbt']['kondisi'])) {
            if (isset($sbt['sbt']['status']) && $sbt['sbt']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Sepatu Boat';
            }  else if(isset($sbt['sbt']['kondisi'])){
                $errors[] = 'Harap Isi Status Sepatu Boat';
        }
            else  {
                $sbt = ConditionStatus::where('status', $sbt['sbt']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Sepatu Boat';
            }

        $jhn['jhn'] = $request->input('jhn');
        if (isset($jhn['jhn']['status']) && isset($jhn['jhn']['kondisi'])) {
            $jhn = ConditionStatus::where('status', $jhn['jhn']['status'])->where('kondisi', $jhn['jhn']['kondisi'])->first('id');
        } else if(isset($jhn['jhn']['status']) || isset($jhn['jhn']['kondisi'])){
            if (isset($jhn['jhn']['status']) && $jhn['jhn']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Jas Hujan';
            }  else if(isset($jhn['jhn']['kondisi'])){
                $errors[] = 'Harap Isi Status Jas Hujan';
        }
            else{
                $jhn = ConditionStatus::where('status', $jhn['jhn']['status'])->first('id');
            }
        }  
          else{
                $errors[] ='Harap Isi Jas Hujan';
            }

        $sln['sln'] = $request->input('sln');
        if (isset($sln['sln']['status']) && isset($sln['sln']['kondisi'])) {
            $sln = ConditionStatus::where('status', $sln['sln']['status'])->where('kondisi', $sln['sln']['kondisi'])->first('id');
        } else if(isset($sln['sln']['status']) || isset($sln['sln']['kondisi'])){
            if (isset($sln['sln']['status']) && $sln['sln']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Senter Lalin';
            }  else if(isset($sln['sln']['kondisi'])){
                $errors[] = 'Harap Isi Status Senter Lalin';
        }
            else  {
                $sln = ConditionStatus::where('status', $sln['sln']['status'])->first('id');
            }
        }  
          else{
                $errors[] = 'Harap Isi Senter Lalin';
            }

        $sgls['sgls'] = $request->input('sgls');
        if (isset($sgls['sgls']['status']) && isset($sgls['sgls']['kondisi'])) {
            $sgls = ConditionStatus::where('status', $sgls['sgls']['status'])->where('kondisi', $sgls['sgls']['kondisi'])->first('id');
        } else if (isset($sgls['sgls']['status']) || isset($sgls['sgls']['kondisi'])) {
            if (isset($sgls['sgls']['status']) && $sgls['sgls']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Safety Glasses';
            }  else if(isset($sgls['sgls']['kondisi'])){
                $errors[] = 'Harap Isi Status Safety Glasses';
        }
            else {
                $sgls = ConditionStatus::where('status', $sgls['sgls']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Safety Glasses';
            }

        $hlm['hlm'] = $request->input('hlm');
        if (isset($hlm['hlm']['status']) && isset($hlm['hlm']['kondisi'])) {
            $hlm = ConditionStatus::where('status', $hlm['hlm']['status'])->where('kondisi', $hlm['hlm']['kondisi'])->first('id');
        } else if(isset($hlm['hlm']['status']) || isset($hlm['hlm']['kondisi']))  {
            if (isset($hlm['hlm']['status']) && $hlm['hlm']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Helm';
            }  else if(isset($hlm['hlm']['kondisi'])){
                $errors[] = 'Harap Isi Status Helm';
        }
            else  {
                $hlm = ConditionStatus::where('status', $hlm['hlm']['status'])->first('id');
            }
        }  
        else{
                $errors[] ='Harap Isi Helm';
            }

        $sgvs['sgvs'] = $request->input('sgvs');
        if (isset($sgvs['sgvs']['status']) && isset($sgvs['sgvs']['kondisi'])) {
            $sgvs = ConditionStatus::where('status', $sgvs['sgvs']['status'])->where('kondisi', $sgvs['sgvs']['kondisi'])->first('id');
        } else if(isset($sgvs['sgvs']['status']) || isset($sgvs['sgvs']['kondisi']))  {
            if (isset($sgvs['sgvs']['status']) && $sgvs['sgvs']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Safety Gloves';
            }  else if(isset($sgvs['sgvs']['kondisi'])){
                $errors[] = 'Harap Isi Status Safety Gloves';
        }
            else {
                $sgvs = ConditionStatus::where('status', $sgvs['sgvs']['status'])->first('id');
            }
        }  
           else{
                $errors[] = 'Harap Isi Safety Gloves';
            }

        $skp['skp'] = $request->input('skp');
        if (isset($skp['skp']['status']) && isset($skp['skp']['kondisi'])) {
            $skp = ConditionStatus::where('status', $skp['skp']['status'])->where('kondisi', $skp['skp']['kondisi'])->first('id');
        } else if(isset($skp['skp']['status']) || isset($skp['skp']['kondisi'])) {
            if (isset($skp['skp']['status']) && $skp['skp']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Sekop';
            }  else if(isset($skp['skp']['kondisi'])){
                $errors[] = 'Harap Isi Status Sekop';
        }
            else {
                $skp = ConditionStatus::where('status', $skp['skp']['status'])->first('id');
            }
        }  
          else{
                $errors[] ='Harap Isi Sekop';
            }

        $sli['sli'] = $request->input('sli');
        if (isset($sli['sli']['status']) && isset($sli['sli']['kondisi'])) {
            $sli = ConditionStatus::where('status', $sli['sli']['status'])->where('kondisi', $sli['sli']['kondisi'])->first('id');
        } else if(isset($sli['sli']['status']) || isset($sli['sli']['kondisi'])) {
            if (isset($sli['sli']['status']) && $sli['sli']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Sapu Lidi';
            }  else if(isset($sli['sli']['kondisi'])){
                $errors[] = 'Harap Isi Status Sapu Lidi';
        }
            else  {
                $sli = ConditionStatus::where('status', $sli['sli']['status'])->first('id');
            }
        }  
          else{
                $errors[] ='Harap Isi Sapu Lidi'; 
            }
            
        $kpt['kpt'] = $request->input('kpt');
        if(empty( $kpt['kpt'])){
            $errors[] = 'Harap Isi Keterangan Peralatan Tambahan' ;
        }
    

        $ec['ec'] = $request->input('ec');
        if (isset($ec['ec']['status']) && isset($ec['ec']['kondisi'])) {
            $ec = ConditionStatus::where('status', $ec['ec']['status'])->where('kondisi', $ec['ec']['kondisi'])->first('id');
        } else if(isset($ec['ec']['status']) || isset($ec['ec']['kondisi'])){
            if (isset($ec['ec']['status']) && $ec['ec']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Engine Condition';
            }  else if(isset($ec['ec']['kondisi'])){
                $errors[] = 'Harap Isi Status Engine Condition';
        }
            else {
                $ec = ConditionStatus::where('status', $ec['ec']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Engine Condition';          
              }

        $acu['acu'] = $request->input('acu');
        if (isset($acu['acu']['status']) && isset($acu['acu']['kondisi'])) {
            $acu = ConditionStatus::where('status', $acu['acu']['status'])->where('kondisi', $acu['acu']['kondisi'])->first('id');
        } else if (isset($acu['acu']['status']) || isset($acu['acu']['kondisi'])){
            if (isset($acu['acu']['status']) && $acu['acu']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Air Accu';
            }  else if(isset($acu['acu']['kondisi'])){
                $errors[] = 'Harap Isi Status Air Accu';
        }
            else  {
                $acu = ConditionStatus::where('status', $acu['acu']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Air Accu';
            }

        $arr['arr'] = $request->input('arr');
        if (isset($arr['arr']['status']) && isset($arr['arr']['kondisi'])) {
            $arr = ConditionStatus::where('status', $arr['arr']['status'])->where('kondisi', $arr['arr']['kondisi'])->first('id');
        } else if  (isset($arr['arr']['status']) || isset($arr['arr']['kondisi'])){
            if (isset($arr['arr']['status']) && $arr['arr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Air Radiator';
            }  else if(isset($arr['arr']['kondisi'])){
                $errors[] = 'Harap Isi Status Air Radiator';
        }
            else {
                $arr = ConditionStatus::where('status', $arr['arr']['status'])->first('id');
            }
        }  
          else{
                $errors[] = 'Harap Isi Air Radiator';            }

        $omn['omn'] = $request->input('omn');
        if (isset($omn['omn']['status']) && isset($omn['omn']['kondisi'])) {
            $omn = ConditionStatus::where('status', $omn['omn']['status'])->where('kondisi', $omn['omn']['kondisi'])->first('id');
        } else if(isset($omn['omn']['status']) || isset($omn['omn']['kondisi'])){
            if (isset($omn['omn']['status']) && $omn['omn']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Oli Mesin';
            }  else if(isset($omn['omn']['kondisi'])){
                $errors[] = 'Harap Isi Status Oli Mesin';
        }
            else  {
                $omn = ConditionStatus::where('status', $omn['omn']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Oli Mesin';
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
    

        $ski['ski'] = $request->input('ski');
        if (isset($ski['ski']['status']) && isset($ski['ski']['kondisi'])) {
            $ski = ConditionStatus::where('status', $ski['ski']['status'])->where('kondisi', $ski['ski']['kondisi'])->first('id');
        } else if (isset($ski['ski']['status']) || isset($ski['ski']['kondisi'])){
            if (isset($ski['ski']['status']) && $ski['ski']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Samping Kiri';
            }  else if(isset($ski['ski']['kondisi'])){
                $errors[] = 'Harap Isi Status Samping Kiri';
        }
            else  {
                $ski = ConditionStatus::where('status', $ski['ski']['status'])->first('id');
            }
        }  
        else{
                $errors[] = 'Harap Isi Samping Kiri';
            }

        $ska['ska'] = $request->input('ska');
        if (isset($ska['ska']['status']) && isset($ska['ska']['kondisi'])) {
            $ska = ConditionStatus::where('status', $ska['ska']['status'])->where('kondisi', $ska['ska']['kondisi'])->first('id');
        } else if (isset($ska['ska']['status']) || isset($ska['ska']['kondisi'])){
            if (isset($ska['ska']['status']) && $ska['ska']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Samping Kanan';
            }  else if(isset($ska['ska']['kondisi'])){
                $errors[] = 'Harap Isi Status Samping Kanan';
        }
            else {
                $ska = ConditionStatus::where('status', $ska['ska']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Samping Kanan';
            }

        $dpn['dpn'] = $request->input('dpn');
        if (isset($dpn['dpn']['status']) && isset($dpn['dpn']['kondisi'])) {
            $dpn = ConditionStatus::where('status', $dpn['dpn']['status'])->where('kondisi', $dpn['dpn']['kondisi'])->first('id');
        } else if(isset($dpn['dpn']['status']) || isset($dpn['dpn']['kondisi'])) {
            if (isset($dpn['dpn']['status']) && $dpn['dpn']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Depan';
            }  else if(isset($dpn['dpn']['kondisi'])){
                $errors[] = 'Harap Isi Status Depan';
        }
            else  {
                $dpn = ConditionStatus::where('status', $dpn['dpn']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Depan';
            }

        $blg['blg'] = $request->input('blg');
        if (isset($blg['blg']['status']) && isset($blg['blg']['kondisi'])) {
            $blg = ConditionStatus::where('status', $blg['blg']['status'])->where('kondisi', $blg['blg']['kondisi'])->first('id');
        } else if (isset($blg['blg']['status']) || isset($blg['blg']['kondisi'])) {
            if (isset($blg['blg']['status']) && $blg['blg']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Belakang';
            }  else if(isset($blg['blg']['kondisi'])){
                $errors[] = 'Harap Isi Status Belakang';
        }
            else  {
                $blg = ConditionStatus::where('status', $blg['blg']['status'])->first('id');
            }
        }  
          else{
                $errors[] = 'Harap Isi Belakang';
            }

        $ats['ats'] = $request->input('ats');
        if (isset($ats['ats']['status']) && isset($ats['ats']['kondisi'])) {
            $ats = ConditionStatus::where('status', $ats['ats']['status'])->where('kondisi', $ats['ats']['kondisi'])->first('id');
        } else if(isset($ats['ats']['status']) || isset($ats['ats']['kondisi'])) {
            if (isset($ats['ats']['status']) && $ats['ats']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Atas';
            }  else if(isset($ats['ats']['kondisi'])){
                $errors[] = 'Harap Isi Status Atas';
        }
            else {
                $ats = ConditionStatus::where('status', $ats['ats']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Atas';
            }
       
        $kbdc['kbdc'] = $request->input('kbdc');
        if(empty( $kbdc['kbdc'])){
            $errors[] = 'Harap Isi Keterangan Body dan Cat' ;
        }
    
        
        if (count($errors) > 0) {
            // If there are errors, redirect back with the input data and errors.
            return redirect()->back()->withInput()->withErrors($errors);
        }
        
        
        $today =Carbon::now(); 
        $date = $today->toDateString();
        $data = new PatroliVehicleLog;
        $data->unit = Auth::user()->nama.'-'.$date;
        $data->personil1 = (int)$request->personil1;
        $data->personil2 = (int)$request->personil2;
        $request->session()->put('personil1',$request->personil1);
        $request->session()->put('personil2',$request->personil2);
        $data->shift = $request->shift;
        $data->km_awal = $request->odo;
        $data->ban_kanan_depan = $bkad->id;
        $data->ban_kanan_belakang = $bkab->id;
        $data->ban_kiri_depan = $bkid->id;
        $data->ban_kiri_belakang = $bkib->id;
        $data->ban_serep = $bs->id;
        $data->velg_roda_drop = $vrd->id;
        $data->ket_roda_ban =$request->kbrdb;
        $data->stnk = $stnk->id;
        $data->lampu_dashboard = $ldb->id;
        $data->lampu_depan = $ldp->id;
        $data->lampu_belakang = $lbg->id;
        $data->lampu_rem = $lr->id;
        $data->lampu_sein = $lsn->id;
        $data->lampu_mundur = $lm->id;
        $data->radio_tape = $rt->id;
        $data->air_conditioner = $ac->id;
        $data->sandaran_kepala = $sk->id;
        $data->karpet  = $kp->id;
        $data->sarung_jok = $sj->id;
        $data->klakson = $kl->id;
        $data->wiper = $wp->id;
        $data->speaker = $spr->id;
        $data->power_window = $pw->id;
        $data->seat_belt = $sb->id;
        $data->	ket_bagian_dalam = $request->kbd;;
        $data->kunci_roda = $kr->id;
        $data->dongkrak = $dr->id;
        $data->p3k = $p3k->id;
        $data->ket_peralatan = $request->kpr;
        $data->public_adress = $pa->id;
        $data->lampu_strobo = $lsb->id;
        $data->lampu_sorot  = $lpsr->id;
        $data->apar  = $apar->id;
        $data->rubber_cone = $rc->id;
        $data->rambu_tanda_seru =$rts->id ;
        $data->rambu_petunjuk_arah  = $rpa->id;
        $data->bendera  = $flg->id;
        $data->oil_absorbent = $oat->id;
        $data->senter_charger = $scr->id;
        $data->sepatu_boat = $sbt->id;
        $data->jas_hujan = $jhn->id;
        $data->senter_lalin = $sln->id;
        $data->safety_glasess = $sgls->id;
        $data->helm = $hlm->id;
        $data->safety_gloves = $sgvs->id;
        $data->sekop = $skp->id;
        $data->sapu_lidi = $sli->id;
        $data->ket_peralatan_tambahan = $request->kpt;
        $data->engine_condition  = $ec->id;
        $data->air_accu = $acu->id;
        $data->air_radiator = $arr->id;
        $data->oli_mesin = $omn->id;
        $data->minyak_rem = $mr->id;
        $data->oil_power_steering = $ops->id;
        $data->ket_engine = $request->keeng;
        $data->samping_kiri = $ski->id;
        $data->samping_kanan = $ska->id;
        $data->depan = $dpn->id;
        $data->belakang = $blg->id;
        $data->atas = $ats->id;
        $data->ket_body_cat = $request->kbdc;
        // dd($data);
        $data->save();
        // dd($data);
        Session::flash('message', Lang::get('Data Berhasil Masuk'));
        return redirect()->route('dashboard-lalin.index');
    }

     public function edit($id){
        $datas = PatroliVehicleLog::where('id', $id)->first();
        $p1 = Officer::where('id', $datas->personil1)->first();
        $p2 = Officer::where('id', $datas->personil2)->first();
        $categories = Category::where('operasional_id', 1)->get();
        return view('pages.patroli.log-kelengkapan-kendaraan.edit')->with(compact('datas', 'p1','p2','categories'));
    }
       public function export($id)
    {
        try {
            $cek = PatroliVehicleLog::where('id',$id)
            ->first();

        if ($cek) {
            $date = $cek->created_at;
        }
            if(Auth::user()->operasional_id==10){
              $data = PatroliVehicleLog::whereBetween('shift', [1, 3])->where('unit',$cek->unit)->whereDate('created_at', $date)
             ->get()
            ->toArray();
            }
            else{
                $data = PatroliVehicleLog::whereBetween('shift', [1, 3])->where('unit', $cek->unit)
                ->whereDate('created_at', $date)
                ->get()
                ->toArray();
            }
            // dd(count($data));

                // dd($data);
        } catch (\Exception $errors) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['message' => Lang::get('Data Not Found')]);
        }

        // dd($data['no_mutasi']);
        $pdf = Pdf::loadView('pdf.pemeriksaan-kendaraan-patroli', compact('data'));

        return $pdf->stream('Log Kelengkapan Patroli' . '.pdf');
    }
    public function update(Request $request,$id){


        $errors = array();
       
            $personil1['personil1'] = $request->input('personil1');
            if(empty( $personil1['personil1'])){
                $errors[] = 'Harap Isi Personil 1' ;
            }
    
            $personil2['personil2'] = $request->input('personil2');
            if(empty( $personil2['personil2'])){
                $errors[] = 'Harap Isi Personil 2' ;
            }
    
            $odo['odo'] = $request->input('odo');
            if(empty( $odo['odo'])){
                $errors[] = 'Harap Isi Odo Meter' ;
            }
    
            $bkad['bkad'] = $request->input('bkad');
            // dd(count($bkad['bkad']));
            if (isset($bkad['bkad']['status']) && isset($bkad['bkad']['kondisi'])) {
                $bkad = ConditionStatus::where('status', $bkad['bkad']['status'])->where('kondisi', $bkad['bkad']['kondisi'])->first('id');
            } elseif(isset($bkad['bkad']['status']) || isset($bkad['bkad']['kondisi'])){
                if (isset($bkad['bkad']['status']) && $bkad['bkad']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Ban Kanan Depan';
                }else if (isset($bkad['bkad']['kondisi']) && $bkad['bkad']['kondisi'] == 1){
                    $errors[] = 'Harap Isi Status Ban Kanan Depan';
                } 
                else {
                    $bkad = ConditionStatus::where('status', $bkad['bkad']['status'])->first('id');
                }
            }
            else{
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
    
            $vrd['vrd'] = $request->input('vrd');
            if (isset($vrd['vrd']['status']) && isset($vrd['vrd']['kondisi'])) {
                $vrd = ConditionStatus::where('status', $vrd['vrd']['status'])->where('kondisi', $vrd['vrd']['kondisi'])->first('id');
            } else if(isset($vrd['vrd']['status']) || isset($vrd['vrd']['kondisi'])) {
                if (isset($vrd['vrd']['status']) && $vrd['vrd']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Velg Roda & Drop';
                }  else if(isset($vrd['vrd']['kondisi'])){
                    $errors[] = 'Harap Isi Status Velg Roda & Drop';
                }
                else {
                    $vrd = ConditionStatus::where('status', $vrd['vrd']['status'])->first('id');
                }
            } 
              else{
                    $errors[] = 'Harap Isi Velg Roda & Drop';
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
            $ldb['ldb'] = $request->input('ldb');
            if (isset($ldb['ldb']['status']) && isset($ldb['ldb']['kondisi'])) {
                $ldb = ConditionStatus::where('status', $ldb['ldb']['status'])->where('kondisi', $ldb['ldb']['kondisi'])->first('id');
            } else if(isset($ldb['ldb']['status']) || isset($ldb['ldb']['kondisi'])) {
                if (isset($ldb['ldb']['status']) && $ldb['ldb']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Lampu Dashboard';
                }  else if(isset($ldb['ldb']['kondisi'])){
                    $errors[] = 'Harap Isi Status Lampu Dashboard';
                }
                else {
                    $ldb = ConditionStatus::where('status', $ldb['ldb']['status'])->first('id');
                }
            } 
             else{
                    $errors[] = 'Harap Isi Lampu Dashboard';
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
    
            $rt['rt'] = $request->input('rt');
            if (isset($rt['rt']['status']) && isset($rt['rt']['kondisi'])) {
                $rt = ConditionStatus::where('status', $rt['rt']['status'])->where('kondisi', $rt['rt']['kondisi'])->first('id');
            } else if(isset($rt['rt']['status']) || isset($rt['rt']['kondisi'])) {
                if (isset($rt['rt']['status']) && $rt['rt']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Radio/Tape';
                }  else if(isset($rt['rt']['kondisi'])){
                    $errors[] = 'Harap Isi Status Radio/Tape';
            }
                else  {
                    $rt = ConditionStatus::where('status', $rt['rt']['status'])->first('id');
                }
            }  
             else{
                    $errors[] = 'Harap Isi Radio/Tape';
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
    
            $sk['sk'] = $request->input('sk');
            if (isset($sk['sk']['status']) && isset($sk['sk']['kondisi'])) {
                $sk = ConditionStatus::where('status', $sk['sk']['status'])->where('kondisi', $sk['sk']['kondisi'])->first('id');
            } else if (isset($sk['sk']['status']) || isset($sk['sk']['kondisi'])){
                if (isset($sk['sk']['status']) && $sk['sk']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Sandaran Kepala';
                }  else if(isset($sk['sk']['kondisi'])){
                    $errors[] = 'Harap Isi Status Sandaran Kepala';
            }
                else {
                    $sk = ConditionStatus::where('status', $sk['sk']['status'])->first('id');
                }
            }  
               else{
                    $errors[] ='Harap Isi Sandaran Kepala';
                }
    
            $kp['kp'] = $request->input('kp');
            if (isset($kp['kp']['status']) && isset($kp['kp']['kondisi'])) {
                $kp = ConditionStatus::where('status', $kp['kp']['status'])->where('kondisi', $kp['kp']['kondisi'])->first('id');
            } else if(isset($kp['kp']['status']) || isset($kp['kp']['kondisi'])) {
                if (isset($kp['kp']['status']) && $kp['kp']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Karpet';
                }  else if(isset($kp['kp']['kondisi'])){
                    $errors[] = 'Harap Isi Status Karpet';
            }
                else {
                    $kp = ConditionStatus::where('status', $kp['kp']['status'])->first('id');
                }
            }  
            else{
                    $errors[] = 'Harap Isi Karpet';
                }
    
            $sj['sj'] = $request->input('sj');
            if (isset($sj['sj']['status']) && isset($sj['sj']['kondisi'])) {
                $sj = ConditionStatus::where('status', $sj['sj']['status'])->where('kondisi', $sj['sj']['kondisi'])->first('id');
            } else if (isset($sj['sj']['status']) || isset($sj['sj']['kondisi'])) {
                if (isset($sj['sj']['status']) && $sj['sj']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Sarung Jok';
                }  else if(isset($sj['sj']['kondisi'])){
                    $errors[] = 'Harap Isi Status Sarung Jok';
            }
                else {
                    $sj = ConditionStatus::where('status', $sj['sj']['status'])->first('id');
                }
            } 
              else{
                    $errors[] ='Harap Isi Sarung Jok';
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
    
            $wp['wp'] = $request->input('wp');
            if (isset($wp['wp']['status']) && isset($wp['wp']['kondisi'])) {
                $wp = ConditionStatus::where('status', $wp['wp']['status'])->where('kondisi', $wp['wp']['kondisi'])->first('id');
            } else if (isset($wp['wp']['status']) || isset($wp['wp']['kondisi'])) {
                if (isset($wp['wp']['status']) && $wp['wp']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Wiper';
                }  else if(isset($wp['wp']['kondisi'])){
                    $errors[] = 'Harap Isi Status Wiper';
            }
                else  {
                    $wp = ConditionStatus::where('status', $wp['wp']['status'])->first('id');
                }  
            } 
             else{
                    $errors[] ='Harap Isi Wiper';
                }
    
            $spr['spr'] = $request->input('spr');
            if (isset($spr['spr']['status']) && isset($spr['spr']['kondisi'])) {
                $spr = ConditionStatus::where('status', $spr['spr']['status'])->where('kondisi', $spr['spr']['kondisi'])->first('id');
            } else if(isset($spr['spr']['status']) || isset($spr['spr']['kondisi'])) {
                if (isset($spr['spr']['status']) && $spr['spr']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Speaker';
                }  else if(isset($spr['spr']['kondisi'])){
                    $errors[] = 'Harap Isi Status Speaker';
            }
                else  {
                    $spr = ConditionStatus::where('status', $spr['spr']['status'])->first('id');
                }
            }  
             else{
                    $errors[] ='Harap Isi Speaker';
                }
    
            $pw['pw'] = $request->input('pw');
            if (isset($pw['pw']['status']) && isset($pw['pw']['kondisi'])) {
                $pw = ConditionStatus::where('status', $pw['pw']['status'])->where('kondisi', $pw['pw']['kondisi'])->first('id');
            } else if (isset($pw['pw']['status']) || isset($pw['pw']['kondisi'])) {
                if (isset($pw['pw']['status']) && $pw['pw']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Power Window';
                }  else if(isset($pw['pw']['kondisi'])){
                    $errors[] = 'Harap Isi Status Power Window';
            }
                else {
                    $pw = ConditionStatus::where('status', $pw['pw']['status'])->first('id');
                } 
            }  
             else{
                    $errors[] = 'Harap Isi Power Window';
                }
    
            $sb['sb'] = $request->input('sb');
            if (isset($sb['sb']['status']) && isset($sb['sb']['kondisi'])) {
                $sb = ConditionStatus::where('status', $sb['sb']['status'])->where('kondisi', $sb['sb']['kondisi'])->first('id');
            } else if (isset($sb['sb']['status']) || isset($sb['sb']['kondisi']))  {
                if (isset($sb['sb']['status']) && $sb['sb']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Seat Belt';
                }  else if(isset($sb['sb']['kondisi'])){
                    $errors[] = 'Harap Isi Status Seat Belt';
            }
                else  {
                    $sb = ConditionStatus::where('status', $sb['sb']['status'])->first('id');
                }
            }  
               else{
                    $errors[] = 'Harap Isi Seat Belt';
                }
    
                
            $kbd['kbd'] = $request->input('kbd');
            if(empty( $kbd['kbd'])){
                $errors[] = 'Harap Isi Keterangan Bagian Dalam' ;
            }
        
            $kr['kr'] = $request->input('kr');
            if (isset($kr['kr']['status']) && isset($kr['kr']['kondisi'])) {
                $kr = ConditionStatus::where('status', $kr['kr']['status'])->where('kondisi', $kr['kr']['kondisi'])->first('id');
            } else if(isset($kr['kr']['status']) || isset($kr['kr']['kondisi'])) {
                if (isset($kr['kr']['status']) && $kr['kr']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Kunci Roda';
                }  else if(isset($kr['kr']['kondisi'])){
                    $errors[] = 'Harap Isi Status Kunci Roda';
            }
                else   {
                    $kr = ConditionStatus::where('status', $kr['kr']['status'])->first('id');
                }
            }  
             else{
                    $errors[] ='Harap Isi Kunci Roda';
                }
    
            $dr['dr'] = $request->input('dr');
            if (isset($dr['dr']['status']) && isset($dr['dr']['kondisi'])) {
                $dr = ConditionStatus::where('status', $dr['dr']['status'])->where('kondisi', $dr['dr']['kondisi'])->first('id');
            } else if (isset($dr['dr']['status']) || isset($dr['dr']['kondisi'])){
                if (isset($dr['dr']['status']) && $dr['dr']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Dongkrak';
                }  else if(isset($dr['dr']['kondisi'])){
                    $errors[] = 'Harap Isi Status Dongkrak';
            }
                else {
                    $dr = ConditionStatus::where('status', $dr['dr']['status'])->first('id');
                }
            } 
              else{
                    $errors[] = 'Harap Isi Dongkrak';
                }
    
            $p3k['p3k'] = $request->input('p3k');
            if (isset($p3k['p3k']['status']) && isset($p3k['p3k']['kondisi'])) {
                $p3k = ConditionStatus::where('status', $p3k['p3k']['status'])->where('kondisi', $p3k['p3k']['kondisi'])->first('id');
            } else if(isset($p3k['p3k']['status']) || isset($p3k['p3k']['kondisi'])) {
                if (isset($p3k['p3k']['status']) && $p3k['p3k']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi P3K';
                }  else if(isset($p3k['p3k']['kondisi'])){
                    $errors[] = 'Harap Isi Status P3K';
            }
                else {
                    $p3k = ConditionStatus::where('status', $p3k['p3k']['status'])->first('id');
                }
            }  
               else{
                    $errors[] = 'Harap Isi P3K';
                }
    
                
            $kpr['kpr'] = $request->input('kpr');
            if(empty( $kpr['kpr'])){
                $errors[] = 'Harap Isi Keterangan Peralatan' ;
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
    
            $lsb['lsb'] = $request->input('lsb');
            if (isset($lsb['lsb']['status']) && isset($lsb['lsb']['kondisi'])) {
                $lsb = ConditionStatus::where('status', $lsb['lsb']['status'])->where('kondisi', $lsb['lsb']['kondisi'])->first('id');
            } else if (isset($lsb['lsb']['status']) || isset($lsb['lsb']['kondisi'])){
                if (isset($lsb['lsb']['status']) && $lsb['lsb']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Lampu Strobo (Rotary)';
                }  else if(isset($lsb['lsb']['kondisi'])){
                    $errors[] = 'Harap Isi Status Lampu Strobo (Rotary)';
            }
                else {
                    $lsb = ConditionStatus::where('status', $lsb['lsb']['status'])->first('id');
                }
            }  
             else{
                    $errors[] ='Harap Isi Lampu Strobo (Rotary)';
                }
    
            $apar['apar'] = $request->input('apar');
            if (isset($apar['apar']['status']) && isset($apar['apar']['kondisi'])) {
                $apar = ConditionStatus::where('status', $apar['apar']['status'])->where('kondisi', $apar['apar']['kondisi'])->first('id');
            } else if(isset($apar['apar']['status']) || isset($apar['apar']['kondisi'])){
                if (isset($apar['apar']['status']) && $apar['apar']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi APAR';
                }  else if(isset($apar['apar']['kondisi'])){
                    $errors[] = 'Harap Isi Status APAR';
            }
                else{
                    $apar = ConditionStatus::where('status', $apar['apar']['status'])->first('id');
                }
            }  
             else{
                    $errors[] ='Harap Isi APAR';
                }
    
            $lpsr['lpsr'] = $request->input('lpsr');
            if (isset($lpsr['lpsr']['status']) && isset($lpsr['lpsr']['kondisi'])) {
                $lpsr = ConditionStatus::where('status', $lpsr['lpsr']['status'])->where('kondisi', $lpsr['lpsr']['kondisi'])->first('id');
            } else if  (isset($lpsr['lpsr']['status']) || isset($lpsr['lpsr']['kondisi'])) {
                if (isset($lpsr['lpsr']['status']) && $lpsr['lpsr']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Lampu Sorot';
                }  else if(isset($lpsr['lpsr']['kondisi'])){
                    $errors[] = 'Harap Isi Status Lampu Sorot';
            }
                else {
                    $lpsr = ConditionStatus::where('status', $lpsr['lpsr']['status'])->first('id');
                }
            } 
             else{
                    $errors[] = 'Harap Isi Lampu Sorot';
                }
    
            $rc['rc'] = $request->input('rc');
            if (isset($rc['rc']['status']) && isset($rc['rc']['kondisi'])) {
                $rc = ConditionStatus::where('status', $rc['rc']['status'])->where('kondisi', $rc['rc']['kondisi'])->first('id');
            } else if(isset($rc['rc']['status']) || isset($rc['rc']['kondisi'])) {
                if (isset($rc['rc']['status']) && $rc['rc']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Rubber Cone';
                }  else if(isset($rc['rc']['kondisi'])){
                    $errors[] = 'Harap Isi Status Rubber Cone';
            }
                else   {
                    $rc = ConditionStatus::where('status', $rc['rc']['status'])->first('id');
                }
            }  
               else{
                    $errors[] = 'Harap Isi Rubber Cone';
                }
    
            $rts['rts'] = $request->input('rts');
            if (isset($rts['rts']['status']) && isset($rts['rts']['kondisi'])) {
                $rts = ConditionStatus::where('status', $rts['rts']['status'])->where('kondisi', $rts['rts']['kondisi'])->first('id');
            } else if(isset($rts['rts']['status']) || isset($rts['rts']['kondisi'])){
                if (isset($rts['rts']['status']) && $rts['rts']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Rambu Tanda Seru';
                }  else if(isset($rts['rts']['kondisi'])){
                    $errors[] = 'Harap Isi Status Rambu Tanda Seru';
            }
                else {
                    $rts = ConditionStatus::where('status', $rts['rts']['status'])->first('id');
                }
            }  
             else{
                    $errors[] = 'Harap Isi Rambu Tanda Seru';
                }
    
            $rpa['rpa'] = $request->input('rpa');
            if (isset($rpa['rpa']['status']) && isset($rpa['rpa']['kondisi'])) {
                $rpa = ConditionStatus::where('status', $rpa['rpa']['status'])->where('kondisi', $rpa['rpa']['kondisi'])->first('id');
            } else if(isset($rpa['rpa']['status']) || isset($rpa['rpa']['kondisi'])){
                if (isset($rpa['rpa']['status']) && $rpa['rpa']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Rambu Petunjuk Arah';
                }  else if(isset($rpa['rpa']['kondisi'])){
                    $errors[] = 'Harap Isi Status Rambu Petunjuk Arah';
            }
                else{
                    $rpa = ConditionStatus::where('status', $rpa['rpa']['status'])->first('id');
                }
            }  
              else{
                    $errors[] = 'Harap Isi Rambu Petunjuk Arah' ;
                }
    
            $flg['flg'] = $request->input('flg');
            if (isset($flg['flg']['status']) && isset($flg['flg']['kondisi'])) {
                $flg = ConditionStatus::where('status', $flg['flg']['status'])->where('kondisi', $flg['flg']['kondisi'])->first('id');
            } else if(isset($flg['flg']['status']) || isset($flg['flg']['kondisi'])){
                if (isset($flg['flg']['status']) && $flg['flg']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Flag (Bendera)';
                }  else if(isset($flg['flg']['kondisi'])){
                    $errors[] = 'Harap Isi Status Flag (Bendera)';
            }
                else   {
                    $flg = ConditionStatus::where('status', $flg['flg']['status'])->first('id');
                }
            }  
               else{
                    $errors[] = 'Harap Isi Flag (Bendera)';
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
                else   {
                    $oat = ConditionStatus::where('status', $oat['oat']['status'])->first('id');
                }
            }  
             else{
                    $errors[] = 'Harap Isi Oil Absorbent';
                }
    
            $scr['scr'] = $request->input('scr');
            if (isset($scr['scr']['status']) && isset($scr['scr']['kondisi'])) {
                $scr = ConditionStatus::where('status', $scr['scr']['status'])->where('kondisi', $scr['scr']['kondisi'])->first('id');
            } else if (isset($scr['scr']['status']) || isset($scr['scr']['kondisi']))  {
                if (isset($scr['scr']['status']) && $scr['scr']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Senter Charger';
                }  else if(isset($scr['scr']['kondisi'])){
                    $errors[] = 'Harap Isi Status Senter Charger';
            }
                else  {
                    $scr = ConditionStatus::where('status', $scr['scr']['status'])->first('id');
                }
            }  
             else{
                    $errors[] = 'Harap Isi Senter Charger';
                }
    
            $sbt['sbt'] = $request->input('sbt');
            if (isset($sbt['sbt']['status']) && isset($sbt['sbt']['kondisi'])) {
                $sbt = ConditionStatus::where('status', $sbt['sbt']['status'])->where('kondisi', $sbt['sbt']['kondisi'])->first('id');
            } else if(isset($sbt['sbt']['status']) || isset($sbt['sbt']['kondisi'])) {
                if (isset($sbt['sbt']['status']) && $sbt['sbt']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Sepatu Boat';
                }  else if(isset($sbt['sbt']['kondisi'])){
                    $errors[] = 'Harap Isi Status Sepatu Boat';
            }
                else  {
                    $sbt = ConditionStatus::where('status', $sbt['sbt']['status'])->first('id');
                }
            }  
             else{
                    $errors[] = 'Harap Isi Sepatu Boat';
                }
    
            $jhn['jhn'] = $request->input('jhn');
            if (isset($jhn['jhn']['status']) && isset($jhn['jhn']['kondisi'])) {
                $jhn = ConditionStatus::where('status', $jhn['jhn']['status'])->where('kondisi', $jhn['jhn']['kondisi'])->first('id');
            } else if(isset($jhn['jhn']['status']) || isset($jhn['jhn']['kondisi'])){
                if (isset($jhn['jhn']['status']) && $jhn['jhn']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Jas Hujan';
                }  else if(isset($jhn['jhn']['kondisi'])){
                    $errors[] = 'Harap Isi Status Jas Hujan';
            }
                else{
                    $jhn = ConditionStatus::where('status', $jhn['jhn']['status'])->first('id');
                }
            }  
              else{
                    $errors[] ='Harap Isi Jas Hujan';
                }
    
            $sln['sln'] = $request->input('sln');
            if (isset($sln['sln']['status']) && isset($sln['sln']['kondisi'])) {
                $sln = ConditionStatus::where('status', $sln['sln']['status'])->where('kondisi', $sln['sln']['kondisi'])->first('id');
            } else if(isset($sln['sln']['status']) || isset($sln['sln']['kondisi'])){
                if (isset($sln['sln']['status']) && $sln['sln']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Senter Lalin';
                }  else if(isset($sln['sln']['kondisi'])){
                    $errors[] = 'Harap Isi Status Senter Lalin';
            }
                else  {
                    $sln = ConditionStatus::where('status', $sln['sln']['status'])->first('id');
                }
            }  
              else{
                    $errors[] = 'Harap Isi Senter Lalin';
                }
    
            $sgls['sgls'] = $request->input('sgls');
            if (isset($sgls['sgls']['status']) && isset($sgls['sgls']['kondisi'])) {
                $sgls = ConditionStatus::where('status', $sgls['sgls']['status'])->where('kondisi', $sgls['sgls']['kondisi'])->first('id');
            } else if (isset($sgls['sgls']['status']) || isset($sgls['sgls']['kondisi'])) {
                if (isset($sgls['sgls']['status']) && $sgls['sgls']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Safety Glasses';
                }  else if(isset($sgls['sgls']['kondisi'])){
                    $errors[] = 'Harap Isi Status Safety Glasses';
            }
                else {
                    $sgls = ConditionStatus::where('status', $sgls['sgls']['status'])->first('id');
                }
            }  
             else{
                    $errors[] ='Harap Isi Safety Glasses';
                }
    
            $hlm['hlm'] = $request->input('hlm');
            if (isset($hlm['hlm']['status']) && isset($hlm['hlm']['kondisi'])) {
                $hlm = ConditionStatus::where('status', $hlm['hlm']['status'])->where('kondisi', $hlm['hlm']['kondisi'])->first('id');
            } else if(isset($hlm['hlm']['status']) || isset($hlm['hlm']['kondisi']))  {
                if (isset($hlm['hlm']['status']) && $hlm['hlm']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Helm';
                }  else if(isset($hlm['hlm']['kondisi'])){
                    $errors[] = 'Harap Isi Status Helm';
            }
                else  {
                    $hlm = ConditionStatus::where('status', $hlm['hlm']['status'])->first('id');
                }
            }  
            else{
                    $errors[] ='Harap Isi Helm';
                }
    
            $sgvs['sgvs'] = $request->input('sgvs');
            if (isset($sgvs['sgvs']['status']) && isset($sgvs['sgvs']['kondisi'])) {
                $sgvs = ConditionStatus::where('status', $sgvs['sgvs']['status'])->where('kondisi', $sgvs['sgvs']['kondisi'])->first('id');
            } else if(isset($sgvs['sgvs']['status']) || isset($sgvs['sgvs']['kondisi']))  {
                if (isset($sgvs['sgvs']['status']) && $sgvs['sgvs']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Safety Gloves';
                }  else if(isset($sgvs['sgvs']['kondisi'])){
                    $errors[] = 'Harap Isi Status Safety Gloves';
            }
                else {
                    $sgvs = ConditionStatus::where('status', $sgvs['sgvs']['status'])->first('id');
                }
            }  
               else{
                    $errors[] = 'Harap Isi Safety Gloves';
                }
    
            $skp['skp'] = $request->input('skp');
            if (isset($skp['skp']['status']) && isset($skp['skp']['kondisi'])) {
                $skp = ConditionStatus::where('status', $skp['skp']['status'])->where('kondisi', $skp['skp']['kondisi'])->first('id');
            } else if(isset($skp['skp']['status']) || isset($skp['skp']['kondisi'])) {
                if (isset($skp['skp']['status']) && $skp['skp']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Sekop';
                }  else if(isset($skp['skp']['kondisi'])){
                    $errors[] = 'Harap Isi Status Sekop';
            }
                else {
                    $skp = ConditionStatus::where('status', $skp['skp']['status'])->first('id');
                }
            }  
              else{
                    $errors[] ='Harap Isi Sekop';
                }
    
            $sli['sli'] = $request->input('sli');
            if (isset($sli['sli']['status']) && isset($sli['sli']['kondisi'])) {
                $sli = ConditionStatus::where('status', $sli['sli']['status'])->where('kondisi', $sli['sli']['kondisi'])->first('id');
            } else if(isset($sli['sli']['status']) || isset($sli['sli']['kondisi'])) {
                if (isset($sli['sli']['status']) && $sli['sli']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Sapu Lidi';
                }  else if(isset($sli['sli']['kondisi'])){
                    $errors[] = 'Harap Isi Status Sapu Lidi';
            }
                else  {
                    $sli = ConditionStatus::where('status', $sli['sli']['status'])->first('id');
                }
            }  
              else{
                    $errors[] ='Harap Isi Sapu Lidi'; 
                }
                
            $kpt['kpt'] = $request->input('kpt');
            if(empty( $kpt['kpt'])){
                $errors[] = 'Harap Isi Keterangan Peralatan Tambahan' ;
            }
        
    
            $ec['ec'] = $request->input('ec');
            if (isset($ec['ec']['status']) && isset($ec['ec']['kondisi'])) {
                $ec = ConditionStatus::where('status', $ec['ec']['status'])->where('kondisi', $ec['ec']['kondisi'])->first('id');
            } else if(isset($ec['ec']['status']) || isset($ec['ec']['kondisi'])){
                if (isset($ec['ec']['status']) && $ec['ec']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Engine Condition';
                }  else if(isset($ec['ec']['kondisi'])){
                    $errors[] = 'Harap Isi Status Engine Condition';
            }
                else {
                    $ec = ConditionStatus::where('status', $ec['ec']['status'])->first('id');
                }
            }  
             else{
                    $errors[] = 'Harap Isi Engine Condition';          
                  }
    
            $acu['acu'] = $request->input('acu');
            if (isset($acu['acu']['status']) && isset($acu['acu']['kondisi'])) {
                $acu = ConditionStatus::where('status', $acu['acu']['status'])->where('kondisi', $acu['acu']['kondisi'])->first('id');
            } else if (isset($acu['acu']['status']) || isset($acu['acu']['kondisi'])){
                if (isset($acu['acu']['status']) && $acu['acu']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Air Accu';
                }  else if(isset($acu['acu']['kondisi'])){
                    $errors[] = 'Harap Isi Status Air Accu';
            }
                else  {
                    $acu = ConditionStatus::where('status', $acu['acu']['status'])->first('id');
                }
            }  
             else{
                    $errors[] = 'Harap Isi Air Accu';
                }
    
            $arr['arr'] = $request->input('arr');
            if (isset($arr['arr']['status']) && isset($arr['arr']['kondisi'])) {
                $arr = ConditionStatus::where('status', $arr['arr']['status'])->where('kondisi', $arr['arr']['kondisi'])->first('id');
            } else if  (isset($arr['arr']['status']) || isset($arr['arr']['kondisi'])){
                if (isset($arr['arr']['status']) && $arr['arr']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Air Radiator';
                }  else if(isset($arr['arr']['kondisi'])){
                    $errors[] = 'Harap Isi Status Air Radiator';
            }
                else {
                    $arr = ConditionStatus::where('status', $arr['arr']['status'])->first('id');
                }
            }  
              else{
                    $errors[] = 'Harap Isi Air Radiator';            }
    
            $omn['omn'] = $request->input('omn');
            if (isset($omn['omn']['status']) && isset($omn['omn']['kondisi'])) {
                $omn = ConditionStatus::where('status', $omn['omn']['status'])->where('kondisi', $omn['omn']['kondisi'])->first('id');
            } else if(isset($omn['omn']['status']) || isset($omn['omn']['kondisi'])){
                if (isset($omn['omn']['status']) && $omn['omn']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Oli Mesin';
                }  else if(isset($omn['omn']['kondisi'])){
                    $errors[] = 'Harap Isi Status Oli Mesin';
            }
                else  {
                    $omn = ConditionStatus::where('status', $omn['omn']['status'])->first('id');
                }
            }  
                else{
                    $errors[] = 'Harap Isi Oli Mesin';
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
        
    
            $ski['ski'] = $request->input('ski');
            if (isset($ski['ski']['status']) && isset($ski['ski']['kondisi'])) {
                $ski = ConditionStatus::where('status', $ski['ski']['status'])->where('kondisi', $ski['ski']['kondisi'])->first('id');
            } else if (isset($ski['ski']['status']) || isset($ski['ski']['kondisi'])){
                if (isset($ski['ski']['status']) && $ski['ski']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Samping Kiri';
                }  else if(isset($ski['ski']['kondisi'])){
                    $errors[] = 'Harap Isi Status Samping Kiri';
            }
                else  {
                    $ski = ConditionStatus::where('status', $ski['ski']['status'])->first('id');
                }
            }  
            else{
                    $errors[] = 'Harap Isi Samping Kiri';
                }
    
            $ska['ska'] = $request->input('ska');
            if (isset($ska['ska']['status']) && isset($ska['ska']['kondisi'])) {
                $ska = ConditionStatus::where('status', $ska['ska']['status'])->where('kondisi', $ska['ska']['kondisi'])->first('id');
            } else if (isset($ska['ska']['status']) || isset($ska['ska']['kondisi'])){
                if (isset($ska['ska']['status']) && $ska['ska']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Samping Kanan';
                }  else if(isset($ska['ska']['kondisi'])){
                    $errors[] = 'Harap Isi Status Samping Kanan';
            }
                else {
                    $ska = ConditionStatus::where('status', $ska['ska']['status'])->first('id');
                }
            }  
             else{
                    $errors[] = 'Harap Isi Samping Kanan';
                }
    
            $dpn['dpn'] = $request->input('dpn');
            if (isset($dpn['dpn']['status']) && isset($dpn['dpn']['kondisi'])) {
                $dpn = ConditionStatus::where('status', $dpn['dpn']['status'])->where('kondisi', $dpn['dpn']['kondisi'])->first('id');
            } else if(isset($dpn['dpn']['status']) || isset($dpn['dpn']['kondisi'])) {
                if (isset($dpn['dpn']['status']) && $dpn['dpn']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Depan';
                }  else if(isset($dpn['dpn']['kondisi'])){
                    $errors[] = 'Harap Isi Status Depan';
            }
                else  {
                    $dpn = ConditionStatus::where('status', $dpn['dpn']['status'])->first('id');
                }
            }  
             else{
                    $errors[] = 'Harap Isi Depan';
                }
    
            $blg['blg'] = $request->input('blg');
            if (isset($blg['blg']['status']) && isset($blg['blg']['kondisi'])) {
                $blg = ConditionStatus::where('status', $blg['blg']['status'])->where('kondisi', $blg['blg']['kondisi'])->first('id');
            } else if (isset($blg['blg']['status']) || isset($blg['blg']['kondisi'])) {
                if (isset($blg['blg']['status']) && $blg['blg']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Belakang';
                }  else if(isset($blg['blg']['kondisi'])){
                    $errors[] = 'Harap Isi Status Belakang';
            }
                else  {
                    $blg = ConditionStatus::where('status', $blg['blg']['status'])->first('id');
                }
            }  
              else{
                    $errors[] = 'Harap Isi Belakang';
                }
    
            $ats['ats'] = $request->input('ats');
            if (isset($ats['ats']['status']) && isset($ats['ats']['kondisi'])) {
                $ats = ConditionStatus::where('status', $ats['ats']['status'])->where('kondisi', $ats['ats']['kondisi'])->first('id');
            } else if(isset($ats['ats']['status']) || isset($ats['ats']['kondisi'])) {
                if (isset($ats['ats']['status']) && $ats['ats']['status'] == 1) {
                    $errors[] = 'Harap Isi Kondisi Atas';
                }  else if(isset($ats['ats']['kondisi'])){
                    $errors[] = 'Harap Isi Status Atas';
            }
                else {
                    $ats = ConditionStatus::where('status', $ats['ats']['status'])->first('id');
                }
            }  
             else{
                    $errors[] = 'Harap Isi Atas';
                }
           
            $kbdc['kbdc'] = $request->input('kbdc');
            if(empty( $kbdc['kbdc'])){
                $errors[] = 'Harap Isi Keterangan Body dan Cat' ;
            }
        
            
            if (count($errors) > 0) {
                // If there are errors, redirect back with the input data and errors.
                return redirect()->back()->withInput()->withErrors($errors);
            }
            
            
            
            $data = PatroliVehicleLog::find($id);
            // $data->unit = Auth::user()->nama;
            $data->personil1 = (int)$request->personil1;
            $data->personil2 = (int)$request->personil2;
            $request->session()->put('personil1',$request->personil1);
            $request->session()->put('personil2',$request->personil2);
            $data->shift = $request->shift;
            $data->km_awal = $request->odo;
            $data->ban_kanan_depan = $bkad->id;
            $data->ban_kanan_belakang = $bkab->id;
            $data->ban_kiri_depan = $bkid->id;
            $data->ban_kiri_belakang = $bkib->id;
            $data->ban_serep = $bs->id;
            $data->velg_roda_drop = $vrd->id;
            $data->ket_roda_ban =$request->kbrdb;
            $data->stnk = $stnk->id;
            $data->lampu_dashboard = $ldb->id;
            $data->lampu_depan = $ldp->id;
            $data->lampu_belakang = $lbg->id;
            $data->lampu_rem = $lr->id;
            $data->lampu_sein = $lsn->id;
            $data->lampu_mundur = $lm->id;
            $data->radio_tape = $rt->id;
            $data->air_conditioner = $ac->id;
            $data->sandaran_kepala = $sk->id;
            $data->karpet  = $kp->id;
            $data->sarung_jok = $sj->id;
            $data->klakson = $kl->id;
            $data->wiper = $wp->id;
            $data->speaker = $spr->id;
            $data->power_window = $pw->id;
            $data->seat_belt = $sb->id;
            $data->	ket_bagian_dalam = $request->kbd;;
            $data->kunci_roda = $kr->id;
            $data->dongkrak = $dr->id;
            $data->p3k = $p3k->id;
            $data->ket_peralatan = $request->kpr;
            $data->public_adress = $pa->id;
            $data->lampu_strobo = $lsb->id;
            $data->lampu_sorot  = $lpsr->id;
            $data->apar  = $apar->id;
            $data->rubber_cone = $rc->id;
            $data->rambu_tanda_seru =$rts->id ;
            $data->rambu_petunjuk_arah  = $rpa->id;
            $data->bendera  = $flg->id;
            $data->oil_absorbent = $oat->id;
            $data->senter_charger = $scr->id;
            $data->sepatu_boat = $sbt->id;
            $data->jas_hujan = $jhn->id;
            $data->senter_lalin = $sln->id;
            $data->safety_glasess = $sgls->id;
            $data->helm = $hlm->id;
            $data->safety_gloves = $sgvs->id;
            $data->sekop = $skp->id;
            $data->sapu_lidi = $sli->id;
            $data->ket_peralatan_tambahan = $request->kpt;
            $data->engine_condition  = $ec->id;
            $data->air_accu = $acu->id;
            $data->air_radiator = $arr->id;
            $data->oli_mesin = $omn->id;
            $data->minyak_rem = $mr->id;
            $data->oil_power_steering = $ops->id;
            $data->ket_engine = $request->keeng;
            $data->samping_kiri = $ski->id;
            $data->samping_kanan = $ska->id;
            $data->depan = $dpn->id;
            $data->belakang = $blg->id;
            $data->atas = $ats->id;
            $data->ket_body_cat = $request->kbdc;
            // dd($data);
            $data->save();
            
            Session::flash('message', Lang::get('Data Berhasil Diedit'));
            if(Auth::user()->operasional_id==7|| Auth::user()->operasional_id==8 || Auth::user()->operasional_id==9){
                return redirect()->route('koordinator.lapenam.ceklis');
            }
            elseif(Auth::user()->operasional_id==10){
                return redirect()->route('admin.lapenam.ceklis');
            }
           
            return redirect()->route('lapenam.ceklis');
        }
}

