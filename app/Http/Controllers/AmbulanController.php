<?php

namespace App\Http\Controllers;

use App\Models\ActivityMutationServiceTol;
use App\Models\AmbulanceVehicleLog;
use App\Models\Category;
use App\Models\ConditionStatus;
use App\Models\MedicalEquipmentLog;
use App\Models\Officer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Lang;
use Session;
use Validator;
use Illuminate\Support\Facades\Auth;


class AmbulanController extends Controller
{
    public function index()
    {
        $id = 4;
        $time = Carbon::now();
       
        $today = $time->toDateString();
        $yesterday = $time->copy()->subDay()->toDateString();
        $tomorrow = $time->copy()->addDay(1)->toDateString();
        $hour = $time->hour;
        $minute = $time->minute;
        $startTime = Carbon::parse('06:30:00')->format('H:i:s');
        $endTimeToday = Carbon::parse('23:59:59')->format('H:i:s');
        $endTimeTomorrow = Carbon::parse('06:30:00')->format('H:i:s');
        
        $shift = 1; // default shift

        if (($hour == 6 && $minute >= 46) || ($hour > 6 && $hour < 14) || ($hour == 14 && $minute <= 30)) {
            $jumlah_mutasi = $this->getJumlahMutasi($today, $tomorrow, $startTime, $endTimeToday, $endTimeTomorrow, $time);
            $shift = $this->determineShift($jumlah_mutasi);
        } elseif (($hour == 14 && $minute >= 31) || ($hour > 14 && $hour < 22) || ($hour == 22 && $minute <= 30)) {
            $jumlah_mutasi = $this->getJumlahMutasi($today, $tomorrow, $startTime, $endTimeToday, $endTimeTomorrow, $time);
            $shift = $this->determineShift($jumlah_mutasi);
        } elseif (($hour == 22 && $minute >= 31) || ($hour > 22 && $hour < 24) || ($hour < 6) || ($hour == 6 && $minute <= 45)) {
            $shift = $this->determineShiftForLateNight($hour, $minute, $today, $yesterday, $time);
        }

        $categories = Category::where('operasional_id', $id)->get();
        $datas = Officer::where('operasional_id', $id)->get();
        return view("pages.ambulan.log-kelengkapan-kendaraan.index", compact('categories', 'datas', 'shift'));
    }

    private function getJumlahMutasi($today, $tomorrow, $startTime, $endTimeToday, $endTimeTomorrow, $time)
    {
        return ActivityMutationServiceTol::where('no_mutasi', 'LIKE', Auth::user()->nama . '-%')
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
    }

    private function determineShift($jumlah_mutasi)
    {
        if ($jumlah_mutasi < 16) {
            return 1;
        } elseif ($jumlah_mutasi < 32) {
            return 2;
        } else {
            return 3;
        }
    }

    private function determineShiftForLateNight($hour, $minute, $today, $yesterday, $time, $tomorrow)
    {
        if ($hour >= 0 && $hour < 6 || ($hour == 6 && $minute <= 45)) {
            $endTimeYesterday = Carbon::parse('06:30:00')->format('H:i:s');
            $starttime3 = Carbon::parse('06:45:00')->format('H:i:s');
            $jumlah_mutasi = ActivityMutationServiceTol::where('no_mutasi', 'LIKE', Auth::user()->nama . '-%')
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
            return $this->determineShift($jumlah_mutasi);
        } else {
            $jumlah_mutasi = $this->getJumlahMutasi($today, $tomorrow, $startTime, $endTimeToday, $endTimeTomorrow, $time);
            
            return $this->determineShift($jumlah_mutasi);
        }
    }
      public function edit($id)
    {
        $datas = AmbulanceVehicleLog::find($id);
        $dataMedis = MedicalEquipmentLog::find($id);
        $categories = Category::where('operasional_id', 4)->get();
        //   dd($datas);
        $p = Officer::where('id', $datas->personil)->first();
      
        return view("pages.ambulan.log-kelengkapan-kendaraan.edit")->with(compact('categories', 'datas', 'p','dataMedis'));
        
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

        //kelengkapan kendaraan ambulan
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
        } else if (isset($wp['wp']['status']) || isset($wp['wp']['kondisi'])){
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

        $sb['sb'] = $request->input('sb');
        if (isset($sb['sb']['status']) && isset($sb['sb']['kondisi'])) {
            $sb = ConditionStatus::where('status', $sb['sb']['status'])->where('kondisi', $sb['sb']['kondisi'])->first('id');
        } else if (isset($sb['sb']['status']) || isset($sb['sb']['kondisi'])){
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
                $errors[] ='Harap Isi Seat Belt';
            }

        $hkp['hkp'] = $request->input('hkp');
        if (isset($hkp['hkp']['status']) && isset($hkp['hkp']['kondisi'])) {
            $hkp = ConditionStatus::where('status', $hkp['hkp']['status'])->where('kondisi', $hkp['hkp']['kondisi'])->first('id');
        } else if (isset($hkp['hkp']['status']) || isset($hkp['hkp']['kondisi'])){
            if (isset($hkp['hkp']['status']) && $hkp['hkp']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Handle Kaca Pintu';
            }  else if(isset($hkp['hkp']['kondisi'])){
                $errors[] = 'Harap Isi Status Handle Kaca Pintu';
        }
            else  {
                $hkp = ConditionStatus::where('status', $hkp['hkp']['status'])->first('id');
            }
        }  
           else{
                $errors[] ='Harap Isi Handle Kaca Pintu';
            }

        $kbd['kbd'] = $request->input('kbd');
        if(empty( $kbd['kbd'])){
            $errors[] = 'Harap Isi Keterangan Bagian Dalam' ;
        }

        $kr['kr'] = $request->input('kr');
        if (isset($kr['kr']['status']) && isset($kr['kr']['kondisi'])) {
            $kr = ConditionStatus::where('status', $kr['kr']['status'])->where('kondisi', $kr['kr']['kondisi'])->first('id');
        } else if(isset($kr['kr']['status']) || isset($kr['kr']['kondisi'])){
            if (isset($kr['kr']['status']) && $kr['kr']['status'] == 1) {
                $errors[] = 'Harp Isi Kondisi Kunci Roda';
            }  else if(isset($kr['kr']['kondisi'])){
                $errors[] = 'Harp Isi Status Kunci Roda';
        }
            else{
                $kr = ConditionStatus::where('status', $kr['kr']['status'])->first('id');
            }
        }  
          else{
                $errors[] ='Harap Isi Kunci Roda';
            }

        $dr['dr'] = $request->input('dr');
        if (isset($dr['dr']['status']) && isset($dr['dr']['kondisi'])) {
            $dr = ConditionStatus::where('status', $dr['dr']['status'])->where('kondisi', $dr['dr']['kondisi'])->first('id');
        } else if(isset($dr['dr']['status']) || isset($dr['dr']['kondisi'])){
            if (isset($dr['dr']['status']) && $dr['dr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Dongkrak';
            }  else if(isset($dr['dr']['kondisi'])){
                $errors[] = 'Harap Isi Status Dongkrak';
        }
            else{
                $dr = ConditionStatus::where('status', $dr['dr']['status'])->first('id');
            }
        }  
          else{
                $errors[] ='Harap Isi Dongkrak';
            }

        $p3k['p3k'] = $request->input('p3k');
        if (isset($p3k['p3k']['status']) && isset($p3k['p3k']['kondisi'])) {
            $p3k = ConditionStatus::where('status', $p3k['p3k']['status'])->where('kondisi', $p3k['p3k']['kondisi'])->first('id');
        } else if(isset($p3k['p3k']['status']) || isset($p3k['p3k']['kondisi'])){
            if (isset($p3k['p3k']['status']) && $p3k['p3k']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi P3K';
            }  else if(isset($p3k['p3k']['kondisi'])){
                $errors[] = 'Harap Isi Status P3K';
        }
            else{
                $p3k = ConditionStatus::where('status', $p3k['p3k']['status'])->first('id');
            }
        }  
          else{
                $errors[] ='Harap Isi P3K';
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
        
        $rnts['rnts'] = $request->input('rnts');
        if (isset($rnts['rnts']['status']) && isset($rnts['rnts']['kondisi'])) {
            $rnts = ConditionStatus::where('status', $rnts['rnts']['status'])->where('kondisi', $rnts['rnts']['kondisi'])->first('id');
        } else if(isset($rnts['rnts']['status']) || isset($rnts['rnts']['kondisi'])){
            if (isset($rnts['rnts']['status']) && $rnts['rnts']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Running Test';
            }  else if(isset($rnts['rnts']['kondisi'])){
                $errors[] = 'Harap Isi Status Running Test';
        }
            else  {
                $rnts = ConditionStatus::where('status', $rnts['rnts']['status'])->first('id');
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

        $ol['ol'] = $request->input('ol');
        if (isset($ol['ol']['status']) && isset($ol['ol']['kondisi'])) {
            $ol = ConditionStatus::where('status', $ol['ol']['status'])->where('kondisi', $ol['ol']['kondisi'])->first('id');
        } else if(isset($ol['ol']['status']) || isset($ol['ol']['kondisi'])){
            if (isset($ol['ol']['status']) && $ol['ol']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Oli';
            }  else if(isset($ol['ol']['kondisi'])){
                $errors[] = 'Harap Isi Status Oli';
        }
            else  {
                $ol = ConditionStatus::where('status', $ol['ol']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Oli';
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

        //kelengkapan kendaraan medis
         $cn['cn'] = $request->input('cn');
        if (isset($cn['cn']['status']) && isset($cn['cn']['kondisi'])) {
            $cn = ConditionStatus::where('status', $cn['cn']['status'])->where('kondisi', $cn['cn']['kondisi'])->first('id');
        } else if(isset($cn['cn']['status']) || isset($cn['cn']['kondisi'])) {
            if (isset($cn['cn']['status']) && $cn['cn']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Cairan NaCl';
            }  else if(isset($cn['cn']['kondisi'])){
                $errors[] = 'Harap Isi Status Cairan NaCl';
        }
            else {
                $cn = ConditionStatus::where('status', $cn['cn']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Cairan NaCl';
            }

         $nbn['nbn'] = $request->input('nbn');
        if (isset($nbn['nbn']['status']) && isset($nbn['nbn']['kondisi'])) {
            $nbn = ConditionStatus::where('status', $nbn['nbn']['status'])->where('kondisi', $nbn['nbn']['kondisi'])->first('id');
        } else if(isset($nbn['nbn']['status']) || isset($nbn['nbn']['kondisi'])) {
            if (isset($nbn['nbn']['status']) && $nbn['nbn']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Nirbekken';
            }  else if(isset($nbn['nbn']['kondisi'])){
                $errors[] = 'Harap Isi Status Nirbekken';
        }
            else {
                $nbn = ConditionStatus::where('status', $nbn['nbn']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Nirbekken';
            }

         $piai['piai'] = $request->input('piai');
        if (isset($piai['piai']['status']) && isset($piai['piai']['kondisi'])) {
            $piai = ConditionStatus::where('status', $piai['piai']['status'])->where('kondisi', $piai['piai']['kondisi'])->first('id');
        } else if(isset($piai['piai']['status']) || isset($piai['piai']['kondisi'])) {
            if (isset($piai['piai']['status']) && $piai['piai']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Pinset Anatomi';
            }  else if(isset($piai['piai']['kondisi'])){
                $errors[] = 'Harap Isi Status Pinset Anatomi';
        }
            else {
                $piai = ConditionStatus::where('status', $piai['piai']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Pinset Anatomi';
            }

         $sm['sm'] = $request->input('sm');
        if (isset($sm['sm']['status']) && isset($sm['sm']['kondisi'])) {
            $sm = ConditionStatus::where('status', $sm['sm']['status'])->where('kondisi', $sm['sm']['kondisi'])->first('id');
        } else if(isset($sm['sm']['status']) || isset($sm['sm']['kondisi'])) {
            if (isset($sm['sm']['status']) && $sm['sm']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Sunction Manual';
            }  else if(isset($sm['sm']['kondisi'])){
                $errors[] = 'Harap Isi Status Sunction Manual';
        }
            else {
                $sm = ConditionStatus::where('status', $sm['sm']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Sunction Manual';
            }

         $to2['to2'] = $request->input('to2');
        if (isset($to2['to2']['status']) && isset($to2['to2']['kondisi'])) {
            $to2 = ConditionStatus::where('status', $to2['to2']['status'])->where('kondisi', $to2['to2']['kondisi'])->first('id');
        } else if(isset($to2['to2']['status']) || isset($to2['to2']['kondisi'])) {
            if (isset($to2['to2']['status']) && $to2['to2']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Tabung O2';
            }  else if(isset($to2['to2']['kondisi'])){
                $errors[] = 'Harap Isi Status Tabung O2';
        }
            else {
                $to2 = ConditionStatus::where('status', $to2['to2']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Tabung O2';
            }

         $ts['ts'] = $request->input('ts');
        if (isset($ts['ts']['status']) && isset($ts['ts']['kondisi'])) {
            $ts = ConditionStatus::where('status', $ts['ts']['status'])->where('kondisi', $ts['ts']['kondisi'])->first('id');
        } else if(isset($ts['ts']['status']) || isset($ts['ts']['kondisi'])) {
            if (isset($ts['ts']['status']) && $ts['ts']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Tandu Skop';
            }  else if(isset($ts['ts']['kondisi'])){
                $errors[] = 'Harap Isi Status Tandu Skop';
        }
            else {
                $ts = ConditionStatus::where('status', $ts['ts']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Tandu Skop';
            }

         $br['br'] = $request->input('br');
        if (isset($br['br']['status']) && isset($br['br']['kondisi'])) {
            $br = ConditionStatus::where('status', $br['br']['status'])->where('kondisi', $br['br']['kondisi'])->first('id');
        } else if(isset($br['br']['status']) || isset($br['br']['kondisi'])) {
            if (isset($br['br']['status']) && $br['br']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Brangkar';
            }  else if(isset($br['br']['kondisi'])){
                $errors[] = 'Harap Isi Status Brangkar';
        }
            else {
                $br = ConditionStatus::where('status', $br['br']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Brangkar';
            }

         $km['km'] = $request->input('km');
        if (isset($km['km']['status']) && isset($km['km']['kondisi'])) {
            $km = ConditionStatus::where('status', $km['km']['status'])->where('kondisi', $km['km']['kondisi'])->first('id');
        } else if(isset($km['km']['status']) || isset($km['km']['kondisi'])) {
            if (isset($km['km']['status']) && $km['km']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kantong Mayat';
            }  else if(isset($km['km']['kondisi'])){
                $errors[] = 'Harap Isi Status Kantong Mayat';
        }
            else {
                $km = ConditionStatus::where('status', $km['km']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Kantong Mayat';
            }

         $bte['bte'] = $request->input('bte');
        if (isset($bte['bte']['status']) && isset($bte['bte']['kondisi'])) {
            $bte = ConditionStatus::where('status', $bte['bte']['status'])->where('kondisi', $bte['bte']['kondisi'])->first('id');
        } else if(isset($bte['bte']['status']) || isset($bte['bte']['kondisi'])) {
            if (isset($bte['bte']['status']) && $bte['bte']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Betadine';
            }  else if(isset($bte['bte']['kondisi'])){
                $errors[] = 'Harap Isi Status Betadine';
        }
            else {
                $bte = ConditionStatus::where('status', $bte['bte']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Betadine';
            }

         $acl['acl'] = $request->input('acl');
        if (isset($acl['acl']['status']) && isset($acl['acl']['kondisi'])) {
            $acl = ConditionStatus::where('status', $acl['acl']['status'])->where('kondisi', $acl['acl']['kondisi'])->first('id');
        } else if(isset($acl['acl']['status']) || isset($acl['acl']['kondisi'])) {
            if (isset($acl['acl']['status']) && $acl['acl']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Alcohol';
            }  else if(isset($acl['acl']['kondisi'])){
                $errors[] = 'Harap Isi Status Alcohol';
        }
            else {
                $acl = ConditionStatus::where('status', $acl['acl']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Alcohol';
            }

         $ks['ks'] = $request->input('ks');
        if (isset($ks['ks']['status']) && isset($ks['ks']['kondisi'])) {
            $ks = ConditionStatus::where('status', $ks['ks']['status'])->where('kondisi', $ks['ks']['kondisi'])->first('id');
        } else if(isset($ks['ks']['status']) || isset($ks['ks']['kondisi'])) {
            if (isset($ks['ks']['status']) && $ks['ks']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kasa Steril';
            }  else if(isset($ks['ks']['kondisi'])){
                $errors[] = 'Harap Isi Status Kasa Steril';
        }
            else {
                $ks = ConditionStatus::where('status', $ks['ks']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Kasa Steril';
            }

         $pe['pe'] = $request->input('pe');
        if (isset($pe['pe']['status']) && isset($pe['pe']['kondisi'])) {
            $pe = ConditionStatus::where('status', $pe['pe']['status'])->where('kondisi', $pe['pe']['kondisi'])->first('id');
        } else if(isset($pe['pe']['status']) || isset($pe['pe']['kondisi'])) {
            if (isset($pe['pe']['status']) && $pe['pe']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Perban Elastis';
            }  else if(isset($pe['pe']['kondisi'])){
                $errors[] = 'Harap Isi Status Perban Elastis';
        }
            else {
                $pe = ConditionStatus::where('status', $pe['pe']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Perban Elastis';
            }

         $kps['kps'] = $request->input('kps');
        if (isset($kps['kps']['status']) && isset($kps['kps']['kondisi'])) {
            $kps = ConditionStatus::where('status', $kps['kps']['status'])->where('kondisi', $kps['kps']['kondisi'])->first('id');
        } else if(isset($kps['kps']['status']) || isset($kps['kps']['kondisi'])) {
            if (isset($kps['kps']['status']) && $kps['kps']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kapas';
            }  else if(isset($kps['kps']['kondisi'])){
                $errors[] = 'Harap Isi Status Kapas';
        }
            else {
                $kps = ConditionStatus::where('status', $kps['kps']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Kapas';
            }
       
         $hdsn['hdsn'] = $request->input('hdsn');
        if (isset($hdsn['hdsn']['status']) && isset($hdsn['hdsn']['kondisi'])) {
            $hdsn = ConditionStatus::where('status', $hdsn['hdsn']['status'])->where('kondisi', $hdsn['hdsn']['kondisi'])->first('id');
        } else if(isset($hdsn['hdsn']['status']) || isset($hdsn['hdsn']['kondisi'])) {
            if (isset($hdsn['hdsn']['status']) && $hdsn['hdsn']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Handskun';
            }  else if(isset($hdsn['hdsn']['kondisi'])){
                $errors[] = 'Harap Isi Status Handskun';
        }
            else {
                $hdsn = ConditionStatus::where('status', $hdsn['hdsn']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Handskun';
            }
       
         $so2['so2'] = $request->input('so2');
        if (isset($so2['so2']['status']) && isset($so2['so2']['kondisi'])) {
            $so2 = ConditionStatus::where('status', $so2['so2']['status'])->where('kondisi', $so2['so2']['kondisi'])->first('id');
        } else if(isset($so2['so2']['status']) || isset($so2['so2']['kondisi'])) {
            if (isset($so2['so2']['status']) && $so2['so2']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Selang O2';
            }  else if(isset($so2['so2']['kondisi'])){
                $errors[] = 'Harap Isi Status Selang O2';
        }
            else {
                $so2 = ConditionStatus::where('status', $so2['so2']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Selang O2';
            }
       
         $ecr['ecr'] = $request->input('ecr');
        if (isset($ecr['ecr']['status']) && isset($ecr['ecr']['kondisi'])) {
            $ecr = ConditionStatus::where('status', $ecr['ecr']['status'])->where('kondisi', $ecr['ecr']['kondisi'])->first('id');
        } else if(isset($ecr['ecr']['status']) || isset($ecr['ecr']['kondisi'])) {
            if (isset($ecr['ecr']['status']) && $ecr['ecr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Extrication Collar';
            }  else if(isset($ecr['ecr']['kondisi'])){
                $errors[] = 'Harap Isi Status Extrication Collar';
        }
            else {
                $ecr = ConditionStatus::where('status', $ecr['ecr']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Extrication Collar';
            }
       
         $bt['bt'] = $request->input('bt');
        if (isset($bt['bt']['status']) && isset($bt['bt']['kondisi'])) {
            $bt = ConditionStatus::where('status', $bt['bt']['status'])->where('kondisi', $bt['bt']['kondisi'])->first('id');
        } else if(isset($bt['bt']['status']) || isset($bt['bt']['kondisi'])) {
            if (isset($bt['bt']['status']) && $bt['bt']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Bidai Tiup';
            }  else if(isset($bt['bt']['kondisi'])){
                $errors[] = 'Harap Isi Status Bidai Tiup';
        }
            else {
                $bt = ConditionStatus::where('status', $bt['bt']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Bidai Tiup';
            }
       
         $mrr['mrr'] = $request->input('mrr');
        if (isset($mrr['mrr']['status']) && isset($mrr['mrr']['kondisi'])) {
            $mrr = ConditionStatus::where('status', $mrr['mrr']['status'])->where('kondisi', $mrr['mrr']['kondisi'])->first('id');
        } else if(isset($mrr['mrr']['status']) || isset($mrr['mrr']['kondisi'])) {
            if (isset($mrr['mrr']['status']) && $mrr['mrr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Masker';
            }  else if(isset($mrr['mrr']['kondisi'])){
                $errors[] = 'Harap Isi Status Masker';
        }
            else {
                $mrr = ConditionStatus::where('status', $mrr['mrr']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Masker';
            }
       
         $gg['gg'] = $request->input('gg');
        if (isset($gg['gg']['status']) && isset($gg['gg']['kondisi'])) {
            $gg = ConditionStatus::where('status', $gg['gg']['status'])->where('kondisi', $gg['gg']['kondisi'])->first('id');
        } else if(isset($gg['gg']['status']) || isset($gg['gg']['kondisi'])) {
            if (isset($gg['gg']['status']) && $gg['gg']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Gunting';
            }  else if(isset($gg['gg']['kondisi'])){
                $errors[] = 'Harap Isi Status Gunting';
        }
            else {
                $gg = ConditionStatus::where('status', $gg['gg']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Gunting';
            }

         $pr['pr'] = $request->input('pr');
        if (isset($pr['pr']['status']) && isset($pr['pr']['kondisi'])) {
            $pr = ConditionStatus::where('status', $pr['pr']['status'])->where('kondisi', $pr['pr']['kondisi'])->first('id');
        } else if(isset($pr['pr']['status']) || isset($pr['pr']['kondisi'])) {
            if (isset($pr['pr']['status']) && $pr['pr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Plester';
            }  else if(isset($pr['pr']['kondisi'])){
                $errors[] = 'Harap Isi Status Plester';
        }
            else {
                $pr = ConditionStatus::where('status', $pr['pr']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Plester';
            }

         $abm['abm'] = $request->input('abm');
        if (isset($abm['abm']['status']) && isset($abm['abm']['kondisi'])) {
            $abm = ConditionStatus::where('status', $abm['abm']['status'])->where('kondisi', $abm['abm']['kondisi'])->first('id');
        } else if(isset($abm['abm']['status']) || isset($abm['abm']['kondisi'])) {
            if (isset($abm['abm']['status']) && $abm['abm']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ambu Bag Masker';
            }  else if(isset($abm['abm']['kondisi'])){
                $errors[] = 'Harap Isi Status Ambu Bag Masker';
        }
            else {
                $abm = ConditionStatus::where('status', $abm['abm']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Ambu Bag Masker';
            }

        $kpm['kpm'] = $request->input('kpm');
        if(empty( $kpm['kpm'])){
            $errors[] = 'Harap Isi Keterangan Peralatan Medis' ;
        }

         $asr['asr'] = $request->input('asr');
        if (isset($asr['asr']['status']) && isset($asr['asr']['kondisi'])) {
            $asr = ConditionStatus::where('status', $asr['asr']['status'])->where('kondisi', $asr['asr']['kondisi'])->first('id');
        } else if(isset($asr['asr']['status']) || isset($asr['asr']['kondisi'])) {
            if (isset($asr['asr']['status']) && $asr['asr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Alat Sterilisator';
            }  else if(isset($asr['asr']['kondisi'])){
                $errors[] = 'Harap Isi Status Alat Sterilisator';
        }
            else {
                $asr = ConditionStatus::where('status', $asr['asr']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Alat Sterilisator';
            }

         $ttp['ttp'] = $request->input('ttp');
        if (isset($ttp['ttp']['status']) && isset($ttp['ttp']['kondisi'])) {
            $ttp = ConditionStatus::where('status', $ttp['ttp']['status'])->where('kondisi', $ttp['ttp']['kondisi'])->first('id');
        } else if(isset($ttp['ttp']['status']) || isset($ttp['ttp']['kondisi'])) {
            if (isset($ttp['ttp']['status']) && $ttp['ttp']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Tempat Tidur Pasien';
            }  else if(isset($ttp['ttp']['kondisi'])){
                $errors[] = 'Harap Isi Status Tempat Tidur Pasien';
        }
            else {
                $ttp = ConditionStatus::where('status', $ttp['ttp']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Tempat Tidur Pasien';
            }

         $kmm['kmm'] = $request->input('kmm');
        if (isset($kmm['kmm']['status']) && isset($kmm['kmm']['kondisi'])) {
            $kmm = ConditionStatus::where('status', $kmm['kmm']['status'])->where('kondisi', $kmm['kmm']['kondisi'])->first('id');
        } else if(isset($kmm['kmm']['status']) || isset($kmm['kmm']['kondisi'])) {
            if (isset($kmm['kmm']['status']) && $kmm['kmm']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kantong Mayat';
            }  else if(isset($kmm['kmm']['kondisi'])){
                $errors[] = 'Harap Isi Status Kantong Mayat';
        }
            else {
                $kmm = ConditionStatus::where('status', $kmm['kmm']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Kantong Mayat';
            }

         $tm['tm'] = $request->input('tm');
        if (isset($tm['tm']['status']) && isset($tm['tm']['kondisi'])) {
            $tm = ConditionStatus::where('status', $tm['tm']['status'])->where('kondisi', $tm['tm']['kondisi'])->first('id');
        } else if(isset($tm['tm']['status']) || isset($tm['tm']['kondisi'])) {
            if (isset($tm['tm']['status']) && $tm['tm']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Tensi Meter';
            }  else if(isset($tm['tm']['kondisi'])){
                $errors[] = 'Harap Isi Status Tensi Meter';
        }
            else {
                $tm = ConditionStatus::where('status', $tm['tm']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Tensi Meter';
            }

         $sp['sp'] = $request->input('sp');
        if (isset($sp['sp']['status']) && isset($sp['sp']['kondisi'])) {
            $sp = ConditionStatus::where('status', $sp['sp']['status'])->where('kondisi', $sp['sp']['kondisi'])->first('id');
        } else if(isset($sp['sp']['status']) || isset($sp['sp']['kondisi'])) {
            if (isset($sp['sp']['status']) && $sp['sp']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Stetescop';
            }  else if(isset($sp['sp']['kondisi'])){
                $errors[] = 'Harap Isi Status Stetescop';
        }
            else {
                $sp = ConditionStatus::where('status', $sp['sp']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Stetescop';
            }

         $kp3k['kp3k'] = $request->input('kp3k');
        if (isset($kp3k['kp3k']['status']) && isset($kp3k['kp3k']['kondisi'])) {
            $kp3k = ConditionStatus::where('status', $kp3k['kp3k']['status'])->where('kondisi', $kp3k['kp3k']['kondisi'])->first('id');
        } else if(isset($kp3k['kp3k']['status']) || isset($kp3k['kp3k']['kondisi'])) {
            if (isset($kp3k['kp3k']['status']) && $kp3k['kp3k']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kotak P3K';
            }  else if(isset($kp3k['kp3k']['kondisi'])){
                $errors[] = 'Harap Isi Status Kotak P3K';
        }
            else {
                $kp3k = ConditionStatus::where('status', $kp3k['kp3k']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Kotak P3K';
            }

         $gp['gp'] = $request->input('gp');
        if (isset($gp['gp']['status']) && isset($gp['gp']['kondisi'])) {
            $gp = ConditionStatus::where('status', $gp['gp']['status'])->where('kondisi', $gp['gp']['kondisi'])->first('id');
        } else if(isset($gp['gp']['status']) || isset($gp['gp']['kondisi'])) {
            if (isset($gp['gp']['status']) && $gp['gp']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Gunting Plester';
            }  else if(isset($gp['gp']['kondisi'])){
                $errors[] = 'Harap Isi Status Gunting Plester';
        }
            else {
                $gp = ConditionStatus::where('status', $gp['gp']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Gunting Plester';
            }

         $gj['gj'] = $request->input('gj');
        if (isset($gj['gj']['status']) && isset($gj['gj']['kondisi'])) {
            $gj = ConditionStatus::where('status', $gj['gj']['status'])->where('kondisi', $gj['gj']['kondisi'])->first('id');
        } else if(isset($gj['gj']['status']) || isset($gj['gj']['kondisi'])) {
            if (isset($gj['gj']['status']) && $gj['gj']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Clem (Gunting Jipit)';
            }  else if(isset($gj['gj']['kondisi'])){
                $errors[] = 'Harap Isi Status Clem (Gunting Jipit)';
        }
            else {
                $gj = ConditionStatus::where('status', $gj['gj']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Clem (Gunting Jipit)';
            }

         $ksm['ksm'] = $request->input('ksm');
        if (isset($ksm['ksm']['status']) && isset($ksm['ksm']['kondisi'])) {
            $ksm = ConditionStatus::where('status', $ksm['ksm']['status'])->where('kondisi', $ksm['ksm']['kondisi'])->first('id');
        } else if(isset($ksm['ksm']['status']) || isset($ksm['ksm']['kondisi'])) {
            if (isset($ksm['ksm']['status']) && $ksm['ksm']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kasa Steril';
            }  else if(isset($ksm['ksm']['kondisi'])){
                $errors[] = 'Harap Isi Status Kasa Steril';
        }
            else {
                $ksm = ConditionStatus::where('status', $ksm['ksm']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Kasa Steril';
            }

         $kg['kg'] = $request->input('kg');
        if (isset($kg['kg']['status']) && isset($kg['kg']['kondisi'])) {
            $kg = ConditionStatus::where('status', $kg['kg']['status'])->where('kondisi', $kg['kg']['kondisi'])->first('id');
        } else if(isset($kg['kg']['status']) || isset($kg['kg']['kondisi'])) {
            if (isset($kg['kg']['status']) && $kg['kg']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kasa Gulung';
            }  else if(isset($kg['kg']['kondisi'])){
                $errors[] = 'Harap Isi Status Kasa Gulung';
        }
            else {
                $kg = ConditionStatus::where('status', $kg['kg']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Kasa Gulung';
            }

         $cnm['cnm'] = $request->input('cnm');
        if (isset($cnm['cnm']['status']) && isset($cnm['cnm']['kondisi'])) {
            $cnm = ConditionStatus::where('status', $cnm['cnm']['status'])->where('kondisi', $cnm['cnm']['kondisi'])->first('id');
        } else if(isset($cnm['cnm']['status']) || isset($cnm['cnm']['kondisi'])) {
            if (isset($cnm['cnm']['status']) && $cnm['cnm']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Cairan NaCl';
            }  else if(isset($cnm['cnm']['kondisi'])){
                $errors[] = 'Harap Isi Status Cairan NaCl';
        }
            else {
                $cnm = ConditionStatus::where('status', $cnm['cnm']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Cairan NaCl';
            }

         $kpsm['kpsm'] = $request->input('kpsm');
        if (isset($kpsm['kpsm']['status']) && isset($kpsm['kpsm']['kondisi'])) {
            $kpsm = ConditionStatus::where('status', $kpsm['kpsm']['status'])->where('kondisi', $kpsm['kpsm']['kondisi'])->first('id');
        } else if(isset($kpsm['kpsm']['status']) || isset($kpsm['kpsm']['kondisi'])) {
            if (isset($kpsm['kpsm']['status']) && $kpsm['kpsm']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kapas';
            }  else if(isset($kpsm['kpsm']['kondisi'])){
                $errors[] = 'Harap Isi Status Kapas';
        }
            else {
                $kpsm = ConditionStatus::where('status', $kpsm['kpsm']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Kapas';
            }

         $hx['hx'] = $request->input('hx');
        if (isset($hx['hx']['status']) && isset($hx['hx']['kondisi'])) {
            $hx = ConditionStatus::where('status', $hx['hx']['status'])->where('kondisi', $hx['hx']['kondisi'])->first('id');
        } else if(isset($hx['hx']['status']) || isset($hx['hx']['kondisi'])) {
            if (isset($hx['hx']['status']) && $hx['hx']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Hipafix';
            }  else if(isset($hx['hx']['kondisi'])){
                $errors[] = 'Harap Isi Status Hipafix';
        }
            else {
                $hx = ConditionStatus::where('status', $hx['hx']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Hipafix';
            }

         $to2m['to2m'] = $request->input('to2m');
        if (isset($to2m['to2m']['status']) && isset($to2m['to2m']['kondisi'])) {
            $to2m = ConditionStatus::where('status', $to2m['to2m']['status'])->where('kondisi', $to2m['to2m']['kondisi'])->first('id');
        } else if(isset($to2m['to2m']['status']) || isset($to2m['to2m']['kondisi'])) {
            if (isset($to2m['to2m']['status']) && $to2m['to2m']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Tabung O2';
            }  else if(isset($to2m['to2m']['kondisi'])){
                $errors[] = 'Harap Isi Status Tabung O2';
        }
            else {
                $to2m = ConditionStatus::where('status', $to2m['to2m']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Tabung O2';
            }

         $btem['btem'] = $request->input('btem');
        if (isset($btem['btem']['status']) && isset($btem['btem']['kondisi'])) {
            $btem = ConditionStatus::where('status', $btem['btem']['status'])->where('kondisi', $btem['btem']['kondisi'])->first('id');
        } else if(isset($btem['btem']['status']) || isset($btem['btem']['kondisi'])) {
            if (isset($btem['btem']['status']) && $btem['btem']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Betadine';
            }  else if(isset($btem['btem']['kondisi'])){
                $errors[] = 'Harap Isi Status Betadine';
        }
            else {
                $btem = ConditionStatus::where('status', $btem['btem']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Betadine';
            }

        $krm['krm'] = $request->input('krm');
        if(empty( $krm['krm'])){
            $errors[] = 'Harap Isi Keterangan Ruang Medis' ;
        }
        
        if (count($errors) > 0) {
            // If there are errors, redirect back with the input data and errors.
            return redirect()->back()->withInput()->withErrors($errors);
        }  
        
        $today =Carbon::now(); 
        $date = $today->toDateString();

        $data = new AmbulanceVehicleLog;
        $data->personil = (int)$request->personil;
        $request->session()->put('personil',$request->personil);
        $data->shift = $request->shift;
        $data->km_awal = $request->odo;
        $data->ban_kanan_depan = $bkad->id;
        $data->ban_kanan_belakang = $bkab->id;
        $data->ban_kiri_depan = $bkid->id;
        $data->ban_kiri_belakang = $bkib->id;
        $data->ban_serep = $bs->id;
        $data->ket_roda_ban =$request->kbrdb;
        $data->stnk = $stnk->id;
        $data->lampu_dashboard = $ldb->id;
        $data->lampu_depan = $ldp->id;
        $data->lampu_belakang = $lbg->id;
        $data->lampu_rem = $lr->id;
        $data->lampu_sein = $lsn->id;
        $data->lampu_mundur = $lm->id;
        $data->air_conditioner = $ac->id;
        $data->klakson = $kl->id;
        $data->wiper = $wp->id;
        $data->seat_belt = $sb->id;
        $data->handle_kaca_pintu = $hkp->id;
        $data->ket_bagian_dalam = $request->kbd;;
        $data->kunci_roda = $kr->id;
        $data->dongkrak = $dr->id;
        $data->p3k = $p3k->id;
        $data->ket_peralatan = $request->kpr;
        $data->public_adress = $pa->id;
        $data->lampu_strobo = $lsb->id;
        $data->lampu_sorot  = $lpsr->id;
        $data->apar  = $apar->id;
        $data->ket_peralatan_tambahan = $request->kpt;
        $data->engine_condition  = $ec->id;
        $data->running_tes = $rnts->id;
        $data->air_radiator = $arr->id;
        $data->oli = $ol->id;
        $data->minyak_rem = $mr->id;
        $data->oil_power_steering = $ops->id;
        $data->ket_engine = $request->keeng;
        $data->samping_kiri = $ski->id;
        $data->samping_kanan = $ska->id;
        $data->depan = $dpn->id;
        $data->belakang = $blg->id;
        $data->atas = $ats->id;
        $data->ket_body_cat = $request->kbdc;
        $data->unit = Auth::user()->nama.'k'."-".$date;
        $data->save();
        $dataMedis = new MedicalEquipmentLog;
        $dataMedis->personil = (int)$request->personil;
        $dataMedis->shift = $request->shift;
        $dataMedis->cairan_nacl= $cn->id;
        $dataMedis->nirbekken = $nbn->id;
        $dataMedis->pinset_anatomi = $pa->id;
        $dataMedis->sunction_manual = $sm->id;
        $dataMedis->tabung_o2 = $to2->id;
        $dataMedis->tandu_skop = $ts->id;
        $dataMedis->brangkar = $br->id;
        $dataMedis->kantong_mayat = $km->id;
        $dataMedis->betadine = $bte->id;
        $dataMedis->alcohol = $acl->id;
        $dataMedis->kasa_steril = $ks->id;
        $dataMedis->perban_elastis = $pe->id;
        $dataMedis->kapas = $kps->id;
        $dataMedis->handskun = $hdsn->id;
        $dataMedis->selang_o2 = $so2->id;
        $dataMedis->extrication_collar = $ecr->id;
        $dataMedis->bidai_tiup = $bt->id;
        $dataMedis->masker = $mrr->id;
        $dataMedis->gunting = $gg->id;
        $dataMedis->plester = $pr->id;
        $dataMedis->ambu_bag_masker = $abm->id;
        $dataMedis->ket_peralatan_medis = $request->kpm;
        $dataMedis->alat_sterilisator = $asr->id;
        $dataMedis->tempat_tidur_pasien = $ttp->id;
        $dataMedis->kantong_mayat_medis = $kmm->id;
        $dataMedis->tensi_meter = $tm->id;
        $dataMedis->stetescop = $sp->id;
        $dataMedis->kotak_p3k = $kp3k->id;
        $dataMedis->gunting_plester = $gp->id;
        $dataMedis->clem = $gj->id;
        $dataMedis->kasa_steril_medis = $ksm->id;
        $dataMedis->kasa_gulung = $kg->id;
        $dataMedis->cairan_nacl_medis = $cnm->id;
        $dataMedis->kapas_medis = $kpsm->id;
        $dataMedis->hipafix = $hx->id;
        $dataMedis->tabung_o2_medis = $to2m->id;
        $dataMedis->betadine_medis = $btem->id;
        $dataMedis->ket_ruang_medis = $request->krm;
        $dataMedis->unit = Auth::user()->nama.'m'.'-'.$date;
        $dataMedis->save();

        if(Auth::user()->operasional_id==10)
        Session::flash('message', Lang::get('Data Berhasil Masuk'));
        return redirect()->route('dashboard-lalin.index');
    }
      public function update(Request $request,$id){
        $errors = array();
   
        $personil['personil'] = $request->input('personil');
        if(empty( $personil['personil'])){
            $errors[] = 'Harap Isi Personil ' ;
        }

        $odo['odo'] = $request->input('odo');
        if(empty( $odo['odo'])){
            $errors[] = 'Harap Isi Odo Meter' ;
        }

        //kelengkapan kendaraan ambulan
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
        } else if (isset($wp['wp']['status']) || isset($wp['wp']['kondisi'])){
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

        $sb['sb'] = $request->input('sb');
        if (isset($sb['sb']['status']) && isset($sb['sb']['kondisi'])) {
            $sb = ConditionStatus::where('status', $sb['sb']['status'])->where('kondisi', $sb['sb']['kondisi'])->first('id');
        } else if (isset($sb['sb']['status']) || isset($sb['sb']['kondisi'])){
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
                $errors[] ='Harap Isi Seat Belt';
            }

        $hkp['hkp'] = $request->input('hkp');
        if (isset($hkp['hkp']['status']) && isset($hkp['hkp']['kondisi'])) {
            $hkp = ConditionStatus::where('status', $hkp['hkp']['status'])->where('kondisi', $hkp['hkp']['kondisi'])->first('id');
        } else if (isset($hkp['hkp']['status']) || isset($hkp['hkp']['kondisi'])){
            if (isset($hkp['hkp']['status']) && $hkp['hkp']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Handle Kaca Pintu';
            }  else if(isset($hkp['hkp']['kondisi'])){
                $errors[] = 'Harap Isi Status Handle Kaca Pintu';
        }
            else  {
                $hkp = ConditionStatus::where('status', $hkp['hkp']['status'])->first('id');
            }
        }  
           else{
                $errors[] ='Harap Isi Handle Kaca Pintu';
            }

        $kbd['kbd'] = $request->input('kbd');
        if(empty( $kbd['kbd'])){
            $errors[] = 'Harap Isi Keterangan Bagian Dalam' ;
        }

        $kr['kr'] = $request->input('kr');
        if (isset($kr['kr']['status']) && isset($kr['kr']['kondisi'])) {
            $kr = ConditionStatus::where('status', $kr['kr']['status'])->where('kondisi', $kr['kr']['kondisi'])->first('id');
        } else if(isset($kr['kr']['status']) || isset($kr['kr']['kondisi'])){
            if (isset($kr['kr']['status']) && $kr['kr']['status'] == 1) {
                $errors[] = 'Harp Isi Kondisi Kunci Roda';
            }  else if(isset($kr['kr']['kondisi'])){
                $errors[] = 'Harp Isi Status Kunci Roda';
        }
            else{
                $kr = ConditionStatus::where('status', $kr['kr']['status'])->first('id');
            }
        }  
          else{
                $errors[] ='Harap Isi Kunci Roda';
            }

        $dr['dr'] = $request->input('dr');
        if (isset($dr['dr']['status']) && isset($dr['dr']['kondisi'])) {
            $dr = ConditionStatus::where('status', $dr['dr']['status'])->where('kondisi', $dr['dr']['kondisi'])->first('id');
        } else if(isset($dr['dr']['status']) || isset($dr['dr']['kondisi'])){
            if (isset($dr['dr']['status']) && $dr['dr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Dongkrak';
            }  else if(isset($dr['dr']['kondisi'])){
                $errors[] = 'Harap Isi Status Dongkrak';
        }
            else{
                $dr = ConditionStatus::where('status', $dr['dr']['status'])->first('id');
            }
        }  
          else{
                $errors[] ='Harap Isi Dongkrak';
            }

        $p3k['p3k'] = $request->input('p3k');
        if (isset($p3k['p3k']['status']) && isset($p3k['p3k']['kondisi'])) {
            $p3k = ConditionStatus::where('status', $p3k['p3k']['status'])->where('kondisi', $p3k['p3k']['kondisi'])->first('id');
        } else if(isset($p3k['p3k']['status']) || isset($p3k['p3k']['kondisi'])){
            if (isset($p3k['p3k']['status']) && $p3k['p3k']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi P3K';
            }  else if(isset($p3k['p3k']['kondisi'])){
                $errors[] = 'Harap Isi Status P3K';
        }
            else{
                $p3k = ConditionStatus::where('status', $p3k['p3k']['status'])->first('id');
            }
        }  
          else{
                $errors[] ='Harap Isi P3K';
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
        
        $rnts['rnts'] = $request->input('rnts');
        if (isset($rnts['rnts']['status']) && isset($rnts['rnts']['kondisi'])) {
            $rnts = ConditionStatus::where('status', $rnts['rnts']['status'])->where('kondisi', $rnts['rnts']['kondisi'])->first('id');
        } else if(isset($rnts['rnts']['status']) || isset($rnts['rnts']['kondisi'])){
            if (isset($rnts['rnts']['status']) && $rnts['rnts']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Running Test';
            }  else if(isset($rnts['rnts']['kondisi'])){
                $errors[] = 'Harap Isi Status Running Test';
        }
            else  {
                $rnts = ConditionStatus::where('status', $rnts['rnts']['status'])->first('id');
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

        $ol['ol'] = $request->input('ol');
        if (isset($ol['ol']['status']) && isset($ol['ol']['kondisi'])) {
            $ol = ConditionStatus::where('status', $ol['ol']['status'])->where('kondisi', $ol['ol']['kondisi'])->first('id');
        } else if(isset($ol['ol']['status']) || isset($ol['ol']['kondisi'])){
            if (isset($ol['ol']['status']) && $ol['ol']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Oli';
            }  else if(isset($ol['ol']['kondisi'])){
                $errors[] = 'Harap Isi Status Oli';
        }
            else  {
                $ol = ConditionStatus::where('status', $ol['ol']['status'])->first('id');
            }
        }  
            else{
                $errors[] = 'Harap Isi Oli';
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

        //kelengkapan kendaraan medis
         $cn['cn'] = $request->input('cn');
        if (isset($cn['cn']['status']) && isset($cn['cn']['kondisi'])) {
            $cn = ConditionStatus::where('status', $cn['cn']['status'])->where('kondisi', $cn['cn']['kondisi'])->first('id');
        } else if(isset($cn['cn']['status']) || isset($cn['cn']['kondisi'])) {
            if (isset($cn['cn']['status']) && $cn['cn']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Cairan NaCl';
            }  else if(isset($cn['cn']['kondisi'])){
                $errors[] = 'Harap Isi Status Cairan NaCl';
        }
            else {
                $cn = ConditionStatus::where('status', $cn['cn']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Cairan NaCl';
            }

         $nbn['nbn'] = $request->input('nbn');
        if (isset($nbn['nbn']['status']) && isset($nbn['nbn']['kondisi'])) {
            $nbn = ConditionStatus::where('status', $nbn['nbn']['status'])->where('kondisi', $nbn['nbn']['kondisi'])->first('id');
        } else if(isset($nbn['nbn']['status']) || isset($nbn['nbn']['kondisi'])) {
            if (isset($nbn['nbn']['status']) && $nbn['nbn']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Nirbekken';
            }  else if(isset($nbn['nbn']['kondisi'])){
                $errors[] = 'Harap Isi Status Nirbekken';
        }
            else {
                $nbn = ConditionStatus::where('status', $nbn['nbn']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Nirbekken';
            }

         $piai['piai'] = $request->input('piai');
        if (isset($piai['piai']['status']) && isset($piai['piai']['kondisi'])) {
            $piai = ConditionStatus::where('status', $piai['piai']['status'])->where('kondisi', $piai['piai']['kondisi'])->first('id');
        } else if(isset($piai['piai']['status']) || isset($piai['piai']['kondisi'])) {
            if (isset($piai['piai']['status']) && $piai['piai']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Pinset Anatomi';
            }  else if(isset($piai['piai']['kondisi'])){
                $errors[] = 'Harap Isi Status Pinset Anatomi';
        }
            else {
                $piai = ConditionStatus::where('status', $piai['piai']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Pinset Anatomi';
            }

         $sm['sm'] = $request->input('sm');
        if (isset($sm['sm']['status']) && isset($sm['sm']['kondisi'])) {
            $sm = ConditionStatus::where('status', $sm['sm']['status'])->where('kondisi', $sm['sm']['kondisi'])->first('id');
        } else if(isset($sm['sm']['status']) || isset($sm['sm']['kondisi'])) {
            if (isset($sm['sm']['status']) && $sm['sm']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Sunction Manual';
            }  else if(isset($sm['sm']['kondisi'])){
                $errors[] = 'Harap Isi Status Sunction Manual';
        }
            else {
                $sm = ConditionStatus::where('status', $sm['sm']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Sunction Manual';
            }

         $to2['to2'] = $request->input('to2');
        if (isset($to2['to2']['status']) && isset($to2['to2']['kondisi'])) {
            $to2 = ConditionStatus::where('status', $to2['to2']['status'])->where('kondisi', $to2['to2']['kondisi'])->first('id');
        } else if(isset($to2['to2']['status']) || isset($to2['to2']['kondisi'])) {
            if (isset($to2['to2']['status']) && $to2['to2']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Tabung O2';
            }  else if(isset($to2['to2']['kondisi'])){
                $errors[] = 'Harap Isi Status Tabung O2';
        }
            else {
                $to2 = ConditionStatus::where('status', $to2['to2']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Tabung O2';
            }

         $ts['ts'] = $request->input('ts');
        if (isset($ts['ts']['status']) && isset($ts['ts']['kondisi'])) {
            $ts = ConditionStatus::where('status', $ts['ts']['status'])->where('kondisi', $ts['ts']['kondisi'])->first('id');
        } else if(isset($ts['ts']['status']) || isset($ts['ts']['kondisi'])) {
            if (isset($ts['ts']['status']) && $ts['ts']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Tandu Skop';
            }  else if(isset($ts['ts']['kondisi'])){
                $errors[] = 'Harap Isi Status Tandu Skop';
        }
            else {
                $ts = ConditionStatus::where('status', $ts['ts']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Tandu Skop';
            }

         $br['br'] = $request->input('br');
        if (isset($br['br']['status']) && isset($br['br']['kondisi'])) {
            $br = ConditionStatus::where('status', $br['br']['status'])->where('kondisi', $br['br']['kondisi'])->first('id');
        } else if(isset($br['br']['status']) || isset($br['br']['kondisi'])) {
            if (isset($br['br']['status']) && $br['br']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Brangkar';
            }  else if(isset($br['br']['kondisi'])){
                $errors[] = 'Harap Isi Status Brangkar';
        }
            else {
                $br = ConditionStatus::where('status', $br['br']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Brangkar';
            }

         $km['km'] = $request->input('km');
        if (isset($km['km']['status']) && isset($km['km']['kondisi'])) {
            $km = ConditionStatus::where('status', $km['km']['status'])->where('kondisi', $km['km']['kondisi'])->first('id');
        } else if(isset($km['km']['status']) || isset($km['km']['kondisi'])) {
            if (isset($km['km']['status']) && $km['km']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kantong Mayat';
            }  else if(isset($km['km']['kondisi'])){
                $errors[] = 'Harap Isi Status Kantong Mayat';
        }
            else {
                $km = ConditionStatus::where('status', $km['km']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Kantong Mayat';
            }

         $bte['bte'] = $request->input('bte');
        if (isset($bte['bte']['status']) && isset($bte['bte']['kondisi'])) {
            $bte = ConditionStatus::where('status', $bte['bte']['status'])->where('kondisi', $bte['bte']['kondisi'])->first('id');
        } else if(isset($bte['bte']['status']) || isset($bte['bte']['kondisi'])) {
            if (isset($bte['bte']['status']) && $bte['bte']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Betadine';
            }  else if(isset($bte['bte']['kondisi'])){
                $errors[] = 'Harap Isi Status Betadine';
        }
            else {
                $bte = ConditionStatus::where('status', $bte['bte']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Betadine';
            }

         $acl['acl'] = $request->input('acl');
        if (isset($acl['acl']['status']) && isset($acl['acl']['kondisi'])) {
            $acl = ConditionStatus::where('status', $acl['acl']['status'])->where('kondisi', $acl['acl']['kondisi'])->first('id');
        } else if(isset($acl['acl']['status']) || isset($acl['acl']['kondisi'])) {
            if (isset($acl['acl']['status']) && $acl['acl']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Alcohol';
            }  else if(isset($acl['acl']['kondisi'])){
                $errors[] = 'Harap Isi Status Alcohol';
        }
            else {
                $acl = ConditionStatus::where('status', $acl['acl']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Alcohol';
            }

         $ks['ks'] = $request->input('ks');
        if (isset($ks['ks']['status']) && isset($ks['ks']['kondisi'])) {
            $ks = ConditionStatus::where('status', $ks['ks']['status'])->where('kondisi', $ks['ks']['kondisi'])->first('id');
        } else if(isset($ks['ks']['status']) || isset($ks['ks']['kondisi'])) {
            if (isset($ks['ks']['status']) && $ks['ks']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kasa Steril';
            }  else if(isset($ks['ks']['kondisi'])){
                $errors[] = 'Harap Isi Status Kasa Steril';
        }
            else {
                $ks = ConditionStatus::where('status', $ks['ks']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Kasa Steril';
            }

         $pe['pe'] = $request->input('pe');
        if (isset($pe['pe']['status']) && isset($pe['pe']['kondisi'])) {
            $pe = ConditionStatus::where('status', $pe['pe']['status'])->where('kondisi', $pe['pe']['kondisi'])->first('id');
        } else if(isset($pe['pe']['status']) || isset($pe['pe']['kondisi'])) {
            if (isset($pe['pe']['status']) && $pe['pe']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Perban Elastis';
            }  else if(isset($pe['pe']['kondisi'])){
                $errors[] = 'Harap Isi Status Perban Elastis';
        }
            else {
                $pe = ConditionStatus::where('status', $pe['pe']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Perban Elastis';
            }

         $kps['kps'] = $request->input('kps');
        if (isset($kps['kps']['status']) && isset($kps['kps']['kondisi'])) {
            $kps = ConditionStatus::where('status', $kps['kps']['status'])->where('kondisi', $kps['kps']['kondisi'])->first('id');
        } else if(isset($kps['kps']['status']) || isset($kps['kps']['kondisi'])) {
            if (isset($kps['kps']['status']) && $kps['kps']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kapas';
            }  else if(isset($kps['kps']['kondisi'])){
                $errors[] = 'Harap Isi Status Kapas';
        }
            else {
                $kps = ConditionStatus::where('status', $kps['kps']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Kapas';
            }
       
         $hdsn['hdsn'] = $request->input('hdsn');
        if (isset($hdsn['hdsn']['status']) && isset($hdsn['hdsn']['kondisi'])) {
            $hdsn = ConditionStatus::where('status', $hdsn['hdsn']['status'])->where('kondisi', $hdsn['hdsn']['kondisi'])->first('id');
        } else if(isset($hdsn['hdsn']['status']) || isset($hdsn['hdsn']['kondisi'])) {
            if (isset($hdsn['hdsn']['status']) && $hdsn['hdsn']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Handskun';
            }  else if(isset($hdsn['hdsn']['kondisi'])){
                $errors[] = 'Harap Isi Status Handskun';
        }
            else {
                $hdsn = ConditionStatus::where('status', $hdsn['hdsn']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Handskun';
            }
       
         $so2['so2'] = $request->input('so2');
        if (isset($so2['so2']['status']) && isset($so2['so2']['kondisi'])) {
            $so2 = ConditionStatus::where('status', $so2['so2']['status'])->where('kondisi', $so2['so2']['kondisi'])->first('id');
        } else if(isset($so2['so2']['status']) || isset($so2['so2']['kondisi'])) {
            if (isset($so2['so2']['status']) && $so2['so2']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Selang O2';
            }  else if(isset($so2['so2']['kondisi'])){
                $errors[] = 'Harap Isi Status Selang O2';
        }
            else {
                $so2 = ConditionStatus::where('status', $so2['so2']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Selang O2';
            }
       
         $ecr['ecr'] = $request->input('ecr');
        if (isset($ecr['ecr']['status']) && isset($ecr['ecr']['kondisi'])) {
            $ecr = ConditionStatus::where('status', $ecr['ecr']['status'])->where('kondisi', $ecr['ecr']['kondisi'])->first('id');
        } else if(isset($ecr['ecr']['status']) || isset($ecr['ecr']['kondisi'])) {
            if (isset($ecr['ecr']['status']) && $ecr['ecr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Extrication Collar';
            }  else if(isset($ecr['ecr']['kondisi'])){
                $errors[] = 'Harap Isi Status Extrication Collar';
        }
            else {
                $ecr = ConditionStatus::where('status', $ecr['ecr']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Extrication Collar';
            }
       
         $bt['bt'] = $request->input('bt');
        if (isset($bt['bt']['status']) && isset($bt['bt']['kondisi'])) {
            $bt = ConditionStatus::where('status', $bt['bt']['status'])->where('kondisi', $bt['bt']['kondisi'])->first('id');
        } else if(isset($bt['bt']['status']) || isset($bt['bt']['kondisi'])) {
            if (isset($bt['bt']['status']) && $bt['bt']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Bidai Tiup';
            }  else if(isset($bt['bt']['kondisi'])){
                $errors[] = 'Harap Isi Status Bidai Tiup';
        }
            else {
                $bt = ConditionStatus::where('status', $bt['bt']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Bidai Tiup';
            }
       
         $mrr['mrr'] = $request->input('mrr');
        if (isset($mrr['mrr']['status']) && isset($mrr['mrr']['kondisi'])) {
            $mrr = ConditionStatus::where('status', $mrr['mrr']['status'])->where('kondisi', $mrr['mrr']['kondisi'])->first('id');
        } else if(isset($mrr['mrr']['status']) || isset($mrr['mrr']['kondisi'])) {
            if (isset($mrr['mrr']['status']) && $mrr['mrr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Masker';
            }  else if(isset($mrr['mrr']['kondisi'])){
                $errors[] = 'Harap Isi Status Masker';
        }
            else {
                $mrr = ConditionStatus::where('status', $mrr['mrr']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Masker';
            }
       
         $gg['gg'] = $request->input('gg');
        if (isset($gg['gg']['status']) && isset($gg['gg']['kondisi'])) {
            $gg = ConditionStatus::where('status', $gg['gg']['status'])->where('kondisi', $gg['gg']['kondisi'])->first('id');
        } else if(isset($gg['gg']['status']) || isset($gg['gg']['kondisi'])) {
            if (isset($gg['gg']['status']) && $gg['gg']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Gunting';
            }  else if(isset($gg['gg']['kondisi'])){
                $errors[] = 'Harap Isi Status Gunting';
        }
            else {
                $gg = ConditionStatus::where('status', $gg['gg']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Gunting';
            }

         $pr['pr'] = $request->input('pr');
        if (isset($pr['pr']['status']) && isset($pr['pr']['kondisi'])) {
            $pr = ConditionStatus::where('status', $pr['pr']['status'])->where('kondisi', $pr['pr']['kondisi'])->first('id');
        } else if(isset($pr['pr']['status']) || isset($pr['pr']['kondisi'])) {
            if (isset($pr['pr']['status']) && $pr['pr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Plester';
            }  else if(isset($pr['pr']['kondisi'])){
                $errors[] = 'Harap Isi Status Plester';
        }
            else {
                $pr = ConditionStatus::where('status', $pr['pr']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Plester';
            }

         $abm['abm'] = $request->input('abm');
        if (isset($abm['abm']['status']) && isset($abm['abm']['kondisi'])) {
            $abm = ConditionStatus::where('status', $abm['abm']['status'])->where('kondisi', $abm['abm']['kondisi'])->first('id');
        } else if(isset($abm['abm']['status']) || isset($abm['abm']['kondisi'])) {
            if (isset($abm['abm']['status']) && $abm['abm']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Ambu Bag Masker';
            }  else if(isset($abm['abm']['kondisi'])){
                $errors[] = 'Harap Isi Status Ambu Bag Masker';
        }
            else {
                $abm = ConditionStatus::where('status', $abm['abm']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Ambu Bag Masker';
            }

        $kpm['kpm'] = $request->input('kpm');
        if(empty( $kpm['kpm'])){
            $errors[] = 'Harap Isi Keterangan Peralatan Medis' ;
        }

         $asr['asr'] = $request->input('asr');
        if (isset($asr['asr']['status']) && isset($asr['asr']['kondisi'])) {
            $asr = ConditionStatus::where('status', $asr['asr']['status'])->where('kondisi', $asr['asr']['kondisi'])->first('id');
        } else if(isset($asr['asr']['status']) || isset($asr['asr']['kondisi'])) {
            if (isset($asr['asr']['status']) && $asr['asr']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Alat Sterilisator';
            }  else if(isset($asr['asr']['kondisi'])){
                $errors[] = 'Harap Isi Status Alat Sterilisator';
        }
            else {
                $asr = ConditionStatus::where('status', $asr['asr']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Alat Sterilisator';
            }

         $ttp['ttp'] = $request->input('ttp');
        if (isset($ttp['ttp']['status']) && isset($ttp['ttp']['kondisi'])) {
            $ttp = ConditionStatus::where('status', $ttp['ttp']['status'])->where('kondisi', $ttp['ttp']['kondisi'])->first('id');
        } else if(isset($ttp['ttp']['status']) || isset($ttp['ttp']['kondisi'])) {
            if (isset($ttp['ttp']['status']) && $ttp['ttp']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Tempat Tidur Pasien';
            }  else if(isset($ttp['ttp']['kondisi'])){
                $errors[] = 'Harap Isi Status Tempat Tidur Pasien';
        }
            else {
                $ttp = ConditionStatus::where('status', $ttp['ttp']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Tempat Tidur Pasien';
            }

         $kmm['kmm'] = $request->input('kmm');
        if (isset($kmm['kmm']['status']) && isset($kmm['kmm']['kondisi'])) {
            $kmm = ConditionStatus::where('status', $kmm['kmm']['status'])->where('kondisi', $kmm['kmm']['kondisi'])->first('id');
        } else if(isset($kmm['kmm']['status']) || isset($kmm['kmm']['kondisi'])) {
            if (isset($kmm['kmm']['status']) && $kmm['kmm']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kantong Mayat';
            }  else if(isset($kmm['kmm']['kondisi'])){
                $errors[] = 'Harap Isi Status Kantong Mayat';
        }
            else {
                $kmm = ConditionStatus::where('status', $kmm['kmm']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Kantong Mayat';
            }

         $tm['tm'] = $request->input('tm');
        if (isset($tm['tm']['status']) && isset($tm['tm']['kondisi'])) {
            $tm = ConditionStatus::where('status', $tm['tm']['status'])->where('kondisi', $tm['tm']['kondisi'])->first('id');
        } else if(isset($tm['tm']['status']) || isset($tm['tm']['kondisi'])) {
            if (isset($tm['tm']['status']) && $tm['tm']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Tensi Meter';
            }  else if(isset($tm['tm']['kondisi'])){
                $errors[] = 'Harap Isi Status Tensi Meter';
        }
            else {
                $tm = ConditionStatus::where('status', $tm['tm']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Tensi Meter';
            }

         $sp['sp'] = $request->input('sp');
        if (isset($sp['sp']['status']) && isset($sp['sp']['kondisi'])) {
            $sp = ConditionStatus::where('status', $sp['sp']['status'])->where('kondisi', $sp['sp']['kondisi'])->first('id');
        } else if(isset($sp['sp']['status']) || isset($sp['sp']['kondisi'])) {
            if (isset($sp['sp']['status']) && $sp['sp']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Stetescop';
            }  else if(isset($sp['sp']['kondisi'])){
                $errors[] = 'Harap Isi Status Stetescop';
        }
            else {
                $sp = ConditionStatus::where('status', $sp['sp']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Stetescop';
            }

         $kp3k['kp3k'] = $request->input('kp3k');
        if (isset($kp3k['kp3k']['status']) && isset($kp3k['kp3k']['kondisi'])) {
            $kp3k = ConditionStatus::where('status', $kp3k['kp3k']['status'])->where('kondisi', $kp3k['kp3k']['kondisi'])->first('id');
        } else if(isset($kp3k['kp3k']['status']) || isset($kp3k['kp3k']['kondisi'])) {
            if (isset($kp3k['kp3k']['status']) && $kp3k['kp3k']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kotak P3K';
            }  else if(isset($kp3k['kp3k']['kondisi'])){
                $errors[] = 'Harap Isi Status Kotak P3K';
        }
            else {
                $kp3k = ConditionStatus::where('status', $kp3k['kp3k']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Kotak P3K';
            }

         $gp['gp'] = $request->input('gp');
        if (isset($gp['gp']['status']) && isset($gp['gp']['kondisi'])) {
            $gp = ConditionStatus::where('status', $gp['gp']['status'])->where('kondisi', $gp['gp']['kondisi'])->first('id');
        } else if(isset($gp['gp']['status']) || isset($gp['gp']['kondisi'])) {
            if (isset($gp['gp']['status']) && $gp['gp']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Gunting Plester';
            }  else if(isset($gp['gp']['kondisi'])){
                $errors[] = 'Harap Isi Status Gunting Plester';
        }
            else {
                $gp = ConditionStatus::where('status', $gp['gp']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Gunting Plester';
            }

         $gj['gj'] = $request->input('gj');
        if (isset($gj['gj']['status']) && isset($gj['gj']['kondisi'])) {
            $gj = ConditionStatus::where('status', $gj['gj']['status'])->where('kondisi', $gj['gj']['kondisi'])->first('id');
        } else if(isset($gj['gj']['status']) || isset($gj['gj']['kondisi'])) {
            if (isset($gj['gj']['status']) && $gj['gj']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Clem (Gunting Jipit)';
            }  else if(isset($gj['gj']['kondisi'])){
                $errors[] = 'Harap Isi Status Clem (Gunting Jipit)';
        }
            else {
                $gj = ConditionStatus::where('status', $gj['gj']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Clem (Gunting Jipit)';
            }

         $ksm['ksm'] = $request->input('ksm');
        if (isset($ksm['ksm']['status']) && isset($ksm['ksm']['kondisi'])) {
            $ksm = ConditionStatus::where('status', $ksm['ksm']['status'])->where('kondisi', $ksm['ksm']['kondisi'])->first('id');
        } else if(isset($ksm['ksm']['status']) || isset($ksm['ksm']['kondisi'])) {
            if (isset($ksm['ksm']['status']) && $ksm['ksm']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kasa Steril';
            }  else if(isset($ksm['ksm']['kondisi'])){
                $errors[] = 'Harap Isi Status Kasa Steril';
        }
            else {
                $ksm = ConditionStatus::where('status', $ksm['ksm']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Kasa Steril';
            }

         $kg['kg'] = $request->input('kg');
        if (isset($kg['kg']['status']) && isset($kg['kg']['kondisi'])) {
            $kg = ConditionStatus::where('status', $kg['kg']['status'])->where('kondisi', $kg['kg']['kondisi'])->first('id');
        } else if(isset($kg['kg']['status']) || isset($kg['kg']['kondisi'])) {
            if (isset($kg['kg']['status']) && $kg['kg']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kasa Gulung';
            }  else if(isset($kg['kg']['kondisi'])){
                $errors[] = 'Harap Isi Status Kasa Gulung';
        }
            else {
                $kg = ConditionStatus::where('status', $kg['kg']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Kasa Gulung';
            }

         $cnm['cnm'] = $request->input('cnm');
        if (isset($cnm['cnm']['status']) && isset($cnm['cnm']['kondisi'])) {
            $cnm = ConditionStatus::where('status', $cnm['cnm']['status'])->where('kondisi', $cnm['cnm']['kondisi'])->first('id');
        } else if(isset($cnm['cnm']['status']) || isset($cnm['cnm']['kondisi'])) {
            if (isset($cnm['cnm']['status']) && $cnm['cnm']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Cairan NaCl';
            }  else if(isset($cnm['cnm']['kondisi'])){
                $errors[] = 'Harap Isi Status Cairan NaCl';
        }
            else {
                $cnm = ConditionStatus::where('status', $cnm['cnm']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Cairan NaCl';
            }

         $kpsm['kpsm'] = $request->input('kpsm');
        if (isset($kpsm['kpsm']['status']) && isset($kpsm['kpsm']['kondisi'])) {
            $kpsm = ConditionStatus::where('status', $kpsm['kpsm']['status'])->where('kondisi', $kpsm['kpsm']['kondisi'])->first('id');
        } else if(isset($kpsm['kpsm']['status']) || isset($kpsm['kpsm']['kondisi'])) {
            if (isset($kpsm['kpsm']['status']) && $kpsm['kpsm']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Kapas';
            }  else if(isset($kpsm['kpsm']['kondisi'])){
                $errors[] = 'Harap Isi Status Kapas';
        }
            else {
                $kpsm = ConditionStatus::where('status', $kpsm['kpsm']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Kapas';
            }

         $hx['hx'] = $request->input('hx');
        if (isset($hx['hx']['status']) && isset($hx['hx']['kondisi'])) {
            $hx = ConditionStatus::where('status', $hx['hx']['status'])->where('kondisi', $hx['hx']['kondisi'])->first('id');
        } else if(isset($hx['hx']['status']) || isset($hx['hx']['kondisi'])) {
            if (isset($hx['hx']['status']) && $hx['hx']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Hipafix';
            }  else if(isset($hx['hx']['kondisi'])){
                $errors[] = 'Harap Isi Status Hipafix';
        }
            else {
                $hx = ConditionStatus::where('status', $hx['hx']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Hipafix';
            }

         $to2m['to2m'] = $request->input('to2m');
        if (isset($to2m['to2m']['status']) && isset($to2m['to2m']['kondisi'])) {
            $to2m = ConditionStatus::where('status', $to2m['to2m']['status'])->where('kondisi', $to2m['to2m']['kondisi'])->first('id');
        } else if(isset($to2m['to2m']['status']) || isset($to2m['to2m']['kondisi'])) {
            if (isset($to2m['to2m']['status']) && $to2m['to2m']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Tabung O2';
            }  else if(isset($to2m['to2m']['kondisi'])){
                $errors[] = 'Harap Isi Status Tabung O2';
        }
            else {
                $to2m = ConditionStatus::where('status', $to2m['to2m']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Tabung O2';
            }

         $btem['btem'] = $request->input('btem');
        if (isset($btem['btem']['status']) && isset($btem['btem']['kondisi'])) {
            $btem = ConditionStatus::where('status', $btem['btem']['status'])->where('kondisi', $btem['btem']['kondisi'])->first('id');
        } else if(isset($btem['btem']['status']) || isset($btem['btem']['kondisi'])) {
            if (isset($btem['btem']['status']) && $btem['btem']['status'] == 1) {
                $errors[] = 'Harap Isi Kondisi Betadine';
            }  else if(isset($btem['btem']['kondisi'])){
                $errors[] = 'Harap Isi Status Betadine';
        }
            else {
                $btem = ConditionStatus::where('status', $btem['btem']['status'])->first('id');
            }
        }  
         else{
                $errors[] = 'Harap Isi Betadine';
            }

        $krm['krm'] = $request->input('krm');
        if(empty( $krm['krm'])){
            $errors[] = 'Harap Isi Keterangan Ruang Medis' ;
        }
        
        if (count($errors) > 0) {
            // If there are errors, redirect back with the input data and errors.
            return redirect()->back()->withInput()->withErrors($errors);
        }  
       

        $data = AmbulanceVehicleLog::find($id);
        $data->personil = (int)$request->personil;
        $request->session()->put('personil',$request->personil);
        $data->shift = $request->shift;
        $data->km_awal = $request->odo;
        $data->ban_kanan_depan = $bkad->id;
        $data->ban_kanan_belakang = $bkab->id;
        $data->ban_kiri_depan = $bkid->id;
        $data->ban_kiri_belakang = $bkib->id;
        $data->ban_serep = $bs->id;
        $data->ket_roda_ban =$request->kbrdb;
        $data->stnk = $stnk->id;
        $data->lampu_dashboard = $ldb->id;
        $data->lampu_depan = $ldp->id;
        $data->lampu_belakang = $lbg->id;
        $data->lampu_rem = $lr->id;
        $data->lampu_sein = $lsn->id;
        $data->lampu_mundur = $lm->id;
        $data->air_conditioner = $ac->id;
        $data->klakson = $kl->id;
        $data->wiper = $wp->id;
        $data->seat_belt = $sb->id;
        $data->handle_kaca_pintu = $hkp->id;
        $data->ket_bagian_dalam = $request->kbd;;
        $data->kunci_roda = $kr->id;
        $data->dongkrak = $dr->id;
        $data->p3k = $p3k->id;
        $data->ket_peralatan = $request->kpr;
        $data->public_adress = $pa->id;
        $data->lampu_strobo = $lsb->id;
        $data->lampu_sorot  = $lpsr->id;
        $data->apar  = $apar->id;
        $data->ket_peralatan_tambahan = $request->kpt;
        $data->engine_condition  = $ec->id;
        $data->running_tes = $rnts->id;
        $data->air_radiator = $arr->id;
        $data->oli = $ol->id;
        $data->minyak_rem = $mr->id;
        $data->oil_power_steering = $ops->id;
        $data->ket_engine = $request->keeng;
        $data->samping_kiri = $ski->id;
        $data->samping_kanan = $ska->id;
        $data->depan = $dpn->id;
        $data->belakang = $blg->id;
        $data->atas = $ats->id;
        $data->ket_body_cat = $request->kbdc;
        // $data->unit = Auth::user()->nama;
        $data->save();


        $dataMedis = MedicalEquipmentLog::find($id);
        $dataMedis->personil = (int)$request->personil;
        $dataMedis->shift = $request->shift;
        $dataMedis->cairan_nacl= $cn->id;
        $dataMedis->nirbekken = $nbn->id;
        $dataMedis->pinset_anatomi = $pa->id;
        $dataMedis->sunction_manual = $sm->id;
        $dataMedis->tabung_o2 = $to2->id;
        $dataMedis->tandu_skop = $ts->id;
        $dataMedis->brangkar = $br->id;
        $dataMedis->kantong_mayat = $km->id;
        $dataMedis->betadine = $bte->id;
        $dataMedis->alcohol = $acl->id;
        $dataMedis->kasa_steril = $ks->id;
        $dataMedis->perban_elastis = $pe->id;
        $dataMedis->kapas = $kps->id;
        $dataMedis->handskun = $hdsn->id;
        $dataMedis->selang_o2 = $so2->id;
        $dataMedis->extrication_collar = $ecr->id;
        $dataMedis->bidai_tiup = $bt->id;
        $dataMedis->masker = $mrr->id;
        $dataMedis->gunting = $gg->id;
        $dataMedis->plester = $pr->id;
        $dataMedis->ambu_bag_masker = $abm->id;
        $dataMedis->ket_peralatan_medis = $request->kpm;
        $dataMedis->alat_sterilisator = $asr->id;
        $dataMedis->tempat_tidur_pasien = $ttp->id;
        $dataMedis->kantong_mayat_medis = $kmm->id;
        $dataMedis->tensi_meter = $tm->id;
        $dataMedis->stetescop = $sp->id;
        $dataMedis->kotak_p3k = $kp3k->id;
        $dataMedis->gunting_plester = $gp->id;
        $dataMedis->clem = $gj->id;
        $dataMedis->kasa_steril_medis = $ksm->id;
        $dataMedis->kasa_gulung = $kg->id;
        $dataMedis->cairan_nacl_medis = $cnm->id;
        $dataMedis->kapas_medis = $kpsm->id;
        $dataMedis->hipafix = $hx->id;
        $dataMedis->tabung_o2_medis = $to2m->id;
        $dataMedis->betadine_medis = $btem->id;
        $dataMedis->ket_ruang_medis = $request->krm;
        // $dataMedis->unit = Auth::user()->nama;
        $dataMedis->save();

        Session::flash('message', Lang::get('Data Berhasil Diedit'));
        if(Auth::user()->operasional_id==10){
             return redirect()->route('admin.lapenam.ceklis');
        }
        if(Auth::user()->operasional_id==8){
             return redirect()->route('koordinator.lapenam.ceklis');
        }
      
        return redirect()->route('lapenam.ceklis');
    }

     public function exportVehicleLog($id)
    {
        try {
            $cek = AmbulanceVehicleLog::where('id',$id)
            ->first();
            // dd($cek);
        if ($cek) {
            $date = $cek->created_at;
        }
    
            $data = AmbulanceVehicleLog::whereBetween('shift',[1,3])
                ->where('unit',$cek->unit)
                ->get()
                ->toArray();
               
        } catch (\Exception $errors) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['message' => Lang::get('Data Not Found')]);
        }

        // dd($data['no_mutasi']);
        $pdf = Pdf::loadView('pdf.pemeriksaan-kendaraan-ambulans', compact('data'));

        return $pdf->stream('Log Kelengkapan Ambulance' . '.pdf');
    }
     public function exportMedicalLog($id)
    {
        try {
            $cek = MedicalEquipmentLog::where('id',$id)
            ->first();

        if ($cek) {
            $date = $cek->created_at;
        }
    
            $data = MedicalEquipmentLog::whereBetween('shift',[1,3])
                ->where('unit',$cek->unit)
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
        $pdf = Pdf::loadView('pdf.pemeriksaan-peralatan-medis', compact('data'));

        return $pdf->stream('Log Kelengkapan Medis' . '.pdf');
    }
}
