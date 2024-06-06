<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ConditionStatus;
use App\Models\DerekBesarVehicleLog;
use App\Models\DerekKecilVehicleLog;
use App\Models\ActivityMutationServiceTol;
use App\Models\Officer;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Lang;
use Session;
use Validator;
use Auth;

class DerekController extends Controller
{
     public function index()
    {
        $id = 2;
        $time = Carbon::now();
       
        $today = $time->toDateString();
        $yesterday = $time->subDay()->toDateString();
        $tomorrow = $time->addDay(2)->toDateString();
        $hour = $time->hour;
        $minute = $time->minute;
        $startTime = Carbon::parse('06:30:00')->format('H:i:s');
        $startTimeLate = Carbon::parse('06:45:00')->format('H:i:s');
        $endTimeToday = Carbon::parse('23:59:59')->format('H:i:s');
        $endTimeTomorrow = Carbon::parse('06:30:00')->format('H:i:s');
        // dd($today,$yesterday,$tomorrow);
        
        if (($hour == 6 && $minute >= 46) || ($hour > 6 && $hour < 14) || ($hour == 14 && $minute <= 30)){
        $jumlah_mutasi = ActivityMutationServiceTol::where('no_mutasi', 'LIKE', Auth::user()->nama.'-%')
        ->where(function ($query) use ($today, $tomorrow, $startTimeLate, $endTimeToday, $endTimeTomorrow, $time) {
            $query->where(function ($q) use ($today, $startTimeLate, $endTimeToday, $time) {
                $q->whereDate('created_at', $today)
                  ->whereTime('created_at', '>=', $startTimeLate)
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
            $endTimeYesterday = Carbon::parse('06:45:00')->format('H:i:s');
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
        // dd($hour);
        $categories = Category::where('operasional_id', 2)->get();
        $datas = Officer::where('operasional_id', $id)->get();
        return view("pages.derek.log-kelengkapan-kendaraan.index")->with(compact('categories', 'datas', 'shift','jumlah_mutasi'));
        
    }
     public function store(Request $request){   
        $errors = array();
   
        $personil['personil'] = $request->input('personil');
        if(empty( $personil['personil'])){
            $errors[] = 'Harap Isi Personil' ;
        }

        $odo['odo'] = $request->input('odo');
        if(empty( $odo['odo'])){
            $errors[] = 'Harap Isi Odo Meter' ;
        }

        //derek kecil
        $bkad['bkad'] = $request->input('bkad');
        // dd(count($bkad['bkad']));
        if (isset($bkad['bkad']['status']) && isset($bkad['bkad']['kondisi'])) {
            $bkad = ConditionStatus::where('status', $bkad['bkad']['status'])->where('kondisi', $bkad['bkad']['kondisi'])->first('id');
        } 
        else if(isset($bkad['bkad']['status']) || isset($bkad['bkad']['kondisi'])) {
            if (isset($bkad['bkad']['status']) && $bkad['bkad']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Kanan Depan Derek Kecil';
            }else if (isset($bkad['bkad']['kondisi']) && $bkad['bkad']['kondisi'] == 1){
                $errors[] = 'Harap Isi Status Ban Kanan Depan Derek Kecil';
            } 
            else  {
        $bkad = ConditionStatus::where('status', $bkad['bkad']['status'])->first('id');
    }   
        }
          else {
        $errors[] = 'Harap Isi Ban Kanan Depan Derek Kecil';
        }  
        
        $bkab['bkab'] = $request->input('bkab');
        if (isset($bkab['bkab']['status']) && isset($bkab['bkab']['kondisi'])) {
            $bkab = ConditionStatus::where('status', $bkab['bkab']['status'])->where('kondisi', $bkab['bkab']['kondisi'])->first('id');
        } else if(isset($bkab['bkab']['status']) || isset($bkab['bkab']['kondisi'])) {
           if (isset($bkab['bkab']['status']) && $bkab['bkab']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Kanan Belakang Derek Kecil';
            }else if(isset($bkab['bkab']['kondisi']) && $bkab['bkab']['kondisi'] == 1){
                $errors[] = 'Harap Isi Status Ban Kanan Belakang Derek Kecil';
            } 
            else{
                $bkab = ConditionStatus::where('status', $bkab['bkab']['status'])->first('id');
            }
        }
             else {
        $errors[] = 'Harap Isi Ban Kanan Belakang Derek Kecil';
        }  

        $bkid['bkid'] = $request->input('bkid');
        if (isset($bkid['bkid']['status']) && isset($bkid['bkid']['kondisi'])) {
            $bkid = ConditionStatus::where('status', $bkid['bkid']['status'])->where('kondisi', $bkid['bkid']['kondisi'])->first('id');
        } else if (isset($bkid['bkid']['status']) || isset($bkid['bkid']['kondisi'])) {
            if (isset($bkid['bkid']['status']) && $bkid['bkid']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Kiri Depan Derek Kecil';
            }  else if(isset($bkid['bkid']['kondisi'])){
                $errors[] = 'Harap Isi Status Ban Kiri Depan Derek Kecil';
            }
            else   {
                $bkid = ConditionStatus::where('status', $bkid['bkid']['status'])->first('id');
            }
        } 
           else{
                $errors[] ='Harap Isi Ban Kiri Depan Derek Kecil';
            } 

        $bkib['bkib'] = $request->input('bkib');
        if (isset($bkib['bkib']['status']) && isset($bkib['bkib']['kondisi'])) {
            $bkib = ConditionStatus::where('status', $bkib['bkib']['status'])->where('kondisi', $bkib['bkib']['kondisi'])->first('id');
        } else if(isset($bkib['bkib']['status']) || isset($bkib['bkib']['kondisi'])){
            if (isset($bkib['bkib']['status']) && $bkib['bkib']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Kiri Belakang Derek Kecil';
            }  else if(isset($bkib['bkib']['kondisi'])){
                $errors[] = 'Harap Isi Status Ban Kiri Belakang Derek Kecil';
            }
            else {
                $bkib = ConditionStatus::where('status', $bkib['bkib']['status'])->first('id');
            }
        } 
         else{
                $errors[] = 'Harap Isi Ban Kiri Belakang Derek Kecil';
            } 

        $bs['bs'] = $request->input('bs');
        if (isset($bs['bs']['status']) && isset($bs['bs']['kondisi'])) {
            $bs = ConditionStatus::where('status', $bs['bs']['status'])->where('kondisi', $bs['bs']['kondisi'])->first('id');
        } else if (isset($bs['bs']['status']) || isset($bs['bs']['kondisi'])) {
            if (isset($bs['bs']['status']) && $bs['bs']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Serep Derek Keci';
            }  else if(isset($bs['bs']['kondisi'])){
                $errors[] = 'Harap Isi Status Ban Serep Derek Keci';
            }
            else  {
                $bs = ConditionStatus::where('status', $bs['bs']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Ban Serep Derek Keci';
            } 

        $vrd['vrd'] = $request->input('vrd');
        if (isset($vrd['vrd']['status']) && isset($vrd['vrd']['kondisi'])) {
            $vrd = ConditionStatus::where('status', $vrd['vrd']['status'])->where('kondisi', $vrd['vrd']['kondisi'])->first('id');
        } else if(isset($vrd['vrd']['status']) || isset($vrd['vrd']['kondisi'])) {
            if (isset($vrd['vrd']['status']) && $vrd['vrd']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Velg Roda & Drop Derek Kecil';
            }  else if(isset($vrd['vrd']['kondisi'])){
                $errors[] = 'Harap Isi Status Velg Roda & Drop Derek Kecil';
            }
            else {
                $vrd = ConditionStatus::where('status', $vrd['vrd']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Velg Roda & Drop Derek Kecil';
            } 

        $kbrdb['kbrdb'] = $request->input('kbrdb');
        if(empty( $kbrdb['kbrdb'])){
            $errors[] = 'Harap Isi Keterangan Roda dan Ban Derek Kecil' ;
        }
    

        $stnk['stnk'] = $request->input('stnk');
        if (isset($stnk['stnk']['status']) && isset($stnk['stnk']['kondisi'])) {
            $stnk = ConditionStatus::where('status', $stnk['stnk']['status'])->where('kondisi', $stnk['stnk']['kondisi'])->first('id');
        } else if (isset($stnk['stnk']['status']) || isset($stnk['stnk']['kondisi'])) {
            if (isset($stnk['stnk']['status']) && $stnk['stnk']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi STNK Derek Kecil';
            }  else if(isset($stnk['stnk']['kondisi'])){
                $errors[] = 'Harap Isi Status STNK Derek Kecil';
            }
            else  {
                $stnk = ConditionStatus::where('status', $stnk['stnk']['status'])->first('id');
            }
        } 
        else{
                $errors[] ='Harap Isi STNK Derek Kecil';
            } 

        $ldb['ldb'] = $request->input('ldb');
        if (isset($ldb['ldb']['status']) && isset($ldb['ldb']['kondisi'])) {
            $ldb = ConditionStatus::where('status', $ldb['ldb']['status'])->where('kondisi', $ldb['ldb']['kondisi'])->first('id');
        } else if(isset($ldb['ldb']['status']) || isset($ldb['ldb']['kondisi'])) {
            if (isset($ldb['ldb']['status']) && $ldb['ldb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Dashboard Derek Kecil';
            }  else if(isset($ldb['ldb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Dashboard Derek Kecil';
            }
            else {
                $ldb = ConditionStatus::where('status', $ldb['ldb']['status'])->first('id');
            }
        } 
         else{
                $errors[] = 'Harap Isi Lampu Dashboard Derek Kecil';
            } 
            
        $ldp['ldp'] = $request->input('ldp');
        if (isset($ldp['ldp']['status']) && isset($ldp['ldp']['kondisi'])) {
            $ldp = ConditionStatus::where('status', $ldp['ldp']['status'])->where('kondisi', $ldp['ldp']['kondisi'])->first('id');
        } else if(isset($ldp['ldp']['status']) || isset($ldp['ldp']['kondisi'])) {
            if (isset($ldp['ldp']['status']) && $ldp['ldp']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Depan Derek Kecil';
            }  else if(isset($ldp['ldp']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Depan Derek Kecil';
            }
            else {
                $ldp = ConditionStatus::where('status', $ldp['ldp']['status'])->first('id');
            }
        } 
            else{
                $errors[] = 'Harap Isi Lampu Depan Derek Kecil';
            }

        $lbg['lbg'] = $request->input('lbg');
        if (isset($lbg['lbg']['status']) && isset($lbg['lbg']['kondisi'])) {
            $lbg = ConditionStatus::where('status', $lbg['lbg']['status'])->where('kondisi', $lbg['lbg']['kondisi'])->first('id');
        } else if(isset($lbg['lbg']['status']) || isset($lbg['lbg']['kondisi'])) {
            if (isset($lbg['lbg']['status']) && $lbg['lbg']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Belakang Derek Kecil';
            }  else if(isset($lbg['lbg']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Belakang Derek Kecil';
            }
            else   {
                $lbg = ConditionStatus::where('status', $lbg['lbg']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Lampu Belakang Derek Kecil';
            }
        $lr['lr'] = $request->input('lr');

        if (isset($lr['lr']['status']) && isset($lr['lr']['kondisi'])) {
            $lr = ConditionStatus::where('status', $lr['lr']['status'])->where('kondisi', $lr['lr']['kondisi'])->first('id');
        } else if (isset($lr['lr']['status']) || isset($lr['lr']['kondisi'])){
            if (isset($lr['lr']['status']) && $lr['lr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Rem Derek Kecil';
            }  else if(isset($lr['lr']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Rem Derek Kecil';
        }
            else  {
                $lr = ConditionStatus::where('status', $lr['lr']['status'])->first('id');
            }
        }  
           else{
                $errors[] = 'Harap Isi Lampu Rem Derek Kecil';
            }

        $lsn['lsn'] = $request->input('lsn');
        if (isset($lsn['lsn']['status']) && isset($lsn['lsn']['kondisi'])) {
            $lsn = ConditionStatus::where('status', $lsn['lsn']['status'])->where('kondisi', $lsn['lsn']['kondisi'])->first('id');
        } else if(isset($lsn['lsn']['status']) || isset($lsn['lsn']['kondisi'])) {
            if (isset($lsn['lsn']['status']) && $lsn['lsn']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Sein Derek Kecil';
            }  else if(isset($lsn['lsn']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Sein Derek Kecil';
        }
            else  {
                $lsn = ConditionStatus::where('status', $lsn['lsn']['status'])->first('id');
            }
        } 
         else{
                $errors[] = 'Harap Isi Lampu Sein Derek Kecil';
            }

        $lm['lm'] = $request->input('lm');
        if (isset($lm['lm']['status']) && isset($lm['lm']['kondisi'])) {
            $lm = ConditionStatus::where('status', $lm['lm']['status'])->where('kondisi', $lm['lm']['kondisi'])->first('id');
        } else if (isset($lm['lm']['status']) || isset($lm['lm']['kondisi'])) {
            if (isset($lm['lm']['status']) && $lm['lm']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Mundur Derek Kecil';
            }  else if(isset($lm['lm']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Mundur Derek Kecil';
        }
            else  {
                $lm = ConditionStatus::where('status', $lm['lm']['status'])->first('id');
            }
        } 
          else{
                $errors[]= 'Harap Isi Lampu Mundur Derek Kecil';
            }

        $lk['lk'] = $request->input('lk');
        if (isset($lk['lk']['status']) && isset($lk['lk']['kondisi'])) {
            $lk = ConditionStatus::where('status', $lk['lk']['status'])->where('kondisi', $lk['lk']['kondisi'])->first('id');
        } else if (isset($lk['lk']['status']) || isset($lk['lk']['kondisi'])) {
            if (isset($lk['lk']['status']) && $lk['lk']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Kabut Derek Kecil';
            }  else if(isset($lk['lk']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Kabut Derek Kecil';
        }
            else  {
                $lk = ConditionStatus::where('status', $lk['lk']['status'])->first('id');
            }
        } 
          else{
                $errors[]= 'Harap Isi Lampu Kabut Derek Kecil';
            }

        $rt['rt'] = $request->input('rt');
        if (isset($rt['rt']['status']) && isset($rt['rt']['kondisi'])) {
            $rt = ConditionStatus::where('status', $rt['rt']['status'])->where('kondisi', $rt['rt']['kondisi'])->first('id');
        } else if(isset($rt['rt']['status']) || isset($rt['rt']['kondisi'])) {
            if (isset($rt['rt']['status']) && $rt['rt']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Radio/Tape Derek Kecil';
            }  else if(isset($rt['rt']['kondisi'])){
                $errors[] = 'Harap Isi Status Radio/Tape Derek Kecil';
        }
            else  {
                $rt = ConditionStatus::where('status', $rt['rt']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Radio/Tape Derek Kecil';
            }

            
        $kl['kl'] = $request->input('kl');
        if (isset($kl['kl']['status']) && isset($kl['kl']['kondisi'])) {
            $kl = ConditionStatus::where('status', $kl['kl']['status'])->where('kondisi', $kl['kl']['kondisi'])->first('id');
        } else if (isset($kl['kl']['status']) || isset($kl['kl']['kondisi'])){
            if (isset($kl['kl']['status']) && $kl['kl']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Klakson Derek Kecil';
            }  else if(isset($kl['kl']['kondisi'])){
                $errors[] = 'Harap Isi Status Klakson Derek Kecil';
        }
            else  {
                $kl = ConditionStatus::where('status', $kl['kl']['status'])->first('id');
            }
        }  
           else{
                $errors[] ='Harap Isi Klakson Derek Kecil';
            }

        $wp['wp'] = $request->input('wp');
        if (isset($wp['wp']['status']) && isset($wp['wp']['kondisi'])) {
            $wp = ConditionStatus::where('status', $wp['wp']['status'])->where('kondisi', $wp['wp']['kondisi'])->first('id');
        } else if (isset($wp['wp']['status']) || isset($wp['wp']['kondisi'])) {
            if (isset($wp['wp']['status']) && $wp['wp']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Wiper Derek Kecil';
            }  else if(isset($wp['wp']['kondisi'])){
                $errors[] = 'Harap Isi Status Wiper Derek Kecil';
        }
            else  {
                $wp = ConditionStatus::where('status', $wp['wp']['status'])->first('id');
            }  
        } 
         else{
                $errors[] ='Harap Isi Wiper Derek Kecil';
            }

        $spr['spr'] = $request->input('spr');
        if (isset($spr['spr']['status']) && isset($spr['spr']['kondisi'])) {
            $spr = ConditionStatus::where('status', $spr['spr']['status'])->where('kondisi', $spr['spr']['kondisi'])->first('id');
        } else if(isset($spr['spr']['status']) || isset($spr['spr']['kondisi'])) {
            if (isset($spr['spr']['status']) && $spr['spr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Speaker Derek Kecil';
            }  else if(isset($spr['spr']['kondisi'])){
                $errors[] = 'Harap Isi Status Speaker Derek Kecil';
        }
            else  {
                $spr = ConditionStatus::where('status', $spr['spr']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Speaker Derek Kecil';
            }

        $sb['sb'] = $request->input('sb');
        if (isset($sb['sb']['status']) && isset($sb['sb']['kondisi'])) {
            $sb = ConditionStatus::where('status', $sb['sb']['status'])->where('kondisi', $sb['sb']['kondisi'])->first('id');
        } else if (isset($sb['sb']['status']) || isset($sb['sb']['kondisi']))  {
            if (isset($sb['sb']['status']) && $sb['sb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Seat Belt Derek Kecil';
            }  else if(isset($sb['sb']['kondisi'])){
                $errors[] = 'Harap Isi Status Seat Belt Derek Kecil';
        }
            else  {
                $sb = ConditionStatus::where('status', $sb['sb']['status'])->first('id');
            }
        }  
           else{
                $errors[] = 'Harap Isi Seat Belt Derek Kecil';
            }

                    
        $kbd['kbd'] = $request->input('kbd');
        if(empty( $kbd['kbd'])){
            $errors[] = 'Harap Isi Keterangan Bagian Dalam Derek Kecil' ;
        }


        $dh['dh'] = $request->input('dh');
        if (isset($dh['dh']['status']) && isset($dh['dh']['kondisi'])) {
            $dh = ConditionStatus::where('status', $dh['dh']['status'])->where('kondisi', $dh['dh']['kondisi'])->first('id');
        } else if (isset($dh['dh']['status']) || isset($dh['dh']['kondisi'])){
            if (isset($dh['dh']['status']) && $dh['dh']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Dongkrak Hidrolik 20 Ton Derek Kecil';
            }  else if(isset($dh['dh']['kondisi'])){
                $errors[] = 'Harap Isi Status Dongkrak Hidrolik 20 Ton Derek Kecil';
        }
            else {
                $dh = ConditionStatus::where('status', $dh['dh']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Dongkrak Hidrolik 20 Ton Derek Kecil';
            }

        $toh['toh'] = $request->input('toh');
        if (isset($toh['toh']['status']) && isset($toh['toh']['kondisi'])) {
            $toh = ConditionStatus::where('status', $toh['toh']['status'])->where('kondisi', $toh['toh']['kondisi'])->first('id');
        } else if (isset($toh['toh']['status']) || isset($toh['toh']['kondisi'])){
            if (isset($toh['toh']['status']) && $toh['toh']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Tangki Oli Hidrolik Derek Kecil';
            }  else if(isset($toh['toh']['kondisi'])){
                $errors[] = 'Harap Isi Status Tangki Oli Hidrolik Derek Kecil';
        }
            else {
                $toh = ConditionStatus::where('status', $toh['toh']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Tangki Oli Hidrolik Derek Kecil';
            }

        $ww['ww'] = $request->input('ww');
        if (isset($ww['ww']['status']) && isset($ww['ww']['kondisi'])) {
            $ww = ConditionStatus::where('status', $ww['ww']['status'])->where('kondisi', $ww['ww']['kondisi'])->first('id');
        } else if (isset($ww['ww']['status']) || isset($ww['ww']['kondisi'])){
            if (isset($ww['ww']['status']) && $ww['ww']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Winch Warm 5 Ton Derek Kecil';
            }  else if(isset($ww['ww']['kondisi'])){
                $errors[] = 'Harap Isi Status Winch Warm 5 Ton Derek Kecil';
        }
            else {
                $ww = ConditionStatus::where('status', $ww['ww']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Winch Warm 5 Ton Derek Kecil';
            }

        $kh['kh'] = $request->input('kh');
        if (isset($kh['kh']['status']) && isset($kh['kh']['kondisi'])) {
            $kh = ConditionStatus::where('status', $kh['kh']['status'])->where('kondisi', $kh['kh']['kondisi'])->first('id');
        } else if (isset($kh['kh']['status']) || isset($kh['kh']['kondisi'])){
            if (isset($kh['kh']['status']) && $kh['kh']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kait Hook Derek Kecil';
            }  else if(isset($kh['kh']['kondisi'])){
                $errors[] = 'Harap Isi Status Kait Hook Derek Kecil';
        }
            else {
                $kh = ConditionStatus::where('status', $kh['kh']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Kait Hook Derek Kecil';
            }

        $kr['kr'] = $request->input('kr');
        if (isset($kr['kr']['status']) && isset($kr['kr']['kondisi'])) {
            $kr = ConditionStatus::where('status', $kr['kr']['status'])->where('kondisi', $kr['kr']['kondisi'])->first('id');
        } else if(isset($kr['kr']['status']) || isset($kr['kr']['kondisi'])) {
            if (isset($kr['kr']['status']) && $kr['kr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kunci Roda Derek Kecil';
            }  else if(isset($kr['kr']['kondisi'])){
                $errors[] = 'Harap Isi Status Kunci Roda Derek Kecil';
        }
            else   {
                $kr = ConditionStatus::where('status', $kr['kr']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Kunci Roda Derek Kecil';
            }

        $db['db'] = $request->input('db');
        if (isset($db['db']['status']) && isset($db['db']['kondisi'])) {
            $db = ConditionStatus::where('status', $db['db']['status'])->where('kondisi', $db['db']['kondisi'])->first('id');
        } else if(isset($db['db']['status']) || isset($db['db']['kondisi'])) {
            if (isset($db['db']['status']) && $db['db']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Dogkrak Buaya Derek Kecil';
            }  else if(isset($db['db']['kondisi'])){
                $errors[] = 'Harap Isi Status Dogkrak Buaya Derek Kecil';
        }
            else   {
                $db = ConditionStatus::where('status', $db['db']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Dogkrak Buaya Derek Kecil';
            }

        $p3k['p3k'] = $request->input('p3k');
        if (isset($p3k['p3k']['status']) && isset($p3k['p3k']['kondisi'])) {
            $p3k = ConditionStatus::where('status', $p3k['p3k']['status'])->where('kondisi', $p3k['p3k']['kondisi'])->first('id');
        } else if(isset($p3k['p3k']['status']) || isset($p3k['p3k']['kondisi'])) {
            if (isset($p3k['p3k']['status']) && $p3k['p3k']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi P3K Derek Kecil';
            }  else if(isset($p3k['p3k']['kondisi'])){
                $errors[] = 'Harap Isi Status P3K Derek Kecil';
        }
            else {
                $p3k = ConditionStatus::where('status', $p3k['p3k']['status'])->first('id');
            }
        }  
           else{
                $errors[] = 'Harap Isi P3K Derek Kecil';
            }

        $st['st'] = $request->input('st');
        if (isset($st['st']['status']) && isset($st['st']['kondisi'])) {
            $st = ConditionStatus::where('status', $st['st']['status'])->where('kondisi', $st['st']['kondisi'])->first('id');
        } else if(isset($st['st']['status']) || isset($st['st']['kondisi'])) {
            if (isset($st['st']['status']) && $st['st']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Sarung Tangan Derek Kecil';
            }  else if(isset($st['st']['kondisi'])){
                $errors[] = 'Harap Isi Status Sarung Tangan Derek Kecil';
        }
            else   {
                $st = ConditionStatus::where('status', $st['st']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Sarung Tangan Derek Kecil';
            }

       $hm['hm'] = $request->input('hm');
        if (isset($hm['hm']['status']) && isset($hm['hm']['kondisi'])) {
            $hm = ConditionStatus::where('status', $hm['hm']['status'])->where('kondisi', $hm['hm']['kondisi'])->first('id');
        } else if(isset($hm['hm']['status']) || isset($hm['hm']['kondisi'])) {
            if (isset($hm['hm']['status']) && $hm['hm']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Helm Derek Kecil';
            }  else if(isset($hm['hm']['kondisi'])){
                $errors[] = 'Harap Isi Status Helm Derek Kecil';
        }
            else   {
                $hm = ConditionStatus::where('status', $hm['hm']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Helm Derek Kecil';
            }

       $jh['jh'] = $request->input('jh');
        if (isset($jh['jh']['status']) && isset($jh['jh']['kondisi'])) {
            $jh = ConditionStatus::where('status', $jh['jh']['status'])->where('kondisi', $jh['jh']['kondisi'])->first('id');
        } else if(isset($jh['jh']['status']) || isset($jh['jh']['kondisi'])) {
            if (isset($jh['jh']['status']) && $jh['jh']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Jas Hujan Derek Kecil';
            }  else if(isset($jh['jh']['kondisi'])){
                $errors[] = 'Harap Isi Status Jas Hujan Derek Kecil';
        }
            else   {
                $jh = ConditionStatus::where('status', $jh['jh']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Jas Hujan Derek Kecil';
            }
            
        $kpr['kpr'] = $request->input('kpr');
        if(empty( $kpr['kpr'])){
            $errors[] = 'Harap Isi Keterangan Peralatan Derek Kecil' ;
        }

        $pa['pa'] = $request->input('pa');
        if (isset($pa['pa']['status']) && isset($pa['pa']['kondisi'])) {
            $pa = ConditionStatus::where('status', $pa['pa']['status'])->where('kondisi', $pa['pa']['kondisi'])->first('id');
        } else if(isset($pa['pa']['status']) || isset($pa['pa']['kondisi'])) {
            if (isset($pa['pa']['status']) && $pa['pa']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Public Address Derek Kecil';
            }  else if(isset($pa['pa']['kondisi'])){
                $errors[] = 'Harap Isi Status Public Address Derek Kecil';
        }
            else  {
                $pa = ConditionStatus::where('status', $pa['pa']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Public Address Derek Kecil';
            }

        $lsb['lsb'] = $request->input('lsb');
        if (isset($lsb['lsb']['status']) && isset($lsb['lsb']['kondisi'])) {
            $lsb = ConditionStatus::where('status', $lsb['lsb']['status'])->where('kondisi', $lsb['lsb']['kondisi'])->first('id');
        } else if (isset($lsb['lsb']['status']) || isset($lsb['lsb']['kondisi'])){
            if (isset($lsb['lsb']['status']) && $lsb['lsb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu (Rotary) Derek Kecil';
            }  else if(isset($lsb['lsb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu (Rotary) Derek Kecil';
        }
            else {
                $lsb = ConditionStatus::where('status', $lsb['lsb']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Lampu (Rotary) Derek Kecil';
            }

        $ws['ws'] = $request->input('ws');
        if (isset($ws['ws']['status']) && isset($ws['ws']['kondisi'])) {
            $ws = ConditionStatus::where('status', $ws['ws']['status'])->where('kondisi', $ws['ws']['kondisi'])->first('id');
        } else if (isset($ws['ws']['status']) || isset($ws['ws']['kondisi'])){
            if (isset($ws['ws']['status']) && $ws['ws']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Webbing Sling Derek Kecil';
            }  else if(isset($ws['ws']['kondisi'])){
                $errors[] = 'Harap Isi Status Webbing Sling Derek Kecil';
        }
            else {
                $ws = ConditionStatus::where('status', $ws['ws']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Webbing Sling Derek Kecil';
            }

        $ps['ps'] = $request->input('ps');
        if (isset($ps['ps']['status']) && isset($ps['ps']['kondisi'])) {
            $ps = ConditionStatus::where('status', $ps['ps']['status'])->where('kondisi', $ps['ps']['kondisi'])->first('id');
        } else if (isset($ps['ps']['status']) || isset($ps['ps']['kondisi'])){
            if (isset($ps['ps']['status']) && $ps['ps']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Parking Shock Derek Kecil';
            }  else if(isset($ps['ps']['kondisi'])){
                $errors[] = 'Harap Isi Status Parking Shock Derek Kecil';
        }
            else   {
                $ps = ConditionStatus::where('status', $ps['ps']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Parking Shock Derek Kecil';
            }

        $sl['sl'] = $request->input('sl');
        if (isset($sl['sl']['status']) && isset($sl['sl']['kondisi'])) {
            $sl = ConditionStatus::where('status', $sl['sl']['status'])->where('kondisi', $sl['sl']['kondisi'])->first('id');
        } else if (isset($sl['sl']['status']) || isset($sl['sl']['kondisi'])){
            if (isset($sl['sl']['status']) && $sl['sl']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Segel Derek Kecil';
            }  else if(isset($sl['sl']['kondisi'])){
                $errors[] = 'Harap Isi Status Segel Derek Kecil';
        }
            else   {
                $sl = ConditionStatus::where('status', $sl['sl']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Segel Derek Kecil';
            }

        $kpt['kpt'] = $request->input('kpt');
        if(empty( $kpt['kpt'])){
            $errors[] = 'Harap Isi Keterangan Peralatan Tambahan Derek Kecil' ;
        }
    
        
        $ec['ec'] = $request->input('ec');
        if (isset($ec['ec']['status']) && isset($ec['ec']['kondisi'])) {
            $ec = ConditionStatus::where('status', $ec['ec']['status'])->where('kondisi', $ec['ec']['kondisi'])->first('id');
        } else if(isset($ec['ec']['status']) || isset($ec['ec']['kondisi'])){
            if (isset($ec['ec']['status']) && $ec['ec']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Engine Condition Derek Kecil';
            }  else if(isset($ec['ec']['kondisi'])){
                $errors[] = 'Harap Isi Status Engine Condition Derek Kecil';
        }
            else {
                $ec = ConditionStatus::where('status', $ec['ec']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Engine Condition Derek Kecil';          
              }

        $rt['rt'] = $request->input('rt');
        if (isset($rt['rt']['status']) && isset($rt['rt']['kondisi'])) {
            $rt = ConditionStatus::where('status', $rt['rt']['status'])->where('kondisi', $rt['rt']['kondisi'])->first('id');
        } else if (isset($rt['rt']['status']) || isset($rt['rt']['kondisi'])){
            if (isset($rt['rt']['status']) && $rt['rt']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Running Test Derek Kecil';
            }  else if(isset($rt['rt']['kondisi'])){
                $errors[] = 'Harap Isi Status Running Test Derek Kecil';
        }
            else {
                $rt = ConditionStatus::where('status', $rt['rt']['status'])->first('id');
            }
        }  
           else{
                $errors[] ='Harap Isi Running Test Derek Kecil';
            }

        $arr['arr'] = $request->input('arr');
        if (isset($arr['arr']['status']) && isset($arr['arr']['kondisi'])) {
            $arr = ConditionStatus::where('status', $arr['arr']['status'])->where('kondisi', $arr['arr']['kondisi'])->first('id');
        } else if  (isset($arr['arr']['status']) || isset($arr['arr']['kondisi'])){
            if (isset($arr['arr']['status']) && $arr['arr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Air Radiator Derek Kecil';
            }  else if(isset($arr['arr']['kondisi'])){
                $errors[] = 'Harap Isi Status Air Radiator Derek Kecil';
        }
            else {
                $arr = ConditionStatus::where('status', $arr['arr']['status'])->first('id');
            }
        }  
          else{
                $errors[] = 'Harap Isi Air Radiator Derek Kecil';           
             }


        $acu['acu'] = $request->input('acu');
        if (isset($acu['acu']['status']) && isset($acu['acu']['kondisi'])) {
            $acu = ConditionStatus::where('status', $acu['acu']['status'])->where('kondisi', $acu['acu']['kondisi'])->first('id');
        } else if (isset($acu['acu']['status']) || isset($acu['acu']['kondisi'])){
            if (isset($acu['acu']['status']) && $acu['acu']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Air Accu Derek Kecil';
            }  else if(isset($acu['acu']['kondisi'])){
                $errors[] = 'Harap Isi Status Air Accu Derek Kecil';
        }
            else  {
                $acu = ConditionStatus::where('status', $acu['acu']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Air Accu Derek Kecil';
            }

        $omn['omn'] = $request->input('omn');
        if (isset($omn['omn']['status']) && isset($omn['omn']['kondisi'])) {
            $omn = ConditionStatus::where('status', $omn['omn']['status'])->where('kondisi', $omn['omn']['kondisi'])->first('id');
        } else if(isset($omn['omn']['status']) || isset($omn['omn']['kondisi'])){
            if (isset($omn['omn']['status']) && $omn['omn']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Oli Mesin Derek Kecil';
            }  else if(isset($omn['omn']['kondisi'])){
                $errors[] = 'Harap Isi Status Oli Mesin Derek Kecil';
        }
            else  {
                $omn = ConditionStatus::where('status', $omn['omn']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Oli Mesin Derek Kecil';
            }

        $mr['mr'] = $request->input('mr');
        if (isset($mr['mr']['status']) && isset($mr['mr']['kondisi'])) {
            $mr = ConditionStatus::where('status', $mr['mr']['status'])->where('kondisi', $mr['mr']['kondisi'])->first('id');
        } else if (isset($mr['mr']['status']) || isset($mr['mr']['kondisi'])){
            if (isset($mr['mr']['status']) && $mr['mr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Minyak Rem Derek Kecil';
            }  else if(isset($mr['mr']['kondisi'])){
                $errors[] = 'Harap Isi Status Minyak Rem Derek Kecil';
        }
            else   {
                $mr = ConditionStatus::where('status', $mr['mr']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Minyak Rem Derek Kecil';
            }

            
        $apr['apr'] = $request->input('apr');
        if (isset($apr['apr']['status']) && isset($apr['apr']['kondisi'])) {
            $apr = ConditionStatus::where('status', $apr['apr']['status'])->where('kondisi', $apr['apr']['kondisi'])->first('id');
        } else if(isset($apr['apr']['status']) || isset($apr['apr']['kondisi'])){
            if (isset($apr['apr']['status']) && $apr['apr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi APAR Derek Kecil';
            }  else if(isset($apr['apr']['kondisi'])){
                $errors[] = 'Harap Isi Status APAR Derek Kecil';
        }
            else{
                $apr = ConditionStatus::where('status', $apr['apr']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi APAR Derek Kecil';
            }

        $ops['ops'] = $request->input('ops');
        if (isset($ops['ops']['status']) && isset($ops['ops']['kondisi'])) {
            $ops = ConditionStatus::where('status', $ops['ops']['status'])->where('kondisi', $ops['ops']['kondisi'])->first('id');
        } else if(isset($ops['ops']['status']) || isset($ops['ops']['kondisi'])) {
            if (isset($ops['ops']['status']) && $ops['ops']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Oil Power Steering Derek Kecil';
            }  else if(isset($ops['ops']['kondisi'])){
                $errors[] = 'Harap Isi Status Oil Power Steering Derek Kecil';
        }
            else {
                $ops = ConditionStatus::where('status', $ops['ops']['status'])->first('id');
            }
        }  
          else{
                $errors[] = 'Harap Isi Oil Power Steering Derek Kecil';
            }

        $keeng['keeng'] = $request->input('keeng');
        if(empty( $keeng['keeng'])){
            $errors[] = 'Harap Isi Keterangan Engine Derek Kecil' ;
        }

        $ski['ski'] = $request->input('ski');
        if (isset($ski['ski']['status']) && isset($ski['ski']['kondisi'])) {
            $ski = ConditionStatus::where('status', $ski['ski']['status'])->where('kondisi', $ski['ski']['kondisi'])->first('id');
        } else if (isset($ski['ski']['status']) || isset($ski['ski']['kondisi'])){
            if (isset($ski['ski']['status']) && $ski['ski']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Samping Kiri Derek Kecil';
            }  else if(isset($ski['ski']['kondisi'])){
                $errors[] = 'Harap Isi Status Samping Kiri Derek Kecil';
        }
            else  {
                $ski = ConditionStatus::where('status', $ski['ski']['status'])->first('id');
            }
        }  
        else{
                $errors[] = 'Harap Isi Samping Kiri Derek Kecil';
            }

        $ska['ska'] = $request->input('ska');
        if (isset($ska['ska']['status']) && isset($ska['ska']['kondisi'])) {
            $ska = ConditionStatus::where('status', $ska['ska']['status'])->where('kondisi', $ska['ska']['kondisi'])->first('id');
        } else if (isset($ska['ska']['status']) || isset($ska['ska']['kondisi'])){
            if (isset($ska['ska']['status']) && $ska['ska']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Samping Kanan Derek Kecil';
            }  else if(isset($ska['ska']['kondisi'])){
                $errors[] = 'Harap Isi Status Samping Kanan Derek Kecil';
        }
            else {
                $ska = ConditionStatus::where('status', $ska['ska']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Samping Kanan Derek Kecil';
            }

        $dpn['dpn'] = $request->input('dpn');
        if (isset($dpn['dpn']['status']) && isset($dpn['dpn']['kondisi'])) {
            $dpn = ConditionStatus::where('status', $dpn['dpn']['status'])->where('kondisi', $dpn['dpn']['kondisi'])->first('id');
        } else if(isset($dpn['dpn']['status']) || isset($dpn['dpn']['kondisi'])) {
            if (isset($dpn['dpn']['status']) && $dpn['dpn']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Depan Derek Kecil';
            }  else if(isset($dpn['dpn']['kondisi'])){
                $errors[] = 'Harap Isi Status Depan Derek Kecil';
        }
            else  {
                $dpn = ConditionStatus::where('status', $dpn['dpn']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Depan Derek Kecil';
            }

        $blg['blg'] = $request->input('blg');
        if (isset($blg['blg']['status']) && isset($blg['blg']['kondisi'])) {
            $blg = ConditionStatus::where('status', $blg['blg']['status'])->where('kondisi', $blg['blg']['kondisi'])->first('id');
        } else if (isset($blg['blg']['status']) || isset($blg['blg']['kondisi'])) {
            if (isset($blg['blg']['status']) && $blg['blg']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Belakang Derek Kecil';
            }  else if(isset($blg['blg']['kondisi'])){
                $errors[] = 'Harap Isi Status Belakang Derek Kecil';
        }
            else  {
                $blg = ConditionStatus::where('status', $blg['blg']['status'])->first('id');
            }
        }  
          else{
                $errors[] = 'Harap Isi Belakang Derek Kecil';
            }

        $ats['ats'] = $request->input('ats');
        if (isset($ats['ats']['status']) && isset($ats['ats']['kondisi'])) {
            $ats = ConditionStatus::where('status', $ats['ats']['status'])->where('kondisi', $ats['ats']['kondisi'])->first('id');
        } else if(isset($ats['ats']['status']) || isset($ats['ats']['kondisi'])) {
            if (isset($ats['ats']['status']) && $ats['ats']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Atas Derek Kecil';
            }  else if(isset($ats['ats']['kondisi'])){
                $errors[] = 'Harap Isi Status Atas Derek Kecil';
        }
            else {
                $ats = ConditionStatus::where('status', $ats['ats']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Atas Derek Kecil';
            }
       
        $kbdc['kbdc'] = $request->input('kbdc');
        if(empty( $kbdc['kbdc'])){
            $errors[] = 'Harap Isi Keterangan Body dan Cat Derek Kecil' ;
        }
    
        //derek besar
         $odo2['odo2'] = $request->input('odo2');
        if(empty( $odo2['odo2'])){
            $errors[] = 'Harap Isi Odo Meter' ;
        }
        $bkaddb['bkaddb'] = $request->input('bkaddb');
        // dd(count($bkaddb['bkaddb']));
        if (isset($bkaddb['bkaddb']['status']) && isset($bkaddb['bkaddb']['kondisi'])) {
            $bkaddb = ConditionStatus::where('status', $bkaddb['bkaddb']['status'])->where('kondisi', $bkaddb['bkaddb']['kondisi'])->first('id');
        } 
        else if(isset($bkaddb['bkaddb']['status']) || isset($bkaddb['bkaddb']['kondisi'])) {
            if (isset($bkaddb['bkaddb']['status']) && $bkaddb['bkaddb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Kanan Depan Derek Besar';
            }else if (isset($bkaddb['bkaddb']['kondisi']) && $bkaddb['bkaddb']['kondisi'] == 1){
                $errors[] = 'Harap Isi Status Ban Kanan Depan Derek Besar';
            } 
            else  {
        $bkaddb = ConditionStatus::where('status', $bkaddb['bkaddb']['status'])->first('id');
    }   
        }
          else {
        $errors[] = 'Harap Isi Ban Kanan Depan Derek Besar';
        }  
        
        $bkabdb['bkabdb'] = $request->input('bkabdb');
        if (isset($bkabdb['bkabdb']['status']) && isset($bkabdb['bkabdb']['kondisi'])) {
            $bkabdb = ConditionStatus::where('status', $bkabdb['bkabdb']['status'])->where('kondisi', $bkabdb['bkabdb']['kondisi'])->first('id');
        } else if(isset($bkabdb['bkabdb']['status']) || isset($bkabdb['bkabdb']['kondisi'])) {
           if (isset($bkabdb['bkabdb']['status']) && $bkabdb['bkabdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Kanan Belakang Derek Besar';
            }else if(isset($bkabdb['bkabdb']['kondisi']) && $bkabdb['bkabdb']['kondisi'] == 1){
                $errors[] = 'Harap Isi Status Ban Kanan Belakang Derek Besar';
            } 
            else{
                $bkabdb = ConditionStatus::where('status', $bkabdb['bkabdb']['status'])->first('id');
            }
        }
             else {
        $errors[] = 'Harap Isi Ban Kanan Belakang Derek Besar';
        }  

        $bkiddb['bkiddb'] = $request->input('bkiddb');
        if (isset($bkiddb['bkiddb']['status']) && isset($bkiddb['bkiddb']['kondisi'])) {
            $bkiddb = ConditionStatus::where('status', $bkiddb['bkiddb']['status'])->where('kondisi', $bkiddb['bkiddb']['kondisi'])->first('id');
        } else if (isset($bkiddb['bkiddb']['status']) || isset($bkiddb['bkiddb']['kondisi'])) {
            if (isset($bkiddb['bkiddb']['status']) && $bkiddb['bkiddb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Kiri Depan Derek Besar';
            }  else if(isset($bkiddb['bkiddb']['kondisi'])){
                $errors[] = 'Harap Isi Status Ban Kiri Depan Derek Besar';
            }
            else   {
                $bkiddb = ConditionStatus::where('status', $bkiddb['bkiddb']['status'])->first('id');
            }
        } 
           else{
                $errors[] ='Harap Isi Ban Kiri Depan Derek Besar';
            } 

        $bkibdb['bkibdb'] = $request->input('bkibdb');
        if (isset($bkibdb['bkibdb']['status']) && isset($bkibdb['bkibdb']['kondisi'])) {
            $bkibdb = ConditionStatus::where('status', $bkibdb['bkibdb']['status'])->where('kondisi', $bkibdb['bkibdb']['kondisi'])->first('id');
        } else if(isset($bkibdb['bkibdb']['status']) || isset($bkibdb['bkibdb']['kondisi'])){
            if (isset($bkibdb['bkibdb']['status']) && $bkibdb['bkibdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Kiri Belakang Derek Besar';
            }  else if(isset($bkibdb['bkibdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Ban Kiri Belakang Derek Besar';
            }
            else {
                $bkibdb = ConditionStatus::where('status', $bkibdb['bkibdb']['status'])->first('id');
            }
        } 
         else{
                $errors[] = 'Harap Isi Ban Kiri Belakang Derek Besar';
            } 

        $bsdb['bsdb'] = $request->input('bsdb');
        if (isset($bsdb['bsdb']['status']) && isset($bsdb['bsdb']['kondisi'])) {
            $bsdb = ConditionStatus::where('status', $bsdb['bsdb']['status'])->where('kondisi', $bsdb['bsdb']['kondisi'])->first('id');
        } else if (isset($bsdb['bsdb']['status']) || isset($bsdb['bsdb']['kondisi'])) {
            if (isset($bsdb['bsdb']['status']) && $bsdb['bsdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Serep Derek Besar';
            }  else if(isset($bsdb['bsdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Ban Serep Derek Besar';
            }
            else  {
                $bsdb = ConditionStatus::where('status', $bsdb['bsdb']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Ban Serep Derek Besar';
            } 

        $kbrdbdb['kbrdbdb'] = $request->input('kbrdbdb');
        if(empty( $kbrdbdb['kbrdbdb'])){
            $errors[] = 'Harap Isi Keterangan Roda dan Ban Derek Besar' ;
        }
    

        $stnkdb['stnkdb'] = $request->input('stnkdb');
        if (isset($stnkdb['stnkdb']['status']) && isset($stnkdb['stnkdb']['kondisi'])) {
            $stnkdb = ConditionStatus::where('status', $stnkdb['stnkdb']['status'])->where('kondisi', $stnkdb['stnkdb']['kondisi'])->first('id');
        } else if (isset($stnkdb['stnkdb']['status']) || isset($stnkdb['stnkdb']['kondisi'])) {
            if (isset($stnkdb['stnkdb']['status']) && $stnkdb['stnkdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi STNK Derek Besar';
            }  else if(isset($stnkdb['stnkdb']['kondisi'])){
                $errors[] = 'Harap Isi Status STNK Derek Besar';
            }
            else  {
                $stnkdb = ConditionStatus::where('status', $stnkdb['stnkdb']['status'])->first('id');
            }
        } 
        else{
                $errors[] ='Harap Isi STNK Derek Besar';
            } 

        $ldbdb['ldbdb'] = $request->input('ldbdb');
        if (isset($ldbdb['ldbdb']['status']) && isset($ldbdb['ldbdb']['kondisi'])) {
            $ldbdb = ConditionStatus::where('status', $ldbdb['ldbdb']['status'])->where('kondisi', $ldbdb['ldbdb']['kondisi'])->first('id');
        } else if(isset($ldbdb['ldbdb']['status']) || isset($ldbdb['ldbdb']['kondisi'])) {
            if (isset($ldbdb['ldbdb']['status']) && $ldbdb['ldbdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Dashboard Derek Besar';
            }  else if(isset($ldbdb['ldbdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Dashboard Derek Besar';
            }
            else {
                $ldbdb = ConditionStatus::where('status', $ldbdb['ldbdb']['status'])->first('id');
            }
        } 
         else{
                $errors[] = 'Harap Isi Lampu Dashboard Derek Besar';
            } 
            
        $ldpdb['ldpdb'] = $request->input('ldpdb');
        if (isset($ldpdb['ldpdb']['status']) && isset($ldpdb['ldpdb']['kondisi'])) {
            $ldpdb = ConditionStatus::where('status', $ldpdb['ldpdb']['status'])->where('kondisi', $ldpdb['ldpdb']['kondisi'])->first('id');
        } else if(isset($ldpdb['ldpdb']['status']) || isset($ldpdb['ldpdb']['kondisi'])) {
            if (isset($ldpdb['ldpdb']['status']) && $ldpdb['ldpdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Depan Derek Besar';
            }  else if(isset($ldpdb['ldpdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Depan Derek Besar';
            }
            else {
                $ldpdb = ConditionStatus::where('status', $ldpdb['ldpdb']['status'])->first('id');
            }
        } 
            else{
                $errors[] = 'Harap Isi Lampu Depan Derek Besar';
            }

        $lbgdb['lbgdb'] = $request->input('lbgdb');
        if (isset($lbgdb['lbgdb']['status']) && isset($lbgdb['lbgdb']['kondisi'])) {
            $lbgdb = ConditionStatus::where('status', $lbgdb['lbgdb']['status'])->where('kondisi', $lbgdb['lbgdb']['kondisi'])->first('id');
        } else if(isset($lbgdb['lbgdb']['status']) || isset($lbgdb['lbgdb']['kondisi'])) {
            if (isset($lbgdb['lbgdb']['status']) && $lbgdb['lbgdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Belakang Derek Besar';
            }  else if(isset($lbgdb['lbgdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Belakang Derek Besar';
            }
            else   {
                $lbgdb = ConditionStatus::where('status', $lbgdb['lbgdb']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Lampu Belakang Derek Besar';
            }

        $lrdb['lrdb'] = $request->input('lrdb');
        if (isset($lrdb['lrdb']['status']) && isset($lrdb['lrdb']['kondisi'])) {
            $lrdb = ConditionStatus::where('status', $lrdb['lrdb']['status'])->where('kondisi', $lrdb['lrdb']['kondisi'])->first('id');
        } else if (isset($lrdb['lrdb']['status']) || isset($lrdb['lrdb']['kondisi'])){
            if (isset($lrdb['lrdb']['status']) && $lrdb['lrdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Rem Derek Besar';
            }  else if(isset($lrdb['lrdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Rem Derek Besar';
        }
            else  {
                $lrdb = ConditionStatus::where('status', $lrdb['lrdb']['status'])->first('id');
            }
        }  
           else{
                $errors[] = 'Harap Isi Lampu Rem Derek Besar';
            }

        $lsndb['lsndb'] = $request->input('lsndb');
        if (isset($lsndb['lsndb']['status']) && isset($lsndb['lsndb']['kondisi'])) {
            $lsndb = ConditionStatus::where('status', $lsndb['lsndb']['status'])->where('kondisi', $lsndb['lsndb']['kondisi'])->first('id');
        } else if(isset($lsndb['lsndb']['status']) || isset($lsndb['lsndb']['kondisi'])) {
            if (isset($lsndb['lsndb']['status']) && $lsndb['lsndb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Sein Derek Besar';
            }  else if(isset($lsndb['lsndb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Sein Derek Besar';
        }
            else  {
                $lsndb = ConditionStatus::where('status', $lsndb['lsndb']['status'])->first('id');
            }
        } 
         else{
                $errors[] = 'Harap Isi Lampu Sein Derek Besar';
            }

        $lmdb['lmdb'] = $request->input('lmdb');
        if (isset($lmdb['lmdb']['status']) && isset($lmdb['lmdb']['kondisi'])) {
            $lmdb = ConditionStatus::where('status', $lmdb['lmdb']['status'])->where('kondisi', $lmdb['lmdb']['kondisi'])->first('id');
        } else if (isset($lmdb['lmdb']['status']) || isset($lmdb['lmdb']['kondisi'])) {
            if (isset($lmdb['lmdb']['status']) && $lmdb['lmdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Mundur Derek Besar';
            }  else if(isset($lmdb['lmdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Mundur Derek Besar';
        }
            else  {
                $lmdb = ConditionStatus::where('status', $lmdb['lmdb']['status'])->first('id');
            }
        } 
          else{
                $errors[]= 'Harap Isi Lampu Mundur Derek Besar';
            }

        $lktdb['lktdb'] = $request->input('lktdb');
        if (isset($lktdb['lktdb']['status']) && isset($lktdb['lktdb']['kondisi'])) {
            $lktdb = ConditionStatus::where('status', $lktdb['lktdb']['status'])->where('kondisi', $lktdb['lktdb']['kondisi'])->first('id');
        } else if (isset($lktdb['lktdb']['status']) || isset($lktdb['lktdb']['kondisi'])) {
            if (isset($lktdb['lktdb']['status']) && $lktdb['lktdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Kabut Derek Besar';
            }  else if(isset($lktdb['lktdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Kabut Derek Besar';
        }
            else  {
                $lktdb = ConditionStatus::where('status', $lktdb['lktdb']['status'])->first('id');
            }
        } 
          else{
                $errors[]= 'Harap Isi Lampu Kabut Derek Besar';
            }

        $lsbdb['lsbdb'] = $request->input('lsbdb');
        if (isset($lsbdb['lsbdb']['status']) && isset($lsbdb['lsbdb']['kondisi'])) {
            $lsbdb = ConditionStatus::where('status', $lsbdb['lsbdb']['status'])->where('kondisi', $lsbdb['lsbdb']['kondisi'])->first('id');
        } else if (isset($lsbdb['lsbdb']['status']) || isset($lsbdb['lsbdb']['kondisi'])) {
            if (isset($lsbdb['lsbdb']['status']) && $lsbdb['lsbdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Storobo/Led (Rotary) Derek Besar';
            }  else if(isset($lsbdb['lsbdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Storobo/Led (Rotary) Derek Besar';
        }
            else  {
                $lsbdb = ConditionStatus::where('status', $lsbdb['lsbdb']['status'])->first('id');
            }
        } 
          else{
                $errors[]= 'Harap Isi Lampu Storobo/Led (Rotary) Derek Besar';
            }

        $lpsrdb['lpsrdb'] = $request->input('lpsrdb');
        if (isset($lpsrdb['lpsrdb']['status']) && isset($lpsrdb['lpsrdb']['kondisi'])) {
            $lpsrdb = ConditionStatus::where('status', $lpsrdb['lpsrdb']['status'])->where('kondisi', $lpsrdb['lpsrdb']['kondisi'])->first('id');
        } else if (isset($lpsrdb['lpsrdb']['status']) || isset($lpsrdb['lpsrdb']['kondisi'])) {
            if (isset($lpsrdb['lpsrdb']['status']) && $lpsrdb['lpsrdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Sorot Derek Besar';
            }  else if(isset($lpsrdb['lpsrdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Sorot Derek Besar';
        }
            else  {
                $lpsrdb = ConditionStatus::where('status', $lpsrdb['lpsrdb']['status'])->first('id');
            }
        } 
          else{
                $errors[]= 'Harap Isi Lampu Sorot Derek Besar';
            }

        $acdb['acdb'] = $request->input('acdb');
        if (isset($acdb['acdb']['status']) && isset($acdb['acdb']['kondisi'])) {
            $acdb = ConditionStatus::where('status', $acdb['acdb']['status'])->where('kondisi', $acdb['acdb']['kondisi'])->first('id');
        } else if(isset($acdb['acdb']['status']) || isset($acdb['acdb']['kondisi'])) {
            if (isset($acdb['acdb']['status']) && $acdb['acdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Air Conditioner Derek Besar';
            }  else if(isset($acdb['acdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Air Conditioner Derek Besar';
        }
            else  {
                $acdb = ConditionStatus::where('status', $acdb['acdb']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Air Conditioner Derek Besar';
            }

            
        $kldb['kldb'] = $request->input('kldb');
        if (isset($kldb['kldb']['status']) && isset($kldb['kldb']['kondisi'])) {
            $kldb = ConditionStatus::where('status', $kldb['kldb']['status'])->where('kondisi', $kldb['kldb']['kondisi'])->first('id');
        } else if (isset($kldb['kldb']['status']) || isset($kldb['kldb']['kondisi'])){
            if (isset($kldb['kldb']['status']) && $kldb['kldb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Klakson Derek Besar';
            }  else if(isset($kldb['kldb']['kondisi'])){
                $errors[] = 'Harap Isi Status Klakson Derek Besar';
        }
            else  {
                $kldb = ConditionStatus::where('status', $kldb['kldb']['status'])->first('id');
            }
        }  
           else{
                $errors[] ='Harap Isi Klakson Derek Besar';
            }

        $wpdb['wpdb'] = $request->input('wpdb');
        if (isset($wpdb['wpdb']['status']) && isset($wpdb['wpdb']['kondisi'])) {
            $wpdb = ConditionStatus::where('status', $wpdb['wpdb']['status'])->where('kondisi', $wpdb['wpdb']['kondisi'])->first('id');
        } else if (isset($wpdb['wpdb']['status']) || isset($wpdb['wpdb']['kondisi'])) {
            if (isset($wpdb['wpdb']['status']) && $wpdb['wpdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Wiper Derek Besar';
            }  else if(isset($wpdb['wpdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Wiper Derek Besar';
        }
            else  {
                $wpdb = ConditionStatus::where('status', $wpdb['wpdb']['status'])->first('id');
            }  
        } 
         else{
                $errors[] ='Harap Isi Wiper Derek Besar';
            }

        $sbdb['sbdb'] = $request->input('sbdb');
        if (isset($sbdb['sbdb']['status']) && isset($sbdb['sbdb']['kondisi'])) {
            $sbdb = ConditionStatus::where('status', $sbdb['sbdb']['status'])->where('kondisi', $sbdb['sbdb']['kondisi'])->first('id');
        } else if (isset($sbdb['sbdb']['status']) || isset($sbdb['sbdb']['kondisi']))  {
            if (isset($sbdb['sbdb']['status']) && $sbdb['sbdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Seat Belt Derek Besar';
            }  else if(isset($sbdb['sbdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Seat Belt Derek Besar';
        }
            else  {
                $sbdb = ConditionStatus::where('status', $sbdb['sbdb']['status'])->first('id');
            }
        }  
           else{
                $errors[] = 'Harap Isi Seat Belt Derek Besar';
            }

        $apardb['apardb'] = $request->input('apardb');
        if (isset($apardb['apardb']['status']) && isset($apardb['apardb']['kondisi'])) {
            $apardb = ConditionStatus::where('status', $apardb['apardb']['status'])->where('kondisi', $apardb['apardb']['kondisi'])->first('id');
        } else if(isset($apardb['apardb']['status']) || isset($apardb['apardb']['kondisi'])){
            if (isset($apardb['apardb']['status']) && $apardb['apardb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi APAR Derek Besar';
            }  else if(isset($apardb['apardb']['kondisi'])){
                $errors[] = 'Harap Isi Status APAR Derek Besar';
        }
            else{
                $apardb = ConditionStatus::where('status', $apardb['apardb']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi APAR Derek Besar';
            }
     
                    
        $kbddb['kbddb'] = $request->input('kbddb');
        if(empty( $kbddb['kbddb'])){
            $errors[] = 'Harap Isi Keterangan Bagian Dalam Derek Besar' ;
        }


        $blk['blk'] = $request->input('blk');
        if (isset($blk['blk']['status']) && isset($blk['blk']['kondisi'])) {
            $blk = ConditionStatus::where('status', $blk['blk']['status'])->where('kondisi', $blk['blk']['kondisi'])->first('id');
        } else if (isset($blk['blk']['status']) || isset($blk['blk']['kondisi'])){
            if (isset($blk['blk']['status']) && $blk['blk']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Balok Derek Besar';
            }  else if(isset($blk['blk']['kondisi'])){
                $errors[] = 'Harap Isi Status Balok Derek Besar';
        }
            else {
                $blk = ConditionStatus::where('status', $blk['blk']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Balok Derek Besar';
            }

        $p3kdb['p3kdb'] = $request->input('p3kdb');
        if (isset($p3kdb['p3kdb']['status']) && isset($p3kdb['p3kdb']['kondisi'])) {
            $p3kdb = ConditionStatus::where('status', $p3kdb['p3kdb']['status'])->where('kondisi', $p3kdb['p3kdb']['kondisi'])->first('id');
        } else if (isset($p3kdb['p3kdb']['status']) || isset($p3kdb['p3kdb']['kondisi'])){
            if (isset($p3kdb['p3kdb']['status']) && $p3kdb['p3kdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi P3K Derek Besar';
            }  else if(isset($p3kdb['p3kdb']['kondisi'])){
                $errors[] = 'Harap Isi Status P3K Derek Besar';
        }
            else {
                $p3kdb = ConditionStatus::where('status', $p3kdb['p3kdb']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi P3K Derek Besar';
            }

        $ktrl['ktrl'] = $request->input('ktrl');
        if (isset($ktrl['ktrl']['status']) && isset($ktrl['ktrl']['kondisi'])) {
            $ktrl = ConditionStatus::where('status', $ktrl['ktrl']['status'])->where('kondisi', $ktrl['ktrl']['kondisi'])->first('id');
        } else if (isset($ktrl['ktrl']['status']) || isset($ktrl['ktrl']['kondisi'])){
            if (isset($ktrl['ktrl']['status']) && $ktrl['ktrl']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Katrol Derek Besar';
            }  else if(isset($ktrl['ktrl']['kondisi'])){
                $errors[] = 'Harap Isi Status Katrol Derek Besar';
        }
            else {
                $ktrl = ConditionStatus::where('status', $ktrl['ktrl']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Katrol Derek Besar';
            }

        $dht['dht'] = $request->input('dht');
        if (isset($dht['dht']['status']) && isset($dht['dht']['kondisi'])) {
            $dht = ConditionStatus::where('status', $dht['dht']['status'])->where('kondisi', $dht['dht']['kondisi'])->first('id');
        } else if (isset($dht['dht']['status']) || isset($dht['dht']['kondisi'])){
            if (isset($dht['dht']['status']) && $dht['dht']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Dongkrak Hidrolik 20 Ton Derek Besar';
            }  else if(isset($dht['dht']['kondisi'])){
                $errors[] = 'Harap Isi Status Dongkrak Hidrolik 20 Ton Derek Besar';
        }
            else {
                $dht = ConditionStatus::where('status', $dht['dht']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Dongkrak Hidrolik 20 Ton Derek Besar';
            }

        $ks['ks'] = $request->input('ks');
        if (isset($ks['ks']['status']) && isset($ks['ks']['kondisi'])) {
            $ks = ConditionStatus::where('status', $ks['ks']['status'])->where('kondisi', $ks['ks']['kondisi'])->first('id');
        } else if(isset($ks['ks']['status']) || isset($ks['ks']['kondisi'])) {
            if (isset($ks['ks']['status']) && $ks['ks']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kunci Shock Derek Besar';
            }  else if(isset($ks['ks']['kondisi'])){
                $errors[] = 'Harap Isi Status Kunci Shock Derek Besar';
        }
            else   {
                $ks = ConditionStatus::where('status', $ks['ks']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Kunci Shock Derek Besar';
            }

        $km['km'] = $request->input('km');
        if (isset($km['km']['status']) && isset($km['km']['kondisi'])) {
            $km = ConditionStatus::where('status', $km['km']['status'])->where('kondisi', $km['km']['kondisi'])->first('id');
        } else if(isset($km['km']['status']) || isset($km['km']['kondisi'])) {
            if (isset($km['km']['status']) && $km['km']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kunci Moment Derek Besar';
            }  else if(isset($km['km']['kondisi'])){
                $errors[] = 'Harap Isi Status Kunci Moment Derek Besar';
        }
            else   {
                $km = ConditionStatus::where('status', $km['km']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Kunci Moment Derek Besar';
            }

       $km['km'] = $request->input('km');
        if (isset($km['km']['status']) && isset($km['km']['kondisi'])) {
            $km = ConditionStatus::where('status', $km['km']['status'])->where('kondisi', $km['km']['kondisi'])->first('id');
        } else if(isset($km['km']['status']) || isset($km['km']['kondisi'])) {
            if (isset($km['km']['status']) && $km['km']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kunci Moment Derek Besar';
            }  else if(isset($km['km']['kondisi'])){
                $errors[] = 'Harap Isi Status Kunci Moment Derek Besar';
        }
            else   {
                $km = ConditionStatus::where('status', $km['km']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Kunci Moment Derek Besar';
            }

       $kp['kp'] = $request->input('kp');
        if (isset($kp['kp']['status']) && isset($kp['kp']['kondisi'])) {
            $kp = ConditionStatus::where('status', $kp['kp']['status'])->where('kondisi', $kp['kp']['kondisi'])->first('id');
        } else if(isset($kp['kp']['status']) || isset($kp['kp']['kondisi'])) {
            if (isset($kp['kp']['status']) && $kp['kp']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kunci Pipa Derek Besar';
            }  else if(isset($kp['kp']['kondisi'])){
                $errors[] = 'Harap Isi Status Kunci Pipa Derek Besar';
        }
            else   {
                $kp = ConditionStatus::where('status', $kp['kp']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Kunci Pipa Derek Besar';
            }
            
       $rnt['rnt'] = $request->input('rnt');
        if (isset($rnt['rnt']['status']) && isset($rnt['rnt']['kondisi'])) {
            $rnt = ConditionStatus::where('status', $rnt['rnt']['status'])->where('kondisi', $rnt['rnt']['kondisi'])->first('id');
        } else if(isset($rnt['rnt']['status']) || isset($rnt['rnt']['kondisi'])) {
            if (isset($rnt['rnt']['status']) && $rnt['rnt']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Rantai 1/2" 2X10 M Derek Besar';
            }  else if(isset($rnt['rnt']['kondisi'])){
                $errors[] = 'Harap Isi Status Rantai 1/2" 2X10 M Derek Besar';
        }
            else   {
                $rnt = ConditionStatus::where('status', $rnt['rnt']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Rantai 1/2" 2X10 M Derek Besar';
            }

        $tsg['tsg'] = $request->input('tsg');
        if (isset($tsg['tsg']['status']) && isset($tsg['tsg']['kondisi'])) {
            $tsg = ConditionStatus::where('status', $tsg['tsg']['status'])->where('kondisi', $tsg['tsg']['kondisi'])->first('id');
        } else if(isset($tsg['tsg']['status']) || isset($tsg['tsg']['kondisi'])) {
            if (isset($tsg['tsg']['status']) && $tsg['tsg']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Tali Sling Derek Besar';
            }  else if(isset($tsg['tsg']['kondisi'])){
                $errors[] = 'Harap Isi Status Tali Sling Derek Besar';
        }
            else  {
                $tsg = ConditionStatus::where('status', $tsg['tsg']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Tali Sling Derek Besar';
            }

        $rbs['rbs'] = $request->input('rbs');
        if (isset($rbs['rbs']['status']) && isset($rbs['rbs']['kondisi'])) {
            $rbs = ConditionStatus::where('status', $rbs['rbs']['status'])->where('kondisi', $rbs['rbs']['kondisi'])->first('id');
        } else if(isset($rbs['rbs']['status']) || isset($rbs['rbs']['kondisi'])) {
            if (isset($rbs['rbs']['status']) && $rbs['rbs']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Rantai Besi Derek Besar';
            }  else if(isset($rbs['rbs']['kondisi'])){
                $errors[] = 'Harap Isi Status Rantai Besi Derek Besar';
        }
            else  {
                $rbs = ConditionStatus::where('status', $rbs['rbs']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Rantai Besi Derek Besar';
            }

        $sgl['sgl'] = $request->input('sgl');
        if (isset($sgl['sgl']['status']) && isset($sgl['sgl']['kondisi'])) {
            $sgl = ConditionStatus::where('status', $sgl['sgl']['status'])->where('kondisi', $sgl['sgl']['kondisi'])->first('id');
        } else if (isset($sgl['sgl']['status']) || isset($sgl['sgl']['kondisi'])){
            if (isset($sgl['sgl']['status']) && $sgl['sgl']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Segel Derek Besar';
            }  else if(isset($sgl['sgl']['kondisi'])){
                $errors[] = 'Harap Isi Status Segel Derek Besar';
        }
            else   {
                $sgl = ConditionStatus::where('status', $sgl['sgl']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Segel Derek Besar';
            }
            
        $skr['skr'] = $request->input('skr');
        if (isset($skr['skr']['status']) && isset($skr['skr']['kondisi'])) {
            $skr = ConditionStatus::where('status', $skr['skr']['status'])->where('kondisi', $skr['skr']['kondisi'])->first('id');
        } else if (isset($skr['skr']['status']) || isset($skr['skr']['kondisi'])){
            if (isset($skr['skr']['status']) && $skr['skr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Selang Kompor Derek Besar';
            }  else if(isset($skr['skr']['kondisi'])){
                $errors[] = 'Harap Isi Status Selang Kompor Derek Besar';
        }
            else   {
                $skr = ConditionStatus::where('status', $skr['skr']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Selang Kompor Derek Besar';
            }
            
       $hmdb['hmdb'] = $request->input('hmdb');
        if (isset($hmdb['hmdb']['status']) && isset($hmdb['hmdb']['kondisi'])) {
            $hmdb = ConditionStatus::where('status', $hmdb['hmdb']['status'])->where('kondisi', $hmdb['hmdb']['kondisi'])->first('id');
        } else if(isset($hmdb['hmdb']['status']) || isset($hmdb['hmdb']['kondisi'])) {
            if (isset($hmdb['hmdb']['status']) && $hmdb['hmdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Helm Derek Besar';
            }  else if(isset($hmdb['hmdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Helm Derek Besar';
        }
            else   {
                $hmdb = ConditionStatus::where('status', $hmdb['hmdb']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Helm Derek Besar';
            }

       $jhdb['jhdb'] = $request->input('jhdb');
        if (isset($jhdb['jhdb']['status']) && isset($jhdb['jhdb']['kondisi'])) {
            $jhdb = ConditionStatus::where('status', $jhdb['jhdb']['status'])->where('kondisi', $jhdb['jhdb']['kondisi'])->first('id');
        } else if(isset($jhdb['jhdb']['status']) || isset($jhdb['jhdb']['kondisi'])) {
            if (isset($jhdb['jhdb']['status']) && $jhdb['jhdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Jas Hujan Derek Besar';
            }  else if(isset($jhdb['jhdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Jas Hujan Derek Besar';
        }
            else   {
                $jhdb = ConditionStatus::where('status', $jhdb['jhdb']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Jas Hujan Derek Besar';
            }

        $stdb['stdb'] = $request->input('stdb');
        // dd($stdb['stdb']);
        if (isset($stdb['stdb']['status']) && isset($stdb['stdb']['kondisi'])) {
            $stdb = ConditionStatus::where('status', $stdb['stdb']['status'])->where('kondisi', $stdb['stdb']['kondisi'])->first('id');
        } else if(isset($stdb['stdb']['status']) || isset($stdb['stdb']['kondisi'])) {
            if (isset($stdb['stdb']['status']) && $stdb['stdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Sarung Tangan Derek Besar';
            }  else if(isset($stdb['stdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Sarung Tangan Derek Besar';
        }
            else   {
                $stdb = ConditionStatus::where('status', $stdb['stdb']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Sarung Tangan Derek Besar';
            }

        $sbt['sbt'] = $request->input('sbt');
        if (isset($sbt['sbt']['status']) && isset($sbt['sbt']['kondisi'])) {
            $sbt = ConditionStatus::where('status', $sbt['sbt']['status'])->where('kondisi', $sbt['sbt']['kondisi'])->first('id');
        } else if(isset($sbt['sbt']['status']) || isset($sbt['sbt']['kondisi'])) {
            if (isset($sbt['sbt']['status']) && $sbt['sbt']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Sepatu Boat Derek Besar';
            }  else if(isset($sbt['sbt']['kondisi'])){
                $errors[] = 'Harap Isi Status Sepatu Boat Derek Besar';
        }
            else   {
                $sbt = ConditionStatus::where('status', $sbt['sbt']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Sepatu Boat Derek Besar';
            }
            
            
        $scr['scr'] = $request->input('scr');
        if (isset($scr['scr']['status']) && isset($scr['scr']['kondisi'])) {
            $scr = ConditionStatus::where('status', $scr['scr']['status'])->where('kondisi', $scr['scr']['kondisi'])->first('id');
        } else if(isset($scr['scr']['status']) || isset($scr['scr']['kondisi'])) {
            if (isset($scr['scr']['status']) && $scr['scr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Senter Charge Derek Besar';
            }  else if(isset($scr['scr']['kondisi'])){
                $errors[] = 'Harap Isi Status Senter Charge Derek Besar';
        }
            else   {
                $scr = ConditionStatus::where('status', $scr['scr']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Senter Charge Derek Besar';
            }

            
        $kprdb['kprdb'] = $request->input('kprdb');
        if(empty( $kprdb['kprdb'])){
            $errors[] = 'Harap Isi Keterangan Peralatan Derek Besar' ;
        }

        $ecdb['ecdb'] = $request->input('ecdb');
        if (isset($ecdb['ecdb']['status']) && isset($ecdb['ecdb']['kondisi'])) {
            $ecdb = ConditionStatus::where('status', $ecdb['ecdb']['status'])->where('kondisi', $ecdb['ecdb']['kondisi'])->first('id');
        } else if(isset($ecdb['ecdb']['status']) || isset($ecdb['ecdb']['kondisi'])){
            if (isset($ecdb['ecdb']['status']) && $ecdb['ecdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Engine Condition Derek Besar';
            }  else if(isset($ecdb['ecdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Engine Condition Derek Besar';
        }
            else {
                $ecdb = ConditionStatus::where('status', $ecdb['ecdb']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Engine Condition Derek Besar';          
              }

        $rtdb['rtdb'] = $request->input('rtdb');
        if (isset($rtdb['rtdb']['status']) && isset($rtdb['rtdb']['kondisi'])) {
            $rtdb = ConditionStatus::where('status', $rtdb['rtdb']['status'])->where('kondisi', $rtdb['rtdb']['kondisi'])->first('id');
        } else if (isset($rtdb['rtdb']['status']) || isset($rtdb['rtdb']['kondisi'])){
            if (isset($rtdb['rtdb']['status']) && $rtdb['rtdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Running Test Derek Besar';
            }  else if(isset($rtdb['rtdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Running Test Derek Besar';
        }
            else {
                $rtdb = ConditionStatus::where('status', $rtdb['rtdb']['status'])->first('id');
            }
        }  
           else{
                $errors[] ='Harap Isi Running Test Derek Besar';
            }

            
        $acudb['acudb'] = $request->input('acudb');
        if (isset($acudb['acudb']['status']) && isset($acudb['acudb']['kondisi'])) {
            $acudb = ConditionStatus::where('status', $acudb['acudb']['status'])->where('kondisi', $acudb['acudb']['kondisi'])->first('id');
        } else if (isset($acudb['acudb']['status']) || isset($acudb['acudb']['kondisi'])){
            if (isset($acudb['acudb']['status']) && $acudb['acudb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Air Accu Derek Besar';
            }  else if(isset($acudb['acudb']['kondisi'])){
                $errors[] = 'Harap Isi Status Air Accu Derek Besar';
        }
            else  {
                $acudb = ConditionStatus::where('status', $acudb['acudb']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Air Accu Derek Besar';
            }


        $arrdb['arrdb'] = $request->input('arrdb');
        if (isset($arrdb['arrdb']['status']) && isset($arrdb['arrdb']['kondisi'])) {
            $arrdb = ConditionStatus::where('status', $arrdb['arrdb']['status'])->where('kondisi', $arrdb['arrdb']['kondisi'])->first('id');
        } else if  (isset($arrdb['arrdb']['status']) || isset($arrdb['arrdb']['kondisi'])){
            if (isset($arrdb['arrdb']['status']) && $arrdb['arrdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Air Radiator Derek Vesar';
            }  else if(isset($arrdb['arrdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Air Radiator Derek Vesar';
        }
            else {
                $arrdb = ConditionStatus::where('status', $arrdb['arrdb']['status'])->first('id');
            }
        }  
          else{
                $errors[] = 'Harap Isi Air Radiator Derek Vesar';           
             }


        $omndb['omndb'] = $request->input('omndb');
        if (isset($omndb['omndb']['status']) && isset($omndb['omndb']['kondisi'])) {
            $omndb = ConditionStatus::where('status', $omndb['omndb']['status'])->where('kondisi', $omndb['omndb']['kondisi'])->first('id');
        } else if(isset($omndb['omndb']['status']) || isset($omndb['omndb']['kondisi'])){
            if (isset($omndb['omndb']['status']) && $omndb['omndb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Oli Mesin Derek Besar';
            }  else if(isset($omndb['omndb']['kondisi'])){
                $errors[] = 'Harap Isi Status Oli Mesin Derek Besar';
        }
            else  {
                $omndb = ConditionStatus::where('status', $omndb['omndb']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Oli Mesin Derek Besar';
            }

        $mrdb['mrdb'] = $request->input('mrdb');
        if (isset($mrdb['mrdb']['status']) && isset($mrdb['mrdb']['kondisi'])) {
            $mrdb = ConditionStatus::where('status', $mrdb['mrdb']['status'])->where('kondisi', $mrdb['mrdb']['kondisi'])->first('id');
        } else if (isset($mrdb['mrdb']['status']) || isset($mrdb['mrdb']['kondisi'])){
            if (isset($mrdb['mrdb']['status']) && $mrdb['mrdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Minyak Rem Derek Besar';
            }  else if(isset($mrdb['mrdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Minyak Rem Derek Besar';
        }
            else   {
                $mrdb = ConditionStatus::where('status', $mrdb['mrdb']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Minyak Rem Derek Besar';
            }

        $opsdb['opsdb'] = $request->input('opsdb');
        if (isset($opsdb['opsdb']['status']) && isset($opsdb['opsdb']['kondisi'])) {
            $opsdb = ConditionStatus::where('status', $opsdb['opsdb']['status'])->where('kondisi', $opsdb['opsdb']['kondisi'])->first('id');
        } else if(isset($opsdb['opsdb']['status']) || isset($opsdb['opsdb']['kondisi'])) {
            if (isset($opsdb['opsdb']['status']) && $opsdb['opsdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Oil Power Steering Derek Besar';
            }  else if(isset($opsdb['opsdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Oil Power Steering Derek Besar';
        }
            else {
                $opsdb = ConditionStatus::where('status', $opsdb['opsdb']['status'])->first('id');
            }
        }  
          else{
                $errors[] = 'Harap Isi Oil Power Steering Derek Besar';
            }

        $keengdb['keengdb'] = $request->input('keengdb');
        if(empty( $keengdb['keengdb'])){
            $errors[] = 'Harap Isi Keterangan Engine Derek Besar' ;
        }

        $skidb['skidb'] = $request->input('skidb');
        if (isset($skidb['skidb']['status']) && isset($skidb['skidb']['kondisi'])) {
            $skidb = ConditionStatus::where('status', $skidb['skidb']['status'])->where('kondisi', $skidb['skidb']['kondisi'])->first('id');
        } else if (isset($skidb['skidb']['status']) || isset($skidb['skidb']['kondisi'])){
            if (isset($skidb['skidb']['status']) && $skidb['skidb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Samping Kiri Derek Besar';
            }  else if(isset($skidb['skidb']['kondisi'])){
                $errors[] = 'Harap Isi Status Samping Kiri Derek Besar';
        }
            else  {
                $skidb = ConditionStatus::where('status', $skidb['skidb']['status'])->first('id');
            }
        }  
        else{
                $errors[] = 'Harap Isi Samping Kiri Derek Besar';
            }

        $skadb['skadb'] = $request->input('skadb');
        if (isset($skadb['skadb']['status']) && isset($skadb['skadb']['kondisi'])) {
            $skadb = ConditionStatus::where('status', $skadb['skadb']['status'])->where('kondisi', $skadb['skadb']['kondisi'])->first('id');
        } else if (isset($skadb['skadb']['status']) || isset($skadb['skadb']['kondisi'])){
            if (isset($skadb['skadb']['status']) && $skadb['skadb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Samping Kanan Derek Besar';
            }  else if(isset($skadb['skadb']['kondisi'])){
                $errors[] = 'Harap Isi Status Samping Kanan Derek Besar';
        }
            else {
                $skadb = ConditionStatus::where('status', $skadb['skadb']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Samping Kanan Derek Besar';
            }

        $dpndb['dpndb'] = $request->input('dpndb');
        if (isset($dpndb['dpndb']['status']) && isset($dpndb['dpndb']['kondisi'])) {
            $dpndb = ConditionStatus::where('status', $dpndb['dpndb']['status'])->where('kondisi', $dpndb['dpndb']['kondisi'])->first('id');
        } else if(isset($dpndb['dpndb']['status']) || isset($dpndb['dpndb']['kondisi'])) {
            if (isset($dpndb['dpndb']['status']) && $dpndb['dpndb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Depan Derek Besar';
            }  else if(isset($dpndb['dpndb']['kondisi'])){
                $errors[] = 'Harap Isi Status Depan Derek Besar';
        }
            else  {
                $dpndb = ConditionStatus::where('status', $dpndb['dpndb']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Depan Derek Besar';
            }

        $blgdb['blgdb'] = $request->input('blgdb');
        if (isset($blgdb['blgdb']['status']) && isset($blgdb['blgdb']['kondisi'])) {
            $blgdb = ConditionStatus::where('status', $blgdb['blgdb']['status'])->where('kondisi', $blgdb['blgdb']['kondisi'])->first('id');
        } else if (isset($blgdb['blgdb']['status']) || isset($blgdb['blgdb']['kondisi'])) {
            if (isset($blgdb['blgdb']['status']) && $blgdb['blgdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Belakang Derek Besar';
            }  else if(isset($blgdb['blgdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Belakang Derek Besar';
        }
            else  {
                $blgdb = ConditionStatus::where('status', $blgdb['blgdb']['status'])->first('id');
            }
        }  
          else{
                $errors[] = 'Harap Isi Belakang Derek Besar';
            }

        $atsdb['atsdb'] = $request->input('atsdb');
        if (isset($atsdb['atsdb']['status']) && isset($atsdb['atsdb']['kondisi'])) {
            $atsdb = ConditionStatus::where('status', $atsdb['atsdb']['status'])->where('kondisi', $atsdb['atsdb']['kondisi'])->first('id');
        } else if(isset($atsdb['atsdb']['status']) || isset($atsdb['atsdb']['kondisi'])) {
            if (isset($atsdb['atsdb']['status']) && $atsdb['atsdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Atas Derek Besar';
            }  else if(isset($atsdb['atsdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Atas Derek Besar';
        }
            else {
                $atsdb = ConditionStatus::where('status', $atsdb['atsdb']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Atas Derek Besar';
            }
       
        $kbdcdb['kbdcdb'] = $request->input('kbdcdb');
        if(empty( $kbdcdb['kbdcdb'])){
            $errors[] = 'Harap Isi Keterangan Body dan Cat Derek Besar' ;
        }
    
        
        if (count($errors) > 0) {
            // If there are errors, redirect back with the input data and errors.
            return redirect()->back()->withInput()->withErrors($errors);
        }

        $today =Carbon::now(); 
        $date = $today->toDateString();
        $data = new DerekKecilVehicleLog;
        $data->personil = (int)$request->personil;
        $request->session()->put('personilDerek',$request->personil);
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
        $data->lampu_kabut = $lk->id;
        $data->radio_tape = $rt->id;
        $data->klakson = $kl->id;
        $data->wiper = $wp->id;
        $data->speaker = $spr->id;
        $data->seat_belt = $sb->id;
        $data->	ket_bagian_dalam = $request->kbd;;
        $data->dongkrak_hidrolik_20_ton = $dh->id;
        $data->tangki_oli_hidrolik = $toh->id;
        $data->winch_warm_5_ton = $ww->id;
        $data->kait_hook = $kh->id;
        $data->kunci_roda = $kr->id;
        $data->dongkrak_buaya = $db->id;
        $data->p3k = $p3k->id;
        $data->sarung_tangan = $st->id;
        $data->helm = $hm->id;
        $data->jas_hujan = $jh->id;
        $data->ket_peralatan = $request->kpr;
        $data->public_adress = $pa->id;
        $data->lampu_rotary = $lsb->id;
        $data->webbing_sling  = $ws->id;
        $data->parking_shock = $ps->id;
        $data->segel = $sl->id;
        $data->ket_peralatan_tambahan = $request->kpt;
        $data->engine_condition  = $ec->id;
        $data->running_test = $rt->id;
        $data->air_accu = $acu->id;
        $data->air_radiator = $arr->id;
        $data-> oli_mesin= $omn->id;
        $data->apar = $apr->id;
        $data->minyak_rem = $mr->id;
        $data->oil_power_steering = $ops->id;
        $data->ket_engine = $request->keeng;
        $data->samping_kiri = $ski->id;
        $data->samping_kanan = $ska->id;
        $data->depan = $dpn->id;
        $data->belakang = $blg->id;
        $data->atas = $ats->id;
        $data->ket_body_cat = $request->kbdc;
        $data->unit = Auth::user()->nama.'k'.'-'.$date;
        $data->save();


       

        $data2 = new DerekBesarVehicleLog;
        $data2->personil = (int)$request->personil;
        $request->session()->put('personilDerek',$request->personil);
        $data2->shift = $request->shift;
        $data2->km_awal = $request->odo2;
        $data2->ban_kanan_depan = $bkaddb->id;
        $data2->ban_kanan_belakang = $bkabdb->id;
        $data2->ban_kiri_depan = $bkiddb->id;
        $data2->ban_kiri_belakang = $bkibdb->id;
        $data2->ban_serep = $bsdb->id;
        $data2->ket_roda_ban =$request->kbrdbdb;
        $data2->stnk = $stnkdb->id;
        $data2->lampu_dashboard = $ldbdb->id;
        $data2->lampu_depan = $ldpdb->id;
        $data2->lampu_belakang = $lbgdb->id;
        $data2->lampu_rem = $lrdb->id;
        $data2->lampu_sein = $lsndb->id;
        $data2->lampu_mundur = $lmdb->id;
        $data2->lampu_kabut = $lktdb->id;
        $data2->lampu_strobo = $lsbdb->id;
        $data2->lampu_sorot = $lpsrdb->id;    
        $data2->air_conditioner= $acdb->id;    
        $data2->klakson = $kldb->id;
        $data2->wiper = $wpdb->id;
        $data2->seat_belt = $sbdb->id;
        $data2->apar = $apardb->id;
        $data2->ket_bagian_dalam = $request->kbd;;
        $data2->balok = $blk->id;
        $data2->p3k = $p3kdb->id;
        $data2->katrol = $ktrl->id;
        $data2->dongkrak_hidrolik_20_ton = $dht->id;
        $data2->kunci_shock= $ks->id;
        $data2->kunci_moment= $km->id;
        $data2->kunci_pipa= $kp->id;
        $data2->rantai_m= $rnt->id;
        $data2->tali_sling= $tsg->id;
        $data2->rantai_besi= $rbs->id;
        $data2->segel= $sgl->id;
        $data2->selang_kompresor= $skr->id;
        $data2->helm = $hmdb->id;
        $data2->jas_hujan = $jhdb->id;
        $data2->sarung_tangan = $stdb->id;
        $data2->sepatu_boat = $sbt->id;
        $data2->senter_charge = $scr->id;
        $data2->ket_peralatan = $request->kprdb;
        $data2->engine_condition  = $ecdb->id;
        $data2->running_test = $rtdb->id;
        $data2->air_accu = $acudb->id;
        $data2->air_radiator = $arrdb->id;
        $data2->oli_mesin = $omndb->id;
        $data2->minyak_rem = $mrdb->id;
        $data2->oil_power_steering = $opsdb->id;
        $data2->ket_engine = $request->keeng;
        $data2->samping_kiri = $skidb->id;
        $data2->samping_kanan = $skadb->id;
        $data2->depan = $dpndb->id;
        $data2->belakang = $blgdb->id;
        $data2->atas = $atsdb->id;
        $data2->ket_body_cat = $request->kbdcdb;
        $data2->unit = Auth::user()->nama.'b'.'-'.$date;
        $data2->save();

        Session::flash('message', Lang::get('Data Berhasil Masuk'));
        return redirect()->route('dashboard-lalin.index');
    
    }

    public function exportDerekKecil($id)
    {
        try {
            $cek = DerekKecilVehicleLog::where('id',$id)
            ->first();

        if ($cek) {
            $date = $cek->created_at;
        }
    
            $data = DerekKecilVehicleLog::whereBetween('shift',[1,3])
                ->where('unit', $cek->unit)
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
        $pdf = Pdf::loadView('pdf.pemeriksaan-kendaraan-derek-kecil', compact('data'));

        return $pdf->stream('Log Kelengkapan Derek Kecil' . '.pdf');
    }
    public function exportDerekBesar($id)
    {
        try {
            $cek = DerekBesarVehicleLog::where('id',$id)
            ->first();

        if ($cek) {
            $date = $cek->created_at;
        }
    
            $data = DerekBesarVehicleLog::whereBetween('shift',[1,3])
                ->where('unit', $cek->unit)
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
        $pdf = Pdf::loadView('pdf.pemeriksaan-kendaraan-derek-besar', compact('data'));

        return $pdf->stream('Log Kelengkapan Derek Besar' . '.pdf');
    }
         public function edit($id)
    {
    
       $datasKecil = DerekKecilVehicleLog::find($id);
       $datasBesar = DerekBesarVehicleLog::find($id);
        $categories = Category::where('operasional_id', 2)->get();
        $personil = Officer::where('id', $datasBesar->personil)->first();
        return view("pages.derek.log-kelengkapan-kendaraan.edit")->with(compact('categories', 'datasKecil','datasBesar', 'personil'));
        
    }
     public function update(Request $request,$id){   
        $errors = array();
   
        $personil['personil'] = $request->input('personil');
        if(empty( $personil['personil'])){
            $errors[] = 'Harap Isi Personil' ;
        }

        $odo['odo'] = $request->input('odo');
        if(empty( $odo['odo'])){
            $errors[] = 'Harap Isi Odo Meter' ;
        }

        //derek kecil
        $bkad['bkad'] = $request->input('bkad');
        // dd(count($bkad['bkad']));
        if (isset($bkad['bkad']['status']) && isset($bkad['bkad']['kondisi'])) {
            $bkad = ConditionStatus::where('status', $bkad['bkad']['status'])->where('kondisi', $bkad['bkad']['kondisi'])->first('id');
        } 
        else if(isset($bkad['bkad']['status']) || isset($bkad['bkad']['kondisi'])) {
            if (isset($bkad['bkad']['status']) && $bkad['bkad']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Kanan Depan Derek Kecil';
            }else if (isset($bkad['bkad']['kondisi']) && $bkad['bkad']['kondisi'] == 1){
                $errors[] = 'Harap Isi Status Ban Kanan Depan Derek Kecil';
            } 
            else  {
        $bkad = ConditionStatus::where('status', $bkad['bkad']['status'])->first('id');
    }   
        }
          else {
        $errors[] = 'Harap Isi Ban Kanan Depan Derek Kecil';
        }  
        
        $bkab['bkab'] = $request->input('bkab');
        if (isset($bkab['bkab']['status']) && isset($bkab['bkab']['kondisi'])) {
            $bkab = ConditionStatus::where('status', $bkab['bkab']['status'])->where('kondisi', $bkab['bkab']['kondisi'])->first('id');
        } else if(isset($bkab['bkab']['status']) || isset($bkab['bkab']['kondisi'])) {
           if (isset($bkab['bkab']['status']) && $bkab['bkab']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Kanan Belakang Derek Kecil';
            }else if(isset($bkab['bkab']['kondisi']) && $bkab['bkab']['kondisi'] == 1){
                $errors[] = 'Harap Isi Status Ban Kanan Belakang Derek Kecil';
            } 
            else{
                $bkab = ConditionStatus::where('status', $bkab['bkab']['status'])->first('id');
            }
        }
             else {
        $errors[] = 'Harap Isi Ban Kanan Belakang Derek Kecil';
        }  

        $bkid['bkid'] = $request->input('bkid');
        if (isset($bkid['bkid']['status']) && isset($bkid['bkid']['kondisi'])) {
            $bkid = ConditionStatus::where('status', $bkid['bkid']['status'])->where('kondisi', $bkid['bkid']['kondisi'])->first('id');
        } else if (isset($bkid['bkid']['status']) || isset($bkid['bkid']['kondisi'])) {
            if (isset($bkid['bkid']['status']) && $bkid['bkid']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Kiri Depan Derek Kecil';
            }  else if(isset($bkid['bkid']['kondisi'])){
                $errors[] = 'Harap Isi Status Ban Kiri Depan Derek Kecil';
            }
            else   {
                $bkid = ConditionStatus::where('status', $bkid['bkid']['status'])->first('id');
            }
        } 
           else{
                $errors[] ='Harap Isi Ban Kiri Depan Derek Kecil';
            } 

        $bkib['bkib'] = $request->input('bkib');
        if (isset($bkib['bkib']['status']) && isset($bkib['bkib']['kondisi'])) {
            $bkib = ConditionStatus::where('status', $bkib['bkib']['status'])->where('kondisi', $bkib['bkib']['kondisi'])->first('id');
        } else if(isset($bkib['bkib']['status']) || isset($bkib['bkib']['kondisi'])){
            if (isset($bkib['bkib']['status']) && $bkib['bkib']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Kiri Belakang Derek Kecil';
            }  else if(isset($bkib['bkib']['kondisi'])){
                $errors[] = 'Harap Isi Status Ban Kiri Belakang Derek Kecil';
            }
            else {
                $bkib = ConditionStatus::where('status', $bkib['bkib']['status'])->first('id');
            }
        } 
         else{
                $errors[] = 'Harap Isi Ban Kiri Belakang Derek Kecil';
            } 

        $bs['bs'] = $request->input('bs');
        if (isset($bs['bs']['status']) && isset($bs['bs']['kondisi'])) {
            $bs = ConditionStatus::where('status', $bs['bs']['status'])->where('kondisi', $bs['bs']['kondisi'])->first('id');
        } else if (isset($bs['bs']['status']) || isset($bs['bs']['kondisi'])) {
            if (isset($bs['bs']['status']) && $bs['bs']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Serep Derek Keci';
            }  else if(isset($bs['bs']['kondisi'])){
                $errors[] = 'Harap Isi Status Ban Serep Derek Keci';
            }
            else  {
                $bs = ConditionStatus::where('status', $bs['bs']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Ban Serep Derek Keci';
            } 

        $vrd['vrd'] = $request->input('vrd');
        if (isset($vrd['vrd']['status']) && isset($vrd['vrd']['kondisi'])) {
            $vrd = ConditionStatus::where('status', $vrd['vrd']['status'])->where('kondisi', $vrd['vrd']['kondisi'])->first('id');
        } else if(isset($vrd['vrd']['status']) || isset($vrd['vrd']['kondisi'])) {
            if (isset($vrd['vrd']['status']) && $vrd['vrd']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Velg Roda & Drop Derek Kecil';
            }  else if(isset($vrd['vrd']['kondisi'])){
                $errors[] = 'Harap Isi Status Velg Roda & Drop Derek Kecil';
            }
            else {
                $vrd = ConditionStatus::where('status', $vrd['vrd']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Velg Roda & Drop Derek Kecil';
            } 

        $kbrdb['kbrdb'] = $request->input('kbrdb');
        if(empty( $kbrdb['kbrdb'])){
            $errors[] = 'Harap Isi Keterangan Roda dan Ban Derek Kecil' ;
        }
    

        $stnk['stnk'] = $request->input('stnk');
        if (isset($stnk['stnk']['status']) && isset($stnk['stnk']['kondisi'])) {
            $stnk = ConditionStatus::where('status', $stnk['stnk']['status'])->where('kondisi', $stnk['stnk']['kondisi'])->first('id');
        } else if (isset($stnk['stnk']['status']) || isset($stnk['stnk']['kondisi'])) {
            if (isset($stnk['stnk']['status']) && $stnk['stnk']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi STNK Derek Kecil';
            }  else if(isset($stnk['stnk']['kondisi'])){
                $errors[] = 'Harap Isi Status STNK Derek Kecil';
            }
            else  {
                $stnk = ConditionStatus::where('status', $stnk['stnk']['status'])->first('id');
            }
        } 
        else{
                $errors[] ='Harap Isi STNK Derek Kecil';
            } 

        $ldb['ldb'] = $request->input('ldb');
        if (isset($ldb['ldb']['status']) && isset($ldb['ldb']['kondisi'])) {
            $ldb = ConditionStatus::where('status', $ldb['ldb']['status'])->where('kondisi', $ldb['ldb']['kondisi'])->first('id');
        } else if(isset($ldb['ldb']['status']) || isset($ldb['ldb']['kondisi'])) {
            if (isset($ldb['ldb']['status']) && $ldb['ldb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Dashboard Derek Kecil';
            }  else if(isset($ldb['ldb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Dashboard Derek Kecil';
            }
            else {
                $ldb = ConditionStatus::where('status', $ldb['ldb']['status'])->first('id');
            }
        } 
         else{
                $errors[] = 'Harap Isi Lampu Dashboard Derek Kecil';
            } 
            
        $ldp['ldp'] = $request->input('ldp');
        if (isset($ldp['ldp']['status']) && isset($ldp['ldp']['kondisi'])) {
            $ldp = ConditionStatus::where('status', $ldp['ldp']['status'])->where('kondisi', $ldp['ldp']['kondisi'])->first('id');
        } else if(isset($ldp['ldp']['status']) || isset($ldp['ldp']['kondisi'])) {
            if (isset($ldp['ldp']['status']) && $ldp['ldp']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Depan Derek Kecil';
            }  else if(isset($ldp['ldp']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Depan Derek Kecil';
            }
            else {
                $ldp = ConditionStatus::where('status', $ldp['ldp']['status'])->first('id');
            }
        } 
            else{
                $errors[] = 'Harap Isi Lampu Depan Derek Kecil';
            }

        $lbg['lbg'] = $request->input('lbg');
        if (isset($lbg['lbg']['status']) && isset($lbg['lbg']['kondisi'])) {
            $lbg = ConditionStatus::where('status', $lbg['lbg']['status'])->where('kondisi', $lbg['lbg']['kondisi'])->first('id');
        } else if(isset($lbg['lbg']['status']) || isset($lbg['lbg']['kondisi'])) {
            if (isset($lbg['lbg']['status']) && $lbg['lbg']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Belakang Derek Kecil';
            }  else if(isset($lbg['lbg']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Belakang Derek Kecil';
            }
            else   {
                $lbg = ConditionStatus::where('status', $lbg['lbg']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Lampu Belakang Derek Kecil';
            }
        $lr['lr'] = $request->input('lr');

        if (isset($lr['lr']['status']) && isset($lr['lr']['kondisi'])) {
            $lr = ConditionStatus::where('status', $lr['lr']['status'])->where('kondisi', $lr['lr']['kondisi'])->first('id');
        } else if (isset($lr['lr']['status']) || isset($lr['lr']['kondisi'])){
            if (isset($lr['lr']['status']) && $lr['lr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Rem Derek Kecil';
            }  else if(isset($lr['lr']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Rem Derek Kecil';
        }
            else  {
                $lr = ConditionStatus::where('status', $lr['lr']['status'])->first('id');
            }
        }  
           else{
                $errors[] = 'Harap Isi Lampu Rem Derek Kecil';
            }

        $lsn['lsn'] = $request->input('lsn');
        if (isset($lsn['lsn']['status']) && isset($lsn['lsn']['kondisi'])) {
            $lsn = ConditionStatus::where('status', $lsn['lsn']['status'])->where('kondisi', $lsn['lsn']['kondisi'])->first('id');
        } else if(isset($lsn['lsn']['status']) || isset($lsn['lsn']['kondisi'])) {
            if (isset($lsn['lsn']['status']) && $lsn['lsn']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Sein Derek Kecil';
            }  else if(isset($lsn['lsn']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Sein Derek Kecil';
        }
            else  {
                $lsn = ConditionStatus::where('status', $lsn['lsn']['status'])->first('id');
            }
        } 
         else{
                $errors[] = 'Harap Isi Lampu Sein Derek Kecil';
            }

        $lm['lm'] = $request->input('lm');
        if (isset($lm['lm']['status']) && isset($lm['lm']['kondisi'])) {
            $lm = ConditionStatus::where('status', $lm['lm']['status'])->where('kondisi', $lm['lm']['kondisi'])->first('id');
        } else if (isset($lm['lm']['status']) || isset($lm['lm']['kondisi'])) {
            if (isset($lm['lm']['status']) && $lm['lm']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Mundur Derek Kecil';
            }  else if(isset($lm['lm']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Mundur Derek Kecil';
        }
            else  {
                $lm = ConditionStatus::where('status', $lm['lm']['status'])->first('id');
            }
        } 
          else{
                $errors[]= 'Harap Isi Lampu Mundur Derek Kecil';
            }

        $lk['lk'] = $request->input('lk');
        if (isset($lk['lk']['status']) && isset($lk['lk']['kondisi'])) {
            $lk = ConditionStatus::where('status', $lk['lk']['status'])->where('kondisi', $lk['lk']['kondisi'])->first('id');
        } else if (isset($lk['lk']['status']) || isset($lk['lk']['kondisi'])) {
            if (isset($lk['lk']['status']) && $lk['lk']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Kabut Derek Kecil';
            }  else if(isset($lk['lk']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Kabut Derek Kecil';
        }
            else  {
                $lk = ConditionStatus::where('status', $lk['lk']['status'])->first('id');
            }
        } 
          else{
                $errors[]= 'Harap Isi Lampu Kabut Derek Kecil';
            }

        $rt['rt'] = $request->input('rt');
        if (isset($rt['rt']['status']) && isset($rt['rt']['kondisi'])) {
            $rt = ConditionStatus::where('status', $rt['rt']['status'])->where('kondisi', $rt['rt']['kondisi'])->first('id');
        } else if(isset($rt['rt']['status']) || isset($rt['rt']['kondisi'])) {
            if (isset($rt['rt']['status']) && $rt['rt']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Radio/Tape Derek Kecil';
            }  else if(isset($rt['rt']['kondisi'])){
                $errors[] = 'Harap Isi Status Radio/Tape Derek Kecil';
        }
            else  {
                $rt = ConditionStatus::where('status', $rt['rt']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Radio/Tape Derek Kecil';
            }

            
        $kl['kl'] = $request->input('kl');
        if (isset($kl['kl']['status']) && isset($kl['kl']['kondisi'])) {
            $kl = ConditionStatus::where('status', $kl['kl']['status'])->where('kondisi', $kl['kl']['kondisi'])->first('id');
        } else if (isset($kl['kl']['status']) || isset($kl['kl']['kondisi'])){
            if (isset($kl['kl']['status']) && $kl['kl']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Klakson Derek Kecil';
            }  else if(isset($kl['kl']['kondisi'])){
                $errors[] = 'Harap Isi Status Klakson Derek Kecil';
        }
            else  {
                $kl = ConditionStatus::where('status', $kl['kl']['status'])->first('id');
            }
        }  
           else{
                $errors[] ='Harap Isi Klakson Derek Kecil';
            }

        $wp['wp'] = $request->input('wp');
        if (isset($wp['wp']['status']) && isset($wp['wp']['kondisi'])) {
            $wp = ConditionStatus::where('status', $wp['wp']['status'])->where('kondisi', $wp['wp']['kondisi'])->first('id');
        } else if (isset($wp['wp']['status']) || isset($wp['wp']['kondisi'])) {
            if (isset($wp['wp']['status']) && $wp['wp']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Wiper Derek Kecil';
            }  else if(isset($wp['wp']['kondisi'])){
                $errors[] = 'Harap Isi Status Wiper Derek Kecil';
        }
            else  {
                $wp = ConditionStatus::where('status', $wp['wp']['status'])->first('id');
            }  
        } 
         else{
                $errors[] ='Harap Isi Wiper Derek Kecil';
            }

        $spr['spr'] = $request->input('spr');
        if (isset($spr['spr']['status']) && isset($spr['spr']['kondisi'])) {
            $spr = ConditionStatus::where('status', $spr['spr']['status'])->where('kondisi', $spr['spr']['kondisi'])->first('id');
        } else if(isset($spr['spr']['status']) || isset($spr['spr']['kondisi'])) {
            if (isset($spr['spr']['status']) && $spr['spr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Speaker Derek Kecil';
            }  else if(isset($spr['spr']['kondisi'])){
                $errors[] = 'Harap Isi Status Speaker Derek Kecil';
        }
            else  {
                $spr = ConditionStatus::where('status', $spr['spr']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Speaker Derek Kecil';
            }

        $sb['sb'] = $request->input('sb');
        if (isset($sb['sb']['status']) && isset($sb['sb']['kondisi'])) {
            $sb = ConditionStatus::where('status', $sb['sb']['status'])->where('kondisi', $sb['sb']['kondisi'])->first('id');
        } else if (isset($sb['sb']['status']) || isset($sb['sb']['kondisi']))  {
            if (isset($sb['sb']['status']) && $sb['sb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Seat Belt Derek Kecil';
            }  else if(isset($sb['sb']['kondisi'])){
                $errors[] = 'Harap Isi Status Seat Belt Derek Kecil';
        }
            else  {
                $sb = ConditionStatus::where('status', $sb['sb']['status'])->first('id');
            }
        }  
           else{
                $errors[] = 'Harap Isi Seat Belt Derek Kecil';
            }

                    
        $kbd['kbd'] = $request->input('kbd');
        if(empty( $kbd['kbd'])){
            $errors[] = 'Harap Isi Keterangan Bagian Dalam Derek Kecil' ;
        }


        $dh['dh'] = $request->input('dh');
        if (isset($dh['dh']['status']) && isset($dh['dh']['kondisi'])) {
            $dh = ConditionStatus::where('status', $dh['dh']['status'])->where('kondisi', $dh['dh']['kondisi'])->first('id');
        } else if (isset($dh['dh']['status']) || isset($dh['dh']['kondisi'])){
            if (isset($dh['dh']['status']) && $dh['dh']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Dongkrak Hidrolik 20 Ton Derek Kecil';
            }  else if(isset($dh['dh']['kondisi'])){
                $errors[] = 'Harap Isi Status Dongkrak Hidrolik 20 Ton Derek Kecil';
        }
            else {
                $dh = ConditionStatus::where('status', $dh['dh']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Dongkrak Hidrolik 20 Ton Derek Kecil';
            }

        $toh['toh'] = $request->input('toh');
        if (isset($toh['toh']['status']) && isset($toh['toh']['kondisi'])) {
            $toh = ConditionStatus::where('status', $toh['toh']['status'])->where('kondisi', $toh['toh']['kondisi'])->first('id');
        } else if (isset($toh['toh']['status']) || isset($toh['toh']['kondisi'])){
            if (isset($toh['toh']['status']) && $toh['toh']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Tangki Oli Hidrolik Derek Kecil';
            }  else if(isset($toh['toh']['kondisi'])){
                $errors[] = 'Harap Isi Status Tangki Oli Hidrolik Derek Kecil';
        }
            else {
                $toh = ConditionStatus::where('status', $toh['toh']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Tangki Oli Hidrolik Derek Kecil';
            }

        $ww['ww'] = $request->input('ww');
        if (isset($ww['ww']['status']) && isset($ww['ww']['kondisi'])) {
            $ww = ConditionStatus::where('status', $ww['ww']['status'])->where('kondisi', $ww['ww']['kondisi'])->first('id');
        } else if (isset($ww['ww']['status']) || isset($ww['ww']['kondisi'])){
            if (isset($ww['ww']['status']) && $ww['ww']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Winch Warm 5 Ton Derek Kecil';
            }  else if(isset($ww['ww']['kondisi'])){
                $errors[] = 'Harap Isi Status Winch Warm 5 Ton Derek Kecil';
        }
            else {
                $ww = ConditionStatus::where('status', $ww['ww']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Winch Warm 5 Ton Derek Kecil';
            }

        $kh['kh'] = $request->input('kh');
        if (isset($kh['kh']['status']) && isset($kh['kh']['kondisi'])) {
            $kh = ConditionStatus::where('status', $kh['kh']['status'])->where('kondisi', $kh['kh']['kondisi'])->first('id');
        } else if (isset($kh['kh']['status']) || isset($kh['kh']['kondisi'])){
            if (isset($kh['kh']['status']) && $kh['kh']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kait Hook Derek Kecil';
            }  else if(isset($kh['kh']['kondisi'])){
                $errors[] = 'Harap Isi Status Kait Hook Derek Kecil';
        }
            else {
                $kh = ConditionStatus::where('status', $kh['kh']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Kait Hook Derek Kecil';
            }

        $kr['kr'] = $request->input('kr');
        if (isset($kr['kr']['status']) && isset($kr['kr']['kondisi'])) {
            $kr = ConditionStatus::where('status', $kr['kr']['status'])->where('kondisi', $kr['kr']['kondisi'])->first('id');
        } else if(isset($kr['kr']['status']) || isset($kr['kr']['kondisi'])) {
            if (isset($kr['kr']['status']) && $kr['kr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kunci Roda Derek Kecil';
            }  else if(isset($kr['kr']['kondisi'])){
                $errors[] = 'Harap Isi Status Kunci Roda Derek Kecil';
        }
            else   {
                $kr = ConditionStatus::where('status', $kr['kr']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Kunci Roda Derek Kecil';
            }

        $db['db'] = $request->input('db');
        if (isset($db['db']['status']) && isset($db['db']['kondisi'])) {
            $db = ConditionStatus::where('status', $db['db']['status'])->where('kondisi', $db['db']['kondisi'])->first('id');
        } else if(isset($db['db']['status']) || isset($db['db']['kondisi'])) {
            if (isset($db['db']['status']) && $db['db']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Dogkrak Buaya Derek Kecil';
            }  else if(isset($db['db']['kondisi'])){
                $errors[] = 'Harap Isi Status Dogkrak Buaya Derek Kecil';
        }
            else   {
                $db = ConditionStatus::where('status', $db['db']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Dogkrak Buaya Derek Kecil';
            }

        $p3k['p3k'] = $request->input('p3k');
        if (isset($p3k['p3k']['status']) && isset($p3k['p3k']['kondisi'])) {
            $p3k = ConditionStatus::where('status', $p3k['p3k']['status'])->where('kondisi', $p3k['p3k']['kondisi'])->first('id');
        } else if(isset($p3k['p3k']['status']) || isset($p3k['p3k']['kondisi'])) {
            if (isset($p3k['p3k']['status']) && $p3k['p3k']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi P3K Derek Kecil';
            }  else if(isset($p3k['p3k']['kondisi'])){
                $errors[] = 'Harap Isi Status P3K Derek Kecil';
        }
            else {
                $p3k = ConditionStatus::where('status', $p3k['p3k']['status'])->first('id');
            }
        }  
           else{
                $errors[] = 'Harap Isi P3K Derek Kecil';
            }

        $st['st'] = $request->input('st');
        if (isset($st['st']['status']) && isset($st['st']['kondisi'])) {
            $st = ConditionStatus::where('status', $st['st']['status'])->where('kondisi', $st['st']['kondisi'])->first('id');
        } else if(isset($st['st']['status']) || isset($st['st']['kondisi'])) {
            if (isset($st['st']['status']) && $st['st']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Sarung Tangan Derek Kecil';
            }  else if(isset($st['st']['kondisi'])){
                $errors[] = 'Harap Isi Status Sarung Tangan Derek Kecil';
        }
            else   {
                $st = ConditionStatus::where('status', $st['st']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Sarung Tangan Derek Kecil';
            }

       $hm['hm'] = $request->input('hm');
        if (isset($hm['hm']['status']) && isset($hm['hm']['kondisi'])) {
            $hm = ConditionStatus::where('status', $hm['hm']['status'])->where('kondisi', $hm['hm']['kondisi'])->first('id');
        } else if(isset($hm['hm']['status']) || isset($hm['hm']['kondisi'])) {
            if (isset($hm['hm']['status']) && $hm['hm']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Helm Derek Kecil';
            }  else if(isset($hm['hm']['kondisi'])){
                $errors[] = 'Harap Isi Status Helm Derek Kecil';
        }
            else   {
                $hm = ConditionStatus::where('status', $hm['hm']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Helm Derek Kecil';
            }

       $jh['jh'] = $request->input('jh');
        if (isset($jh['jh']['status']) && isset($jh['jh']['kondisi'])) {
            $jh = ConditionStatus::where('status', $jh['jh']['status'])->where('kondisi', $jh['jh']['kondisi'])->first('id');
        } else if(isset($jh['jh']['status']) || isset($jh['jh']['kondisi'])) {
            if (isset($jh['jh']['status']) && $jh['jh']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Jas Hujan Derek Kecil';
            }  else if(isset($jh['jh']['kondisi'])){
                $errors[] = 'Harap Isi Status Jas Hujan Derek Kecil';
        }
            else   {
                $jh = ConditionStatus::where('status', $jh['jh']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Jas Hujan Derek Kecil';
            }
            
        $kpr['kpr'] = $request->input('kpr');
        if(empty( $kpr['kpr'])){
            $errors[] = 'Harap Isi Keterangan Peralatan Derek Kecil' ;
        }

        $pa['pa'] = $request->input('pa');
        if (isset($pa['pa']['status']) && isset($pa['pa']['kondisi'])) {
            $pa = ConditionStatus::where('status', $pa['pa']['status'])->where('kondisi', $pa['pa']['kondisi'])->first('id');
        } else if(isset($pa['pa']['status']) || isset($pa['pa']['kondisi'])) {
            if (isset($pa['pa']['status']) && $pa['pa']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Public Address Derek Kecil';
            }  else if(isset($pa['pa']['kondisi'])){
                $errors[] = 'Harap Isi Status Public Address Derek Kecil';
        }
            else  {
                $pa = ConditionStatus::where('status', $pa['pa']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Public Address Derek Kecil';
            }

        $lsb['lsb'] = $request->input('lsb');
        if (isset($lsb['lsb']['status']) && isset($lsb['lsb']['kondisi'])) {
            $lsb = ConditionStatus::where('status', $lsb['lsb']['status'])->where('kondisi', $lsb['lsb']['kondisi'])->first('id');
        } else if (isset($lsb['lsb']['status']) || isset($lsb['lsb']['kondisi'])){
            if (isset($lsb['lsb']['status']) && $lsb['lsb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu (Rotary) Derek Kecil';
            }  else if(isset($lsb['lsb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu (Rotary) Derek Kecil';
        }
            else {
                $lsb = ConditionStatus::where('status', $lsb['lsb']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Lampu (Rotary) Derek Kecil';
            }

        $ws['ws'] = $request->input('ws');
        if (isset($ws['ws']['status']) && isset($ws['ws']['kondisi'])) {
            $ws = ConditionStatus::where('status', $ws['ws']['status'])->where('kondisi', $ws['ws']['kondisi'])->first('id');
        } else if (isset($ws['ws']['status']) || isset($ws['ws']['kondisi'])){
            if (isset($ws['ws']['status']) && $ws['ws']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Webbing Sling Derek Kecil';
            }  else if(isset($ws['ws']['kondisi'])){
                $errors[] = 'Harap Isi Status Webbing Sling Derek Kecil';
        }
            else {
                $ws = ConditionStatus::where('status', $ws['ws']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Webbing Sling Derek Kecil';
            }

        $ps['ps'] = $request->input('ps');
        if (isset($ps['ps']['status']) && isset($ps['ps']['kondisi'])) {
            $ps = ConditionStatus::where('status', $ps['ps']['status'])->where('kondisi', $ps['ps']['kondisi'])->first('id');
        } else if (isset($ps['ps']['status']) || isset($ps['ps']['kondisi'])){
            if (isset($ps['ps']['status']) && $ps['ps']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Parking Shock Derek Kecil';
            }  else if(isset($ps['ps']['kondisi'])){
                $errors[] = 'Harap Isi Status Parking Shock Derek Kecil';
        }
            else   {
                $ps = ConditionStatus::where('status', $ps['ps']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Parking Shock Derek Kecil';
            }

        $sl['sl'] = $request->input('sl');
        if (isset($sl['sl']['status']) && isset($sl['sl']['kondisi'])) {
            $sl = ConditionStatus::where('status', $sl['sl']['status'])->where('kondisi', $sl['sl']['kondisi'])->first('id');
        } else if (isset($sl['sl']['status']) || isset($sl['sl']['kondisi'])){
            if (isset($sl['sl']['status']) && $sl['sl']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Segel Derek Kecil';
            }  else if(isset($sl['sl']['kondisi'])){
                $errors[] = 'Harap Isi Status Segel Derek Kecil';
        }
            else   {
                $sl = ConditionStatus::where('status', $sl['sl']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Segel Derek Kecil';
            }

        $kpt['kpt'] = $request->input('kpt');
        if(empty( $kpt['kpt'])){
            $errors[] = 'Harap Isi Keterangan Peralatan Tambahan Derek Kecil' ;
        }
    
        
        $ec['ec'] = $request->input('ec');
        if (isset($ec['ec']['status']) && isset($ec['ec']['kondisi'])) {
            $ec = ConditionStatus::where('status', $ec['ec']['status'])->where('kondisi', $ec['ec']['kondisi'])->first('id');
        } else if(isset($ec['ec']['status']) || isset($ec['ec']['kondisi'])){
            if (isset($ec['ec']['status']) && $ec['ec']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Engine Condition Derek Kecil';
            }  else if(isset($ec['ec']['kondisi'])){
                $errors[] = 'Harap Isi Status Engine Condition Derek Kecil';
        }
            else {
                $ec = ConditionStatus::where('status', $ec['ec']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Engine Condition Derek Kecil';          
              }

        $rt['rt'] = $request->input('rt');
        if (isset($rt['rt']['status']) && isset($rt['rt']['kondisi'])) {
            $rt = ConditionStatus::where('status', $rt['rt']['status'])->where('kondisi', $rt['rt']['kondisi'])->first('id');
        } else if (isset($rt['rt']['status']) || isset($rt['rt']['kondisi'])){
            if (isset($rt['rt']['status']) && $rt['rt']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Running Test Derek Kecil';
            }  else if(isset($rt['rt']['kondisi'])){
                $errors[] = 'Harap Isi Status Running Test Derek Kecil';
        }
            else {
                $rt = ConditionStatus::where('status', $rt['rt']['status'])->first('id');
            }
        }  
           else{
                $errors[] ='Harap Isi Running Test Derek Kecil';
            }

        $arr['arr'] = $request->input('arr');
        if (isset($arr['arr']['status']) && isset($arr['arr']['kondisi'])) {
            $arr = ConditionStatus::where('status', $arr['arr']['status'])->where('kondisi', $arr['arr']['kondisi'])->first('id');
        } else if  (isset($arr['arr']['status']) || isset($arr['arr']['kondisi'])){
            if (isset($arr['arr']['status']) && $arr['arr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Air Radiator Derek Kecil';
            }  else if(isset($arr['arr']['kondisi'])){
                $errors[] = 'Harap Isi Status Air Radiator Derek Kecil';
        }
            else {
                $arr = ConditionStatus::where('status', $arr['arr']['status'])->first('id');
            }
        }  
          else{
                $errors[] = 'Harap Isi Air Radiator Derek Kecil';           
             }


        $acu['acu'] = $request->input('acu');
        if (isset($acu['acu']['status']) && isset($acu['acu']['kondisi'])) {
            $acu = ConditionStatus::where('status', $acu['acu']['status'])->where('kondisi', $acu['acu']['kondisi'])->first('id');
        } else if (isset($acu['acu']['status']) || isset($acu['acu']['kondisi'])){
            if (isset($acu['acu']['status']) && $acu['acu']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Air Accu Derek Kecil';
            }  else if(isset($acu['acu']['kondisi'])){
                $errors[] = 'Harap Isi Status Air Accu Derek Kecil';
        }
            else  {
                $acu = ConditionStatus::where('status', $acu['acu']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Air Accu Derek Kecil';
            }

        $omn['omn'] = $request->input('omn');
        if (isset($omn['omn']['status']) && isset($omn['omn']['kondisi'])) {
            $omn = ConditionStatus::where('status', $omn['omn']['status'])->where('kondisi', $omn['omn']['kondisi'])->first('id');
        } else if(isset($omn['omn']['status']) || isset($omn['omn']['kondisi'])){
            if (isset($omn['omn']['status']) && $omn['omn']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Oli Mesin Derek Kecil';
            }  else if(isset($omn['omn']['kondisi'])){
                $errors[] = 'Harap Isi Status Oli Mesin Derek Kecil';
        }
            else  {
                $omn = ConditionStatus::where('status', $omn['omn']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Oli Mesin Derek Kecil';
            }

        $mr['mr'] = $request->input('mr');
        if (isset($mr['mr']['status']) && isset($mr['mr']['kondisi'])) {
            $mr = ConditionStatus::where('status', $mr['mr']['status'])->where('kondisi', $mr['mr']['kondisi'])->first('id');
        } else if (isset($mr['mr']['status']) || isset($mr['mr']['kondisi'])){
            if (isset($mr['mr']['status']) && $mr['mr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Minyak Rem Derek Kecil';
            }  else if(isset($mr['mr']['kondisi'])){
                $errors[] = 'Harap Isi Status Minyak Rem Derek Kecil';
        }
            else   {
                $mr = ConditionStatus::where('status', $mr['mr']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Minyak Rem Derek Kecil';
            }

            
        $apr['apr'] = $request->input('apr');
        if (isset($apr['apr']['status']) && isset($apr['apr']['kondisi'])) {
            $apr = ConditionStatus::where('status', $apr['apr']['status'])->where('kondisi', $apr['apr']['kondisi'])->first('id');
        } else if(isset($apr['apr']['status']) || isset($apr['apr']['kondisi'])){
            if (isset($apr['apr']['status']) && $apr['apr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi APAR Derek Kecil';
            }  else if(isset($apr['apr']['kondisi'])){
                $errors[] = 'Harap Isi Status APAR Derek Kecil';
        }
            else{
                $apr = ConditionStatus::where('status', $apr['apr']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi APAR Derek Kecil';
            }

        $ops['ops'] = $request->input('ops');
        if (isset($ops['ops']['status']) && isset($ops['ops']['kondisi'])) {
            $ops = ConditionStatus::where('status', $ops['ops']['status'])->where('kondisi', $ops['ops']['kondisi'])->first('id');
        } else if(isset($ops['ops']['status']) || isset($ops['ops']['kondisi'])) {
            if (isset($ops['ops']['status']) && $ops['ops']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Oil Power Steering Derek Kecil';
            }  else if(isset($ops['ops']['kondisi'])){
                $errors[] = 'Harap Isi Status Oil Power Steering Derek Kecil';
        }
            else {
                $ops = ConditionStatus::where('status', $ops['ops']['status'])->first('id');
            }
        }  
          else{
                $errors[] = 'Harap Isi Oil Power Steering Derek Kecil';
            }

        $keeng['keeng'] = $request->input('keeng');
        if(empty( $keeng['keeng'])){
            $errors[] = 'Harap Isi Keterangan Engine Derek Kecil' ;
        }

        $ski['ski'] = $request->input('ski');
        if (isset($ski['ski']['status']) && isset($ski['ski']['kondisi'])) {
            $ski = ConditionStatus::where('status', $ski['ski']['status'])->where('kondisi', $ski['ski']['kondisi'])->first('id');
        } else if (isset($ski['ski']['status']) || isset($ski['ski']['kondisi'])){
            if (isset($ski['ski']['status']) && $ski['ski']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Samping Kiri Derek Kecil';
            }  else if(isset($ski['ski']['kondisi'])){
                $errors[] = 'Harap Isi Status Samping Kiri Derek Kecil';
        }
            else  {
                $ski = ConditionStatus::where('status', $ski['ski']['status'])->first('id');
            }
        }  
        else{
                $errors[] = 'Harap Isi Samping Kiri Derek Kecil';
            }

        $ska['ska'] = $request->input('ska');
        if (isset($ska['ska']['status']) && isset($ska['ska']['kondisi'])) {
            $ska = ConditionStatus::where('status', $ska['ska']['status'])->where('kondisi', $ska['ska']['kondisi'])->first('id');
        } else if (isset($ska['ska']['status']) || isset($ska['ska']['kondisi'])){
            if (isset($ska['ska']['status']) && $ska['ska']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Samping Kanan Derek Kecil';
            }  else if(isset($ska['ska']['kondisi'])){
                $errors[] = 'Harap Isi Status Samping Kanan Derek Kecil';
        }
            else {
                $ska = ConditionStatus::where('status', $ska['ska']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Samping Kanan Derek Kecil';
            }

        $dpn['dpn'] = $request->input('dpn');
        if (isset($dpn['dpn']['status']) && isset($dpn['dpn']['kondisi'])) {
            $dpn = ConditionStatus::where('status', $dpn['dpn']['status'])->where('kondisi', $dpn['dpn']['kondisi'])->first('id');
        } else if(isset($dpn['dpn']['status']) || isset($dpn['dpn']['kondisi'])) {
            if (isset($dpn['dpn']['status']) && $dpn['dpn']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Depan Derek Kecil';
            }  else if(isset($dpn['dpn']['kondisi'])){
                $errors[] = 'Harap Isi Status Depan Derek Kecil';
        }
            else  {
                $dpn = ConditionStatus::where('status', $dpn['dpn']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Depan Derek Kecil';
            }

        $blg['blg'] = $request->input('blg');
        if (isset($blg['blg']['status']) && isset($blg['blg']['kondisi'])) {
            $blg = ConditionStatus::where('status', $blg['blg']['status'])->where('kondisi', $blg['blg']['kondisi'])->first('id');
        } else if (isset($blg['blg']['status']) || isset($blg['blg']['kondisi'])) {
            if (isset($blg['blg']['status']) && $blg['blg']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Belakang Derek Kecil';
            }  else if(isset($blg['blg']['kondisi'])){
                $errors[] = 'Harap Isi Status Belakang Derek Kecil';
        }
            else  {
                $blg = ConditionStatus::where('status', $blg['blg']['status'])->first('id');
            }
        }  
          else{
                $errors[] = 'Harap Isi Belakang Derek Kecil';
            }

        $ats['ats'] = $request->input('ats');
        if (isset($ats['ats']['status']) && isset($ats['ats']['kondisi'])) {
            $ats = ConditionStatus::where('status', $ats['ats']['status'])->where('kondisi', $ats['ats']['kondisi'])->first('id');
        } else if(isset($ats['ats']['status']) || isset($ats['ats']['kondisi'])) {
            if (isset($ats['ats']['status']) && $ats['ats']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Atas Derek Kecil';
            }  else if(isset($ats['ats']['kondisi'])){
                $errors[] = 'Harap Isi Status Atas Derek Kecil';
        }
            else {
                $ats = ConditionStatus::where('status', $ats['ats']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Atas Derek Kecil';
            }
       
        $kbdc['kbdc'] = $request->input('kbdc');
        if(empty( $kbdc['kbdc'])){
            $errors[] = 'Harap Isi Keterangan Body dan Cat Derek Kecil' ;
        }
    
        //derek besar
         $odo2['odo2'] = $request->input('odo2');
        if(empty( $odo2['odo2'])){
            $errors[] = 'Harap Isi Odo Meter' ;
        }
        $bkaddb['bkaddb'] = $request->input('bkaddb');
        // dd(count($bkaddb['bkaddb']));
        if (isset($bkaddb['bkaddb']['status']) && isset($bkaddb['bkaddb']['kondisi'])) {
            $bkaddb = ConditionStatus::where('status', $bkaddb['bkaddb']['status'])->where('kondisi', $bkaddb['bkaddb']['kondisi'])->first('id');
        } 
        else if(isset($bkaddb['bkaddb']['status']) || isset($bkaddb['bkaddb']['kondisi'])) {
            if (isset($bkaddb['bkaddb']['status']) && $bkaddb['bkaddb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Kanan Depan Derek Besar';
            }else if (isset($bkaddb['bkaddb']['kondisi']) && $bkaddb['bkaddb']['kondisi'] == 1){
                $errors[] = 'Harap Isi Status Ban Kanan Depan Derek Besar';
            } 
            else  {
        $bkaddb = ConditionStatus::where('status', $bkaddb['bkaddb']['status'])->first('id');
    }   
        }
          else {
        $errors[] = 'Harap Isi Ban Kanan Depan Derek Besar';
        }  
        
        $bkabdb['bkabdb'] = $request->input('bkabdb');
        if (isset($bkabdb['bkabdb']['status']) && isset($bkabdb['bkabdb']['kondisi'])) {
            $bkabdb = ConditionStatus::where('status', $bkabdb['bkabdb']['status'])->where('kondisi', $bkabdb['bkabdb']['kondisi'])->first('id');
        } else if(isset($bkabdb['bkabdb']['status']) || isset($bkabdb['bkabdb']['kondisi'])) {
           if (isset($bkabdb['bkabdb']['status']) && $bkabdb['bkabdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Kanan Belakang Derek Besar';
            }else if(isset($bkabdb['bkabdb']['kondisi']) && $bkabdb['bkabdb']['kondisi'] == 1){
                $errors[] = 'Harap Isi Status Ban Kanan Belakang Derek Besar';
            } 
            else{
                $bkabdb = ConditionStatus::where('status', $bkabdb['bkabdb']['status'])->first('id');
            }
        }
             else {
        $errors[] = 'Harap Isi Ban Kanan Belakang Derek Besar';
        }  

        $bkiddb['bkiddb'] = $request->input('bkiddb');
        if (isset($bkiddb['bkiddb']['status']) && isset($bkiddb['bkiddb']['kondisi'])) {
            $bkiddb = ConditionStatus::where('status', $bkiddb['bkiddb']['status'])->where('kondisi', $bkiddb['bkiddb']['kondisi'])->first('id');
        } else if (isset($bkiddb['bkiddb']['status']) || isset($bkiddb['bkiddb']['kondisi'])) {
            if (isset($bkiddb['bkiddb']['status']) && $bkiddb['bkiddb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Kiri Depan Derek Besar';
            }  else if(isset($bkiddb['bkiddb']['kondisi'])){
                $errors[] = 'Harap Isi Status Ban Kiri Depan Derek Besar';
            }
            else   {
                $bkiddb = ConditionStatus::where('status', $bkiddb['bkiddb']['status'])->first('id');
            }
        } 
           else{
                $errors[] ='Harap Isi Ban Kiri Depan Derek Besar';
            } 

        $bkibdb['bkibdb'] = $request->input('bkibdb');
        if (isset($bkibdb['bkibdb']['status']) && isset($bkibdb['bkibdb']['kondisi'])) {
            $bkibdb = ConditionStatus::where('status', $bkibdb['bkibdb']['status'])->where('kondisi', $bkibdb['bkibdb']['kondisi'])->first('id');
        } else if(isset($bkibdb['bkibdb']['status']) || isset($bkibdb['bkibdb']['kondisi'])){
            if (isset($bkibdb['bkibdb']['status']) && $bkibdb['bkibdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Kiri Belakang Derek Besar';
            }  else if(isset($bkibdb['bkibdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Ban Kiri Belakang Derek Besar';
            }
            else {
                $bkibdb = ConditionStatus::where('status', $bkibdb['bkibdb']['status'])->first('id');
            }
        } 
         else{
                $errors[] = 'Harap Isi Ban Kiri Belakang Derek Besar';
            } 

        $bsdb['bsdb'] = $request->input('bsdb');
        if (isset($bsdb['bsdb']['status']) && isset($bsdb['bsdb']['kondisi'])) {
            $bsdb = ConditionStatus::where('status', $bsdb['bsdb']['status'])->where('kondisi', $bsdb['bsdb']['kondisi'])->first('id');
        } else if (isset($bsdb['bsdb']['status']) || isset($bsdb['bsdb']['kondisi'])) {
            if (isset($bsdb['bsdb']['status']) && $bsdb['bsdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ban Serep Derek Besar';
            }  else if(isset($bsdb['bsdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Ban Serep Derek Besar';
            }
            else  {
                $bsdb = ConditionStatus::where('status', $bsdb['bsdb']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Ban Serep Derek Besar';
            } 

        $kbrdbdb['kbrdbdb'] = $request->input('kbrdbdb');
        if(empty( $kbrdbdb['kbrdbdb'])){
            $errors[] = 'Harap Isi Keterangan Roda dan Ban Derek Besar' ;
        }
    

        $stnkdb['stnkdb'] = $request->input('stnkdb');
        if (isset($stnkdb['stnkdb']['status']) && isset($stnkdb['stnkdb']['kondisi'])) {
            $stnkdb = ConditionStatus::where('status', $stnkdb['stnkdb']['status'])->where('kondisi', $stnkdb['stnkdb']['kondisi'])->first('id');
        } else if (isset($stnkdb['stnkdb']['status']) || isset($stnkdb['stnkdb']['kondisi'])) {
            if (isset($stnkdb['stnkdb']['status']) && $stnkdb['stnkdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi STNK Derek Besar';
            }  else if(isset($stnkdb['stnkdb']['kondisi'])){
                $errors[] = 'Harap Isi Status STNK Derek Besar';
            }
            else  {
                $stnkdb = ConditionStatus::where('status', $stnkdb['stnkdb']['status'])->first('id');
            }
        } 
        else{
                $errors[] ='Harap Isi STNK Derek Besar';
            } 

        $ldbdb['ldbdb'] = $request->input('ldbdb');
        if (isset($ldbdb['ldbdb']['status']) && isset($ldbdb['ldbdb']['kondisi'])) {
            $ldbdb = ConditionStatus::where('status', $ldbdb['ldbdb']['status'])->where('kondisi', $ldbdb['ldbdb']['kondisi'])->first('id');
        } else if(isset($ldbdb['ldbdb']['status']) || isset($ldbdb['ldbdb']['kondisi'])) {
            if (isset($ldbdb['ldbdb']['status']) && $ldbdb['ldbdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Dashboard Derek Besar';
            }  else if(isset($ldbdb['ldbdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Dashboard Derek Besar';
            }
            else {
                $ldbdb = ConditionStatus::where('status', $ldbdb['ldbdb']['status'])->first('id');
            }
        } 
         else{
                $errors[] = 'Harap Isi Lampu Dashboard Derek Besar';
            } 
            
        $ldpdb['ldpdb'] = $request->input('ldpdb');
        if (isset($ldpdb['ldpdb']['status']) && isset($ldpdb['ldpdb']['kondisi'])) {
            $ldpdb = ConditionStatus::where('status', $ldpdb['ldpdb']['status'])->where('kondisi', $ldpdb['ldpdb']['kondisi'])->first('id');
        } else if(isset($ldpdb['ldpdb']['status']) || isset($ldpdb['ldpdb']['kondisi'])) {
            if (isset($ldpdb['ldpdb']['status']) && $ldpdb['ldpdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Depan Derek Besar';
            }  else if(isset($ldpdb['ldpdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Depan Derek Besar';
            }
            else {
                $ldpdb = ConditionStatus::where('status', $ldpdb['ldpdb']['status'])->first('id');
            }
        } 
            else{
                $errors[] = 'Harap Isi Lampu Depan Derek Besar';
            }

        $lbgdb['lbgdb'] = $request->input('lbgdb');
        if (isset($lbgdb['lbgdb']['status']) && isset($lbgdb['lbgdb']['kondisi'])) {
            $lbgdb = ConditionStatus::where('status', $lbgdb['lbgdb']['status'])->where('kondisi', $lbgdb['lbgdb']['kondisi'])->first('id');
        } else if(isset($lbgdb['lbgdb']['status']) || isset($lbgdb['lbgdb']['kondisi'])) {
            if (isset($lbgdb['lbgdb']['status']) && $lbgdb['lbgdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Belakang Derek Besar';
            }  else if(isset($lbgdb['lbgdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Belakang Derek Besar';
            }
            else   {
                $lbgdb = ConditionStatus::where('status', $lbgdb['lbgdb']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Lampu Belakang Derek Besar';
            }

        $lrdb['lrdb'] = $request->input('lrdb');
        if (isset($lrdb['lrdb']['status']) && isset($lrdb['lrdb']['kondisi'])) {
            $lrdb = ConditionStatus::where('status', $lrdb['lrdb']['status'])->where('kondisi', $lrdb['lrdb']['kondisi'])->first('id');
        } else if (isset($lrdb['lrdb']['status']) || isset($lrdb['lrdb']['kondisi'])){
            if (isset($lrdb['lrdb']['status']) && $lrdb['lrdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Rem Derek Besar';
            }  else if(isset($lrdb['lrdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Rem Derek Besar';
        }
            else  {
                $lrdb = ConditionStatus::where('status', $lrdb['lrdb']['status'])->first('id');
            }
        }  
           else{
                $errors[] = 'Harap Isi Lampu Rem Derek Besar';
            }

        $lsndb['lsndb'] = $request->input('lsndb');
        if (isset($lsndb['lsndb']['status']) && isset($lsndb['lsndb']['kondisi'])) {
            $lsndb = ConditionStatus::where('status', $lsndb['lsndb']['status'])->where('kondisi', $lsndb['lsndb']['kondisi'])->first('id');
        } else if(isset($lsndb['lsndb']['status']) || isset($lsndb['lsndb']['kondisi'])) {
            if (isset($lsndb['lsndb']['status']) && $lsndb['lsndb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Sein Derek Besar';
            }  else if(isset($lsndb['lsndb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Sein Derek Besar';
        }
            else  {
                $lsndb = ConditionStatus::where('status', $lsndb['lsndb']['status'])->first('id');
            }
        } 
         else{
                $errors[] = 'Harap Isi Lampu Sein Derek Besar';
            }

        $lmdb['lmdb'] = $request->input('lmdb');
        if (isset($lmdb['lmdb']['status']) && isset($lmdb['lmdb']['kondisi'])) {
            $lmdb = ConditionStatus::where('status', $lmdb['lmdb']['status'])->where('kondisi', $lmdb['lmdb']['kondisi'])->first('id');
        } else if (isset($lmdb['lmdb']['status']) || isset($lmdb['lmdb']['kondisi'])) {
            if (isset($lmdb['lmdb']['status']) && $lmdb['lmdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Mundur Derek Besar';
            }  else if(isset($lmdb['lmdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Mundur Derek Besar';
        }
            else  {
                $lmdb = ConditionStatus::where('status', $lmdb['lmdb']['status'])->first('id');
            }
        } 
          else{
                $errors[]= 'Harap Isi Lampu Mundur Derek Besar';
            }

        $lktdb['lktdb'] = $request->input('lktdb');
        if (isset($lktdb['lktdb']['status']) && isset($lktdb['lktdb']['kondisi'])) {
            $lktdb = ConditionStatus::where('status', $lktdb['lktdb']['status'])->where('kondisi', $lktdb['lktdb']['kondisi'])->first('id');
        } else if (isset($lktdb['lktdb']['status']) || isset($lktdb['lktdb']['kondisi'])) {
            if (isset($lktdb['lktdb']['status']) && $lktdb['lktdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Kabut Derek Besar';
            }  else if(isset($lktdb['lktdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Kabut Derek Besar';
        }
            else  {
                $lktdb = ConditionStatus::where('status', $lktdb['lktdb']['status'])->first('id');
            }
        } 
          else{
                $errors[]= 'Harap Isi Lampu Kabut Derek Besar';
            }

        $lsbdb['lsbdb'] = $request->input('lsbdb');
        if (isset($lsbdb['lsbdb']['status']) && isset($lsbdb['lsbdb']['kondisi'])) {
            $lsbdb = ConditionStatus::where('status', $lsbdb['lsbdb']['status'])->where('kondisi', $lsbdb['lsbdb']['kondisi'])->first('id');
        } else if (isset($lsbdb['lsbdb']['status']) || isset($lsbdb['lsbdb']['kondisi'])) {
            if (isset($lsbdb['lsbdb']['status']) && $lsbdb['lsbdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Storobo/Led (Rotary) Derek Besar';
            }  else if(isset($lsbdb['lsbdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Storobo/Led (Rotary) Derek Besar';
        }
            else  {
                $lsbdb = ConditionStatus::where('status', $lsbdb['lsbdb']['status'])->first('id');
            }
        } 
          else{
                $errors[]= 'Harap Isi Lampu Storobo/Led (Rotary) Derek Besar';
            }

        $lpsrdb['lpsrdb'] = $request->input('lpsrdb');
        if (isset($lpsrdb['lpsrdb']['status']) && isset($lpsrdb['lpsrdb']['kondisi'])) {
            $lpsrdb = ConditionStatus::where('status', $lpsrdb['lpsrdb']['status'])->where('kondisi', $lpsrdb['lpsrdb']['kondisi'])->first('id');
        } else if (isset($lpsrdb['lpsrdb']['status']) || isset($lpsrdb['lpsrdb']['kondisi'])) {
            if (isset($lpsrdb['lpsrdb']['status']) && $lpsrdb['lpsrdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Lampu Sorot Derek Besar';
            }  else if(isset($lpsrdb['lpsrdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Lampu Sorot Derek Besar';
        }
            else  {
                $lpsrdb = ConditionStatus::where('status', $lpsrdb['lpsrdb']['status'])->first('id');
            }
        } 
          else{
                $errors[]= 'Harap Isi Lampu Sorot Derek Besar';
            }

        $acdb['acdb'] = $request->input('acdb');
        if (isset($acdb['acdb']['status']) && isset($acdb['acdb']['kondisi'])) {
            $acdb = ConditionStatus::where('status', $acdb['acdb']['status'])->where('kondisi', $acdb['acdb']['kondisi'])->first('id');
        } else if(isset($acdb['acdb']['status']) || isset($acdb['acdb']['kondisi'])) {
            if (isset($acdb['acdb']['status']) && $acdb['acdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Air Conditioner Derek Besar';
            }  else if(isset($acdb['acdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Air Conditioner Derek Besar';
        }
            else  {
                $acdb = ConditionStatus::where('status', $acdb['acdb']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Air Conditioner Derek Besar';
            }

            
        $kldb['kldb'] = $request->input('kldb');
        if (isset($kldb['kldb']['status']) && isset($kldb['kldb']['kondisi'])) {
            $kldb = ConditionStatus::where('status', $kldb['kldb']['status'])->where('kondisi', $kldb['kldb']['kondisi'])->first('id');
        } else if (isset($kldb['kldb']['status']) || isset($kldb['kldb']['kondisi'])){
            if (isset($kldb['kldb']['status']) && $kldb['kldb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Klakson Derek Besar';
            }  else if(isset($kldb['kldb']['kondisi'])){
                $errors[] = 'Harap Isi Status Klakson Derek Besar';
        }
            else  {
                $kldb = ConditionStatus::where('status', $kldb['kldb']['status'])->first('id');
            }
        }  
           else{
                $errors[] ='Harap Isi Klakson Derek Besar';
            }

        $wpdb['wpdb'] = $request->input('wpdb');
        if (isset($wpdb['wpdb']['status']) && isset($wpdb['wpdb']['kondisi'])) {
            $wpdb = ConditionStatus::where('status', $wpdb['wpdb']['status'])->where('kondisi', $wpdb['wpdb']['kondisi'])->first('id');
        } else if (isset($wpdb['wpdb']['status']) || isset($wpdb['wpdb']['kondisi'])) {
            if (isset($wpdb['wpdb']['status']) && $wpdb['wpdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Wiper Derek Besar';
            }  else if(isset($wpdb['wpdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Wiper Derek Besar';
        }
            else  {
                $wpdb = ConditionStatus::where('status', $wpdb['wpdb']['status'])->first('id');
            }  
        } 
         else{
                $errors[] ='Harap Isi Wiper Derek Besar';
            }

        $sbdb['sbdb'] = $request->input('sbdb');
        if (isset($sbdb['sbdb']['status']) && isset($sbdb['sbdb']['kondisi'])) {
            $sbdb = ConditionStatus::where('status', $sbdb['sbdb']['status'])->where('kondisi', $sbdb['sbdb']['kondisi'])->first('id');
        } else if (isset($sbdb['sbdb']['status']) || isset($sbdb['sbdb']['kondisi']))  {
            if (isset($sbdb['sbdb']['status']) && $sbdb['sbdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Seat Belt Derek Besar';
            }  else if(isset($sbdb['sbdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Seat Belt Derek Besar';
        }
            else  {
                $sbdb = ConditionStatus::where('status', $sbdb['sbdb']['status'])->first('id');
            }
        }  
           else{
                $errors[] = 'Harap Isi Seat Belt Derek Besar';
            }

        $apardb['apardb'] = $request->input('apardb');
        if (isset($apardb['apardb']['status']) && isset($apardb['apardb']['kondisi'])) {
            $apardb = ConditionStatus::where('status', $apardb['apardb']['status'])->where('kondisi', $apardb['apardb']['kondisi'])->first('id');
        } else if(isset($apardb['apardb']['status']) || isset($apardb['apardb']['kondisi'])){
            if (isset($apardb['apardb']['status']) && $apardb['apardb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi APAR Derek Besar';
            }  else if(isset($apardb['apardb']['kondisi'])){
                $errors[] = 'Harap Isi Status APAR Derek Besar';
        }
            else{
                $apardb = ConditionStatus::where('status', $apardb['apardb']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi APAR Derek Besar';
            }
     
                    
        $kbddb['kbddb'] = $request->input('kbddb');
        if(empty( $kbddb['kbddb'])){
            $errors[] = 'Harap Isi Keterangan Bagian Dalam Derek Besar' ;
        }


        $blk['blk'] = $request->input('blk');
        if (isset($blk['blk']['status']) && isset($blk['blk']['kondisi'])) {
            $blk = ConditionStatus::where('status', $blk['blk']['status'])->where('kondisi', $blk['blk']['kondisi'])->first('id');
        } else if (isset($blk['blk']['status']) || isset($blk['blk']['kondisi'])){
            if (isset($blk['blk']['status']) && $blk['blk']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Balok Derek Besar';
            }  else if(isset($blk['blk']['kondisi'])){
                $errors[] = 'Harap Isi Status Balok Derek Besar';
        }
            else {
                $blk = ConditionStatus::where('status', $blk['blk']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Balok Derek Besar';
            }

        $p3kdb['p3kdb'] = $request->input('p3kdb');
        if (isset($p3kdb['p3kdb']['status']) && isset($p3kdb['p3kdb']['kondisi'])) {
            $p3kdb = ConditionStatus::where('status', $p3kdb['p3kdb']['status'])->where('kondisi', $p3kdb['p3kdb']['kondisi'])->first('id');
        } else if (isset($p3kdb['p3kdb']['status']) || isset($p3kdb['p3kdb']['kondisi'])){
            if (isset($p3kdb['p3kdb']['status']) && $p3kdb['p3kdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi P3K Derek Besar';
            }  else if(isset($p3kdb['p3kdb']['kondisi'])){
                $errors[] = 'Harap Isi Status P3K Derek Besar';
        }
            else {
                $p3kdb = ConditionStatus::where('status', $p3kdb['p3kdb']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi P3K Derek Besar';
            }

        $ktrl['ktrl'] = $request->input('ktrl');
        if (isset($ktrl['ktrl']['status']) && isset($ktrl['ktrl']['kondisi'])) {
            $ktrl = ConditionStatus::where('status', $ktrl['ktrl']['status'])->where('kondisi', $ktrl['ktrl']['kondisi'])->first('id');
        } else if (isset($ktrl['ktrl']['status']) || isset($ktrl['ktrl']['kondisi'])){
            if (isset($ktrl['ktrl']['status']) && $ktrl['ktrl']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Katrol Derek Besar';
            }  else if(isset($ktrl['ktrl']['kondisi'])){
                $errors[] = 'Harap Isi Status Katrol Derek Besar';
        }
            else {
                $ktrl = ConditionStatus::where('status', $ktrl['ktrl']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Katrol Derek Besar';
            }

        $dht['dht'] = $request->input('dht');
        if (isset($dht['dht']['status']) && isset($dht['dht']['kondisi'])) {
            $dht = ConditionStatus::where('status', $dht['dht']['status'])->where('kondisi', $dht['dht']['kondisi'])->first('id');
        } else if (isset($dht['dht']['status']) || isset($dht['dht']['kondisi'])){
            if (isset($dht['dht']['status']) && $dht['dht']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Dongkrak Hidrolik 20 Ton Derek Besar';
            }  else if(isset($dht['dht']['kondisi'])){
                $errors[] = 'Harap Isi Status Dongkrak Hidrolik 20 Ton Derek Besar';
        }
            else {
                $dht = ConditionStatus::where('status', $dht['dht']['status'])->first('id');
            }
        } 
          else{
                $errors[] = 'Harap Isi Dongkrak Hidrolik 20 Ton Derek Besar';
            }

        $ks['ks'] = $request->input('ks');
        if (isset($ks['ks']['status']) && isset($ks['ks']['kondisi'])) {
            $ks = ConditionStatus::where('status', $ks['ks']['status'])->where('kondisi', $ks['ks']['kondisi'])->first('id');
        } else if(isset($ks['ks']['status']) || isset($ks['ks']['kondisi'])) {
            if (isset($ks['ks']['status']) && $ks['ks']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kunci Shock Derek Besar';
            }  else if(isset($ks['ks']['kondisi'])){
                $errors[] = 'Harap Isi Status Kunci Shock Derek Besar';
        }
            else   {
                $ks = ConditionStatus::where('status', $ks['ks']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Kunci Shock Derek Besar';
            }

        $km['km'] = $request->input('km');
        if (isset($km['km']['status']) && isset($km['km']['kondisi'])) {
            $km = ConditionStatus::where('status', $km['km']['status'])->where('kondisi', $km['km']['kondisi'])->first('id');
        } else if(isset($km['km']['status']) || isset($km['km']['kondisi'])) {
            if (isset($km['km']['status']) && $km['km']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kunci Moment Derek Besar';
            }  else if(isset($km['km']['kondisi'])){
                $errors[] = 'Harap Isi Status Kunci Moment Derek Besar';
        }
            else   {
                $km = ConditionStatus::where('status', $km['km']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Kunci Moment Derek Besar';
            }

       $km['km'] = $request->input('km');
        if (isset($km['km']['status']) && isset($km['km']['kondisi'])) {
            $km = ConditionStatus::where('status', $km['km']['status'])->where('kondisi', $km['km']['kondisi'])->first('id');
        } else if(isset($km['km']['status']) || isset($km['km']['kondisi'])) {
            if (isset($km['km']['status']) && $km['km']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kunci Moment Derek Besar';
            }  else if(isset($km['km']['kondisi'])){
                $errors[] = 'Harap Isi Status Kunci Moment Derek Besar';
        }
            else   {
                $km = ConditionStatus::where('status', $km['km']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Kunci Moment Derek Besar';
            }

       $kp['kp'] = $request->input('kp');
        if (isset($kp['kp']['status']) && isset($kp['kp']['kondisi'])) {
            $kp = ConditionStatus::where('status', $kp['kp']['status'])->where('kondisi', $kp['kp']['kondisi'])->first('id');
        } else if(isset($kp['kp']['status']) || isset($kp['kp']['kondisi'])) {
            if (isset($kp['kp']['status']) && $kp['kp']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kunci Pipa Derek Besar';
            }  else if(isset($kp['kp']['kondisi'])){
                $errors[] = 'Harap Isi Status Kunci Pipa Derek Besar';
        }
            else   {
                $kp = ConditionStatus::where('status', $kp['kp']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Kunci Pipa Derek Besar';
            }
            
       $rnt['rnt'] = $request->input('rnt');
        if (isset($rnt['rnt']['status']) && isset($rnt['rnt']['kondisi'])) {
            $rnt = ConditionStatus::where('status', $rnt['rnt']['status'])->where('kondisi', $rnt['rnt']['kondisi'])->first('id');
        } else if(isset($rnt['rnt']['status']) || isset($rnt['rnt']['kondisi'])) {
            if (isset($rnt['rnt']['status']) && $rnt['rnt']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Rantai 1/2" 2X10 M Derek Besar';
            }  else if(isset($rnt['rnt']['kondisi'])){
                $errors[] = 'Harap Isi Status Rantai 1/2" 2X10 M Derek Besar';
        }
            else   {
                $rnt = ConditionStatus::where('status', $rnt['rnt']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Rantai 1/2" 2X10 M Derek Besar';
            }

        $tsg['tsg'] = $request->input('tsg');
        if (isset($tsg['tsg']['status']) && isset($tsg['tsg']['kondisi'])) {
            $tsg = ConditionStatus::where('status', $tsg['tsg']['status'])->where('kondisi', $tsg['tsg']['kondisi'])->first('id');
        } else if(isset($tsg['tsg']['status']) || isset($tsg['tsg']['kondisi'])) {
            if (isset($tsg['tsg']['status']) && $tsg['tsg']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Tali Sling Derek Besar';
            }  else if(isset($tsg['tsg']['kondisi'])){
                $errors[] = 'Harap Isi Status Tali Sling Derek Besar';
        }
            else  {
                $tsg = ConditionStatus::where('status', $tsg['tsg']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Tali Sling Derek Besar';
            }

        $rbs['rbs'] = $request->input('rbs');
        if (isset($rbs['rbs']['status']) && isset($rbs['rbs']['kondisi'])) {
            $rbs = ConditionStatus::where('status', $rbs['rbs']['status'])->where('kondisi', $rbs['rbs']['kondisi'])->first('id');
        } else if(isset($rbs['rbs']['status']) || isset($rbs['rbs']['kondisi'])) {
            if (isset($rbs['rbs']['status']) && $rbs['rbs']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Rantai Besi Derek Besar';
            }  else if(isset($rbs['rbs']['kondisi'])){
                $errors[] = 'Harap Isi Status Rantai Besi Derek Besar';
        }
            else  {
                $rbs = ConditionStatus::where('status', $rbs['rbs']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Rantai Besi Derek Besar';
            }

        $sgl['sgl'] = $request->input('sgl');
        if (isset($sgl['sgl']['status']) && isset($sgl['sgl']['kondisi'])) {
            $sgl = ConditionStatus::where('status', $sgl['sgl']['status'])->where('kondisi', $sgl['sgl']['kondisi'])->first('id');
        } else if (isset($sgl['sgl']['status']) || isset($sgl['sgl']['kondisi'])){
            if (isset($sgl['sgl']['status']) && $sgl['sgl']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Segel Derek Besar';
            }  else if(isset($sgl['sgl']['kondisi'])){
                $errors[] = 'Harap Isi Status Segel Derek Besar';
        }
            else   {
                $sgl = ConditionStatus::where('status', $sgl['sgl']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Segel Derek Besar';
            }
            
        $skr['skr'] = $request->input('skr');
        if (isset($skr['skr']['status']) && isset($skr['skr']['kondisi'])) {
            $skr = ConditionStatus::where('status', $skr['skr']['status'])->where('kondisi', $skr['skr']['kondisi'])->first('id');
        } else if (isset($skr['skr']['status']) || isset($skr['skr']['kondisi'])){
            if (isset($skr['skr']['status']) && $skr['skr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Selang Kompor Derek Besar';
            }  else if(isset($skr['skr']['kondisi'])){
                $errors[] = 'Harap Isi Status Selang Kompor Derek Besar';
        }
            else   {
                $skr = ConditionStatus::where('status', $skr['skr']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Selang Kompor Derek Besar';
            }
            
       $hmdb['hmdb'] = $request->input('hmdb');
        if (isset($hmdb['hmdb']['status']) && isset($hmdb['hmdb']['kondisi'])) {
            $hmdb = ConditionStatus::where('status', $hmdb['hmdb']['status'])->where('kondisi', $hmdb['hmdb']['kondisi'])->first('id');
        } else if(isset($hmdb['hmdb']['status']) || isset($hmdb['hmdb']['kondisi'])) {
            if (isset($hmdb['hmdb']['status']) && $hmdb['hmdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Helm Derek Besar';
            }  else if(isset($hmdb['hmdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Helm Derek Besar';
        }
            else   {
                $hmdb = ConditionStatus::where('status', $hmdb['hmdb']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Helm Derek Besar';
            }

       $jhdb['jhdb'] = $request->input('jhdb');
        if (isset($jhdb['jhdb']['status']) && isset($jhdb['jhdb']['kondisi'])) {
            $jhdb = ConditionStatus::where('status', $jhdb['jhdb']['status'])->where('kondisi', $jhdb['jhdb']['kondisi'])->first('id');
        } else if(isset($jhdb['jhdb']['status']) || isset($jhdb['jhdb']['kondisi'])) {
            if (isset($jhdb['jhdb']['status']) && $jhdb['jhdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Jas Hujan Derek Besar';
            }  else if(isset($jhdb['jhdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Jas Hujan Derek Besar';
        }
            else   {
                $jhdb = ConditionStatus::where('status', $jhdb['jhdb']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Jas Hujan Derek Besar';
            }

        $stdb['stdb'] = $request->input('stdb');
        if (isset($stdb['stdb']['status']) && isset($stdb['stdb']['kondisi'])) {
            $stdb = ConditionStatus::where('status', $stdb['stdb']['status'])->where('kondisi', $stdb['stdb']['kondisi'])->first('id');
        } else if(isset($stdb['stdb']['status']) || isset($stdb['stdb']['kondisi'])) {
            if (isset($stdb['stdb']['status']) && $stdb['stdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Sarung Tangan Derek Besar';
            }  else if(isset($st['st']['kondisi'])){
                $errors[] = 'Harap Isi Status Sarung Tangan Derek Besar';
        }
            else   {
                $stdb = ConditionStatus::where('status', $stdb['stdb']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Sarung Tangan Derek Besar';
            }

        $sbt['sbt'] = $request->input('sbt');
        if (isset($sbt['sbt']['status']) && isset($sbt['sbt']['kondisi'])) {
            $sbt = ConditionStatus::where('status', $sbt['sbt']['status'])->where('kondisi', $sbt['sbt']['kondisi'])->first('id');
        } else if(isset($sbt['sbt']['status']) || isset($sbt['sbt']['kondisi'])) {
            if (isset($sbt['sbt']['status']) && $sbt['sbt']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Sepatu Boat Derek Besar';
            }  else if(isset($sbt['sbt']['kondisi'])){
                $errors[] = 'Harap Isi Status Sepatu Boat Derek Besar';
        }
            else   {
                $sbt = ConditionStatus::where('status', $sbt['sbt']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Sepatu Boat Derek Besar';
            }
            
        $scr['scr'] = $request->input('scr');
        if (isset($scr['scr']['status']) && isset($scr['scr']['kondisi'])) {
            $scr = ConditionStatus::where('status', $scr['scr']['status'])->where('kondisi', $scr['scr']['kondisi'])->first('id');
        } else if(isset($scr['scr']['status']) || isset($scr['scr']['kondisi'])) {
            if (isset($scr['scr']['status']) && $scr['scr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Senter Charge Derek Besar';
            }  else if(isset($scr['scr']['kondisi'])){
                $errors[] = 'Harap Isi Status Senter Charge Derek Besar';
        }
            else   {
                $scr = ConditionStatus::where('status', $scr['scr']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Senter Charge Derek Besar';
            }

            
        $kprdb['kprdb'] = $request->input('kprdb');
        if(empty( $kprdb['kprdb'])){
            $errors[] = 'Harap Isi Keterangan Peralatan Derek Besar' ;
        }

        $ecdb['ecdb'] = $request->input('ecdb');
        if (isset($ecdb['ecdb']['status']) && isset($ecdb['ecdb']['kondisi'])) {
            $ecdb = ConditionStatus::where('status', $ecdb['ecdb']['status'])->where('kondisi', $ecdb['ecdb']['kondisi'])->first('id');
        } else if(isset($ecdb['ecdb']['status']) || isset($ecdb['ecdb']['kondisi'])){
            if (isset($ecdb['ecdb']['status']) && $ecdb['ecdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Engine Condition Derek Besar';
            }  else if(isset($ecdb['ecdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Engine Condition Derek Besar';
        }
            else {
                $ecdb = ConditionStatus::where('status', $ecdb['ecdb']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Engine Condition Derek Besar';          
              }

        $rtdb['rtdb'] = $request->input('rtdb');
        if (isset($rtdb['rtdb']['status']) && isset($rtdb['rtdb']['kondisi'])) {
            $rtdb = ConditionStatus::where('status', $rtdb['rtdb']['status'])->where('kondisi', $rtdb['rtdb']['kondisi'])->first('id');
        } else if (isset($rtdb['rtdb']['status']) || isset($rtdb['rtdb']['kondisi'])){
            if (isset($rtdb['rtdb']['status']) && $rtdb['rtdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Running Test Derek Besar';
            }  else if(isset($rtdb['rtdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Running Test Derek Besar';
        }
            else {
                $rtdb = ConditionStatus::where('status', $rtdb['rtdb']['status'])->first('id');
            }
        }  
           else{
                $errors[] ='Harap Isi Running Test Derek Besar';
            }

            
        $acudb['acudb'] = $request->input('acudb');
        if (isset($acudb['acudb']['status']) && isset($acudb['acudb']['kondisi'])) {
            $acudb = ConditionStatus::where('status', $acudb['acudb']['status'])->where('kondisi', $acudb['acudb']['kondisi'])->first('id');
        } else if (isset($acudb['acudb']['status']) || isset($acudb['acudb']['kondisi'])){
            if (isset($acudb['acudb']['status']) && $acudb['acudb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Air Accu Derek Besar';
            }  else if(isset($acudb['acudb']['kondisi'])){
                $errors[] = 'Harap Isi Status Air Accu Derek Besar';
        }
            else  {
                $acudb = ConditionStatus::where('status', $acudb['acudb']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Air Accu Derek Besar';
            }


        $arrdb['arrdb'] = $request->input('arrdb');
        if (isset($arrdb['arrdb']['status']) && isset($arrdb['arrdb']['kondisi'])) {
            $arrdb = ConditionStatus::where('status', $arrdb['arrdb']['status'])->where('kondisi', $arrdb['arrdb']['kondisi'])->first('id');
        } else if  (isset($arrdb['arrdb']['status']) || isset($arrdb['arrdb']['kondisi'])){
            if (isset($arrdb['arrdb']['status']) && $arrdb['arrdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Air Radiator Derek Vesar';
            }  else if(isset($arrdb['arrdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Air Radiator Derek Vesar';
        }
            else {
                $arrdb = ConditionStatus::where('status', $arrdb['arrdb']['status'])->first('id');
            }
        }  
          else{
                $errors[] = 'Harap Isi Air Radiator Derek Vesar';           
             }


        $omndb['omndb'] = $request->input('omndb');
        if (isset($omndb['omndb']['status']) && isset($omndb['omndb']['kondisi'])) {
            $omndb = ConditionStatus::where('status', $omndb['omndb']['status'])->where('kondisi', $omndb['omndb']['kondisi'])->first('id');
        } else if(isset($omndb['omndb']['status']) || isset($omndb['omndb']['kondisi'])){
            if (isset($omndb['omndb']['status']) && $omndb['omndb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Oli Mesin Derek Besar';
            }  else if(isset($omndb['omndb']['kondisi'])){
                $errors[] = 'Harap Isi Status Oli Mesin Derek Besar';
        }
            else  {
                $omndb = ConditionStatus::where('status', $omndb['omndb']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Oli Mesin Derek Besar';
            }

        $mrdb['mrdb'] = $request->input('mrdb');
        if (isset($mrdb['mrdb']['status']) && isset($mrdb['mrdb']['kondisi'])) {
            $mrdb = ConditionStatus::where('status', $mrdb['mrdb']['status'])->where('kondisi', $mrdb['mrdb']['kondisi'])->first('id');
        } else if (isset($mrdb['mrdb']['status']) || isset($mrdb['mrdb']['kondisi'])){
            if (isset($mrdb['mrdb']['status']) && $mrdb['mrdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Minyak Rem Derek Besar';
            }  else if(isset($mrdb['mrdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Minyak Rem Derek Besar';
        }
            else   {
                $mrdb = ConditionStatus::where('status', $mrdb['mrdb']['status'])->first('id');
            }
        }  
         else{
                $errors[] ='Harap Isi Minyak Rem Derek Besar';
            }

        $opsdb['opsdb'] = $request->input('opsdb');
        if (isset($opsdb['opsdb']['status']) && isset($opsdb['opsdb']['kondisi'])) {
            $opsdb = ConditionStatus::where('status', $opsdb['opsdb']['status'])->where('kondisi', $opsdb['opsdb']['kondisi'])->first('id');
        } else if(isset($opsdb['opsdb']['status']) || isset($opsdb['opsdb']['kondisi'])) {
            if (isset($opsdb['opsdb']['status']) && $opsdb['opsdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Oil Power Steering Derek Besar';
            }  else if(isset($opsdb['opsdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Oil Power Steering Derek Besar';
        }
            else {
                $opsdb = ConditionStatus::where('status', $opsdb['opsdb']['status'])->first('id');
            }
        }  
          else{
                $errors[] = 'Harap Isi Oil Power Steering Derek Besar';
            }

        $keengdb['keengdb'] = $request->input('keengdb');
        if(empty( $keengdb['keengdb'])){
            $errors[] = 'Harap Isi Keterangan Engine Derek Besar' ;
        }

        $skidb['skidb'] = $request->input('skidb');
        if (isset($skidb['skidb']['status']) && isset($skidb['skidb']['kondisi'])) {
            $skidb = ConditionStatus::where('status', $skidb['skidb']['status'])->where('kondisi', $skidb['skidb']['kondisi'])->first('id');
        } else if (isset($skidb['skidb']['status']) || isset($skidb['skidb']['kondisi'])){
            if (isset($skidb['skidb']['status']) && $skidb['skidb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Samping Kiri Derek Besar';
            }  else if(isset($skidb['skidb']['kondisi'])){
                $errors[] = 'Harap Isi Status Samping Kiri Derek Besar';
        }
            else  {
                $skidb = ConditionStatus::where('status', $skidb['skidb']['status'])->first('id');
            }
        }  
        else{
                $errors[] = 'Harap Isi Samping Kiri Derek Besar';
            }

        $skadb['skadb'] = $request->input('skadb');
        if (isset($skadb['skadb']['status']) && isset($skadb['skadb']['kondisi'])) {
            $skadb = ConditionStatus::where('status', $skadb['skadb']['status'])->where('kondisi', $skadb['skadb']['kondisi'])->first('id');
        } else if (isset($skadb['skadb']['status']) || isset($skadb['skadb']['kondisi'])){
            if (isset($skadb['skadb']['status']) && $skadb['skadb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Samping Kanan Derek Besar';
            }  else if(isset($skadb['skadb']['kondisi'])){
                $errors[] = 'Harap Isi Status Samping Kanan Derek Besar';
        }
            else {
                $skadb = ConditionStatus::where('status', $skadb['skadb']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Samping Kanan Derek Besar';
            }

        $dpndb['dpndb'] = $request->input('dpndb');
        if (isset($dpndb['dpndb']['status']) && isset($dpndb['dpndb']['kondisi'])) {
            $dpndb = ConditionStatus::where('status', $dpndb['dpndb']['status'])->where('kondisi', $dpndb['dpndb']['kondisi'])->first('id');
        } else if(isset($dpndb['dpndb']['status']) || isset($dpndb['dpndb']['kondisi'])) {
            if (isset($dpndb['dpndb']['status']) && $dpndb['dpndb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Depan Derek Besar';
            }  else if(isset($dpndb['dpndb']['kondisi'])){
                $errors[] = 'Harap Isi Status Depan Derek Besar';
        }
            else  {
                $dpndb = ConditionStatus::where('status', $dpndb['dpndb']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Depan Derek Besar';
            }

        $blgdb['blgdb'] = $request->input('blgdb');
        if (isset($blgdb['blgdb']['status']) && isset($blgdb['blgdb']['kondisi'])) {
            $blgdb = ConditionStatus::where('status', $blgdb['blgdb']['status'])->where('kondisi', $blgdb['blgdb']['kondisi'])->first('id');
        } else if (isset($blgdb['blgdb']['status']) || isset($blgdb['blgdb']['kondisi'])) {
            if (isset($blgdb['blgdb']['status']) && $blgdb['blgdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Belakang Derek Besar';
            }  else if(isset($blgdb['blgdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Belakang Derek Besar';
        }
            else  {
                $blgdb = ConditionStatus::where('status', $blgdb['blgdb']['status'])->first('id');
            }
        }  
          else{
                $errors[] = 'Harap Isi Belakang Derek Besar';
            }

        $atsdb['atsdb'] = $request->input('atsdb');
        if (isset($atsdb['atsdb']['status']) && isset($atsdb['atsdb']['kondisi'])) {
            $atsdb = ConditionStatus::where('status', $atsdb['atsdb']['status'])->where('kondisi', $atsdb['atsdb']['kondisi'])->first('id');
        } else if(isset($atsdb['atsdb']['status']) || isset($atsdb['atsdb']['kondisi'])) {
            if (isset($atsdb['atsdb']['status']) && $atsdb['atsdb']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Atas Derek Besar';
            }  else if(isset($atsdb['atsdb']['kondisi'])){
                $errors[] = 'Harap Isi Status Atas Derek Besar';
        }
            else {
                $atsdb = ConditionStatus::where('status', $atsdb['atsdb']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Atas Derek Besar';
            }
       
        $kbdcdb['kbdcdb'] = $request->input('kbdcdb');
        if(empty( $kbdcdb['kbdcdb'])){
            $errors[] = 'Harap Isi Keterangan Body dan Cat Derek Besar' ;
        }
    
        
        if (count($errors) > 0) {
            // If there are errors, redirect back with the input data and errors.
            return redirect()->back()->withInput()->withErrors($errors);
        }

        
        $data = DerekKecilVehicleLog::find($id);
        $data->personil = (int)$request->personil;
        $request->session()->put('personilDerek',$request->personil);
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
        $data->lampu_kabut = $lk->id;
        $data->radio_tape = $rt->id;
        $data->klakson = $kl->id;
        $data->wiper = $wp->id;
        $data->speaker = $spr->id;
        $data->seat_belt = $sb->id;
        $data->	ket_bagian_dalam = $request->kbd;;
        $data->dongkrak_hidrolik_20_ton = $dh->id;
        $data->tangki_oli_hidrolik = $toh->id;
        $data->winch_warm_5_ton = $ww->id;
        $data->kait_hook = $kh->id;
        $data->kunci_roda = $kr->id;
        $data->dongkrak_buaya = $db->id;
        $data->p3k = $p3k->id;
        $data->sarung_tangan = $st->id;
        $data->helm = $hm->id;
        $data->jas_hujan = $jh->id;
        $data->ket_peralatan = $request->kpr;
        $data->public_adress = $pa->id;
        $data->lampu_rotary = $lsb->id;
        $data->webbing_sling  = $ws->id;
        $data->parking_shock = $ps->id;
        $data->segel = $sl->id;
        $data->ket_peralatan_tambahan = $request->kpt;
        $data->engine_condition  = $ec->id;
        $data->running_test = $rt->id;
        $data->air_accu = $acu->id;
        $data->air_radiator = $arr->id;
        $data-> oli_mesin= $omn->id;
        $data->apar = $apr->id;
        $data->minyak_rem = $mr->id;
        $data->oil_power_steering = $ops->id;
        $data->ket_engine = $request->keeng;
        $data->samping_kiri = $ski->id;
        $data->samping_kanan = $ska->id;
        $data->depan = $dpn->id;
        $data->belakang = $blg->id;
        $data->atas = $ats->id;
        $data->ket_body_cat = $request->kbdc;
        // $data->unit = Auth::user()->nama.'k';
        $data->save();


       

        $data2 = DerekBesarVehicleLog::find($id);
        $data2->personil = (int)$request->personil;
        $request->session()->put('personilDerek',$request->personil);
        $data2->shift = $request->shift;
        $data2->km_awal = $request->odo2;
        $data2->ban_kanan_depan = $bkaddb->id;
        $data2->ban_kanan_belakang = $bkabdb->id;
        $data2->ban_kiri_depan = $bkiddb->id;
        $data2->ban_kiri_belakang = $bkibdb->id;
        $data2->ban_serep = $bsdb->id;
        $data2->ket_roda_ban =$request->kbrdbdb;
        $data2->stnk = $stnkdb->id;
        $data2->lampu_dashboard = $ldbdb->id;
        $data2->lampu_depan = $ldpdb->id;
        $data2->lampu_belakang = $lbgdb->id;
        $data2->lampu_rem = $lrdb->id;
        $data2->lampu_sein = $lsndb->id;
        $data2->lampu_mundur = $lmdb->id;
        $data2->lampu_kabut = $lktdb->id;
        $data2->lampu_strobo = $lsbdb->id;
        $data2->lampu_sorot = $lpsrdb->id;    
        $data2->air_conditioner= $acdb->id;    
        $data2->klakson = $kldb->id;
        $data2->wiper = $wpdb->id;
        $data2->seat_belt = $sbdb->id;
        $data2->apar = $apardb->id;
        $data2->ket_bagian_dalam = $request->kbd;;
        $data2->balok = $blk->id;
        $data2->p3k = $p3kdb->id;
        $data2->katrol = $ktrl->id;
        $data2->dongkrak_hidrolik_20_ton = $dht->id;
        $data2->kunci_shock= $ks->id;
        $data2->kunci_moment= $km->id;
        $data2->kunci_pipa= $kp->id;
        $data2->rantai_m= $rnt->id;
        $data2->tali_sling= $tsg->id;
        $data2->rantai_besi= $rbs->id;
        $data2->segel= $sgl->id;
        $data2->selang_kompresor= $skr->id;
        $data2->helm = $hmdb->id;
        $data2->jas_hujan = $jhdb->id;
        $data2->sarung_tangan = $stdb->id;
        $data2->sepatu_boat = $sbt->id;
        $data2->senter_charge = $scr->id;
        $data2->ket_peralatan = $request->kprdb;
        $data2->engine_condition  = $ecdb->id;
        $data2->running_test = $rtdb->id;
        $data2->air_accu = $acudb->id;
        $data2->air_radiator = $arrdb->id;
        $data2->oli_mesin = $omndb->id;
        $data2->minyak_rem = $mrdb->id;
        $data2->oil_power_steering = $opsdb->id;
        $data2->ket_engine = $request->keeng;
        $data2->samping_kiri = $skidb->id;
        $data2->samping_kanan = $skadb->id;
        $data2->depan = $dpndb->id;
        $data2->belakang = $blgdb->id;
        $data2->atas = $atsdb->id;
        $data2->ket_body_cat = $request->kbdcdb;
        // $data2->unit = Auth::user()->nama.'b';
        $data2->save();

         Session::flash('message', Lang::get('Data Berhasil Diedit'));
        if(Auth::user()->operasional_id==10){
             return redirect()->route('admin.lapenam.ceklis');
        }
        if(Auth::user()->operasional_id==7){
             return redirect()->route('koordinator.lapenam.ceklis');
        }
        return redirect()->route('lapenam.ceklis');
    
    }


}
