<?php

namespace App\Http\Controllers;

use App\Models\ActivityMutationServiceTol;
use App\Models\AsetLocation;
use App\Models\Condition;
use App\Models\HandoverTolInventoryLog;
use App\Models\Officer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Lang;
use Session;
use Validator;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
class SecurityControler extends Controller
{
       public function index()
    {
        $id = 5;
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
        // dd($hour);
        $datas = Officer::where('operasional_id', $id)->get();
        $location = AsetLocation::all();
        $condition = Condition::all();
        return view("pages.security.log-serah-terima-inventaris.index")->with(compact( 'datas', 'shift', 'location','condition', 'jumlah_mutasi'));
        
    }
       public function edit($id)
    {
        $datas = HandoverTolInventoryLog::find($id);
        $personil = Officer::where('id', $datas->personil)->first();
        $condition = Condition::all();
        return view("pages.security.log-serah-terima-inventaris.edit")->with(compact( 'datas', 'personil','condition'));
        
    }
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
           
            'personil'=> 'required',
            'jmlh_ht'=> 'required',
            'ht'=> 'required',
            'jmlh_bc'=> 'required',
            'bc'=> 'required',
            'jmlh_acr'=> 'required',
            'acr'=> 'required',
            'jmlh_tt'=> 'required',
            'tt'=> 'required',
            'jmlh_ts'=> 'required',
            'ts'=> 'required',
            'jmlh_ar'=> 'required',
            'ar'=> 'required',
            'jmlh_ws'=> 'required',
            'ws'=> 'required',
            'jmlh_am'=> 'required',
            'am'=> 'required',
            'jmlh_sl'=> 'required',
            'sl'=> 'required',
            'jmlh_apr'=> 'required',
            'apr'=> 'required',
            'jmlh_ac'=> 'required',
            'ac'=> 'required',
            'jmlh_bapr'=> 'required',
            'bapr'=> 'required',
            'jmlh_jh'=> 'required',
            'jh'=> 'required',
            'jmlh_lm'=> 'required',
            'lm'=> 'required',
            'jmlh_cctv'=> 'required',
            'cctv'=> 'required',
            'jmlh_lla'=> 'required',
            'lla'=> 'required',
            'jmlh_rmax'=> 'required',
            'rmax'=> 'required',
            'jmlh_r2'=> 'required',
            'r2'=> 'required',
            'jmlh_mg'=> 'required',
            'mg'=> 'required',
            'jmlh_acu'=> 'required',
            'acu'=> 'required',
            'jmlh_rsp'=> 'required',
            'rsp'=> 'required',
            'jmlh_pg'=> 'required',
            'pg'=> 'required',
            'jmlh_sb'=> 'required',
            'sb'=> 'required',
            'jmlh_pyg'=> 'required',
            'pyg'=> 'required',
            'jmlh_dr'=> 'required',
            'dr'=> 'required',
            'jmlh_gn'=> 'required',
            'gn'=> 'required',
            'jmlh_sa'=> 'required',
            'sa'=> 'required',
            'jmlh_rc'=> 'required',
            'rc'=> 'required',
            'ket'=> 'required',
            
        ],);
         $customMessages = [
        'personil.required' => 'Personil harus diisi',
        'jmlh_ht.required' => 'Jumlah hand talkie harus diisi',
        'ht.required' => 'Hand talkie harus diisi',
        'jmlh_bc.required' => 'Jumlah batok charger harus diisi',
        'bc.required' => 'Batok charger harus diisi',
        'jmlh_acr.required' => 'Jumlah adaptor charger harus diisi',
        'acr.required' => 'Adaptor charger harus diisi',
        'jmlh_tt.required' => 'Jumlah tongkat t harus diisi',
        'tt.required' => 'Tongkat t harus diisi',
        'jmlh_ts.required' => 'Jumlah tali sling harus diisi',
        'ts.required' => 'Tali sling harus diisi',
        'jmlh_ar.required' => 'Jumlah amplifier harus diisi',
        'ar.required' => 'Amplifier harus diisi',
        'jmlh_ws.required' => 'Jumlah wireless harus diisi',
        'ws.required' => 'Wireless harus diisi',
        'jmlh_am.required' => 'Jumlah alarm harus diisi',
        'am.required' => 'Alarm harus diisi',
        'jmlh_sl.required' => 'Jumlah senter lalin harus diisi',
        'sl.required' => 'Senter lalin harus diisi',
        'jmlh_apr.required' => 'Jumlah apar harus diisi',
        'apr.required' => 'Apar harus diisi',
        'jmlh_bapr.required' => 'Jumlah box apar harus diisi',
        'bapr.required' => 'Box apar harus diisi',
        'jmlh_ac.required' => 'Jumlah ac harus diisi',
        'ac.required' => 'Ac harus diisi',
        'jmlh_jh.required' => 'Jumlah jas hujan harus diisi',
        'jh.required' => 'Jas hujan harus diisi',
        'jmlh_lm.required' => 'Jumlah layar monitor harus diisi',
        'lm.required' => 'Layar monitor harus diisi',
        'jmlh_cctv.required' => 'Jumlah cctv harus diisi',
        'cctv.required' => 'Cctv harus diisi',
        'jmlh_lla.required' => 'Jumlah lla harus diisi',
        'lla.required' => 'Lla harus diisi',
        'jmlh_rmax.required' => 'Jumlah R.Max(4,1 M) harus diisi',
        'rmax.required' => 'R.Max(4,1 M) harus diisi',
        'jmlh_r2.required' => 'Jumlah r.2,1 M harus diisi',
        'r2.required' => 'R.2,1 M harus diisi',
        'jmlh_mg.required' => 'Jumlah mesin genset harus diisi',
        'mg.required' => 'Mesin genset harus diisi',
        'jmlh_acu.required' => 'Jumlah accu harus diisi',
        'acu.required' => 'Accu harus diisi',
        'jmlh_rsp.required' => 'Jumlah r.stop harus diisi',
        'rsp.required' => 'R.stop harus diisi',
        'jmlh_pg.required' => 'Jumlah r.palang harus diisi',
        'pg.required' => 'R.palang harus diisi',
        'jmlh_sb.required' => 'Jumlah sepatu boat harus diisi',
        'sb.required' => 'Sepatu boat harus diisi',
        'jmlh_pyg.required' => 'Jumlah payung harus diisi',
        'pyg.required' => 'Payung harus diisi',
        'jmlh_dr.required' => 'Jumlah dispenser harus diisi',
        'dr.required' => 'Dispenser harus diisi',
        'jmlh_gn.required' => 'Jumlah galon harus diisi',
        'gn.required' => 'Galon harus diisi',
        'jmlh_sa.required' => 'Jumlah speaker active harus diisi',
        'sa.required' => 'Speaker active harus diisi',
        'jmlh_rc.required' => 'Jumlah rubber cone harus diisi',
        'rc.required' => 'Rubber cone harus diisi',
        'ket.required' => 'Keterangan harus diisi',
        
    ];

    $validator->setCustomMessages($customMessages);

    if ($validator->fails()) {
        return redirect()->back()->withInput()->withErrors($validator);
    }
        $today =Carbon::now(); 
        $date = $today->toDateString();
        $data = new HandoverTolInventoryLog;
        $data->personil = (int)$request->personil;
        $request->session()->put('personilSecurity',$request->personil);
        $data->shift = $request->shift;
        $data->lokasi_aset = $request->lokasi;
        $data->jumlah_handy_talkie = (int)$request->jmlh_ht;
        $data->handy_talkie = $request->ht;
        $data->jumlah_batok_charger = (int)$request->jmlh_bc;
        $data->batok_charger = $request->bc;
        $data->jumlah_adapter_charger = (int)$request->jmlh_acr;
        $data->adapter_charger = $request->acr;
        $data->jumlah_tongkat_t = (int)$request->jmlh_tt;
        $data->tongkat_t = $request->tt;
        $data->jumlah_tali_sling= (int)$request->jmlh_ts;
        $data->tali_sling= $request->ts;
        $data->jumlah_amplifier = (int)$request->jmlh_ar;
        $data->amplifier = $request->ar;
        $data->jumlah_wireless = (int)$request->jmlh_ws;
        $data->wireless = $request->ws;
        $data->jumlah_alarm = (int)$request->jmlh_am;
        $data->alarm = $request->am;
        $data->jumlah_senter_lalin = (int)$request->jmlh_sl;
        $data->senter_lalin = $request->sl;
        $data->jumlah_apar = (int)$request->jmlh_apr;
        $data->apar = $request->apr;
        $data->jumlah_box_apar = (int)$request->jmlh_bapr;
        $data->box_apar = $request->bapr;
        $data->jumlah_ac = (int)$request->jmlh_ac;
        $data->ac = $request->ac;
        $data->jumlah_jas_hujan = (int)$request->jmlh_jh;
        $data->jas_hujan = $request->jh;
        $data->jumlah_layar_monitor = (int)$request->jmlh_lm;
        $data->layar_monitor = $request->lm;
        $data->jumlah_cctv = (int)$request->jmlh_cctv;
        $data->cctv = $request->cctv;
        $data->jumlah_lla = (int)$request->jmlh_lla;
        $data->lla = $request->lla;
        $data->jumlah_r_max = (int)$request->jmlh_rmax;
        $data->r_max = $request->rmax;
        $data->jumlah_r_21 = (int)$request->jmlh_r2;
        $data->r_21 = $request->r2;
        $data->jumlah_mesin_genset = (int)$request->jmlh_mg;
        $data->mesin_genset = $request->mg;
        $data->jumlah_accu = (int)$request->jmlh_acu;
        $data->accu = $request->acu;
        $data->jumlah_r_stop = (int)$request->jmlh_rsp;
        $data->r_stop = $request->rsp;
        $data->jumlah_r_palang = (int)$request->jmlh_pg;
        $data->r_palang = $request->pg;
        $data->jumlah_sepatu_boat = (int)$request->jmlh_sb;
        $data->sepatu_boat = $request->sb;
        $data->jumlah_payung = (int)$request->jmlh_pyg;
        $data->payung = $request->pyg;
        $data->jumlah_dispenser = (int)$request->jmlh_dr;
        $data->dispenser = $request->dr;
        $data->jumlah_galon = (int)$request->jmlh_gn;
        $data->galon = $request->gn;
        $data->jumlah_speaker_active = (int)$request->jmlh_sa;
        $data->speaker_active = $request->sa;
        $data->jumlah_rubber_cone = (int)$request->jmlh_rc;
        $data->rubber_cone = $request->rc;
        $data->keterangan = $request->ket;
        $data->unit = Auth::user()->nama.'-'.$date;
        // dd($data);
        $data->save();
        
        Session::flash('message', Lang::get('Data Berhasil Masuk'));
        return redirect()->route('dashboard-lalin.index');
      


    }
      
    public function update(Request $request, $id)
    {
         $validator = Validator::make($request->all(), [
           
            'personil'=> 'required',
            'jmlh_ht'=> 'required',
            'ht'=> 'required',
            'jmlh_bc'=> 'required',
            'bc'=> 'required',
            'jmlh_acr'=> 'required',
            'acr'=> 'required',
            'jmlh_tt'=> 'required',
            'tt'=> 'required',
            'jmlh_ts'=> 'required',
            'ts'=> 'required',
            'jmlh_ar'=> 'required',
            'ar'=> 'required',
            'jmlh_ws'=> 'required',
            'ws'=> 'required',
            'jmlh_am'=> 'required',
            'am'=> 'required',
            'jmlh_sl'=> 'required',
            'sl'=> 'required',
            'jmlh_apr'=> 'required',
            'apr'=> 'required',
            'jmlh_ac'=> 'required',
            'ac'=> 'required',
            'jmlh_bapr'=> 'required',
            'bapr'=> 'required',
            'jmlh_jh'=> 'required',
            'jh'=> 'required',
            'jmlh_lm'=> 'required',
            'lm'=> 'required',
            'jmlh_cctv'=> 'required',
            'cctv'=> 'required',
            'jmlh_lla'=> 'required',
            'lla'=> 'required',
            'jmlh_rmax'=> 'required',
            'rmax'=> 'required',
            'jmlh_r2'=> 'required',
            'r2'=> 'required',
            'jmlh_mg'=> 'required',
            'mg'=> 'required',
            'jmlh_acu'=> 'required',
            'acu'=> 'required',
            'jmlh_rsp'=> 'required',
            'rsp'=> 'required',
            'jmlh_pg'=> 'required',
            'pg'=> 'required',
            'jmlh_sb'=> 'required',
            'sb'=> 'required',
            'jmlh_pyg'=> 'required',
            'pyg'=> 'required',
            'jmlh_dr'=> 'required',
            'dr'=> 'required',
            'jmlh_gn'=> 'required',
            'gn'=> 'required',
            'jmlh_sa'=> 'required',
            'sa'=> 'required',
            'jmlh_rc'=> 'required',
            'rc'=> 'required',
            'ket'=> 'required',
            
        ],);
         $customMessages = [
        'personil.required' => 'Personil harus diisi',
        'jmlh_ht.required' => 'Jumlah hand talkie harus diisi',
        'ht.required' => 'Hand talkie harus diisi',
        'jmlh_bc.required' => 'Jumlah batok charger harus diisi',
        'bc.required' => 'Batok charger harus diisi',
        'jmlh_acr.required' => 'Jumlah adaptor charger harus diisi',
        'acr.required' => 'Adaptor charger harus diisi',
        'jmlh_tt.required' => 'Jumlah tongkat t harus diisi',
        'tt.required' => 'Tongkat t harus diisi',
        'jmlh_ts.required' => 'Jumlah tali sling harus diisi',
        'ts.required' => 'Tali sling harus diisi',
        'jmlh_ar.required' => 'Jumlah amplifier harus diisi',
        'ar.required' => 'Amplifier harus diisi',
        'jmlh_ws.required' => 'Jumlah wireless harus diisi',
        'ws.required' => 'Wireless harus diisi',
        'jmlh_am.required' => 'Jumlah alarm harus diisi',
        'am.required' => 'Alarm harus diisi',
        'jmlh_sl.required' => 'Jumlah senter lalin harus diisi',
        'sl.required' => 'Senter lalin harus diisi',
        'jmlh_apr.required' => 'Jumlah apar harus diisi',
        'apr.required' => 'Apar harus diisi',
        'jmlh_bapr.required' => 'Jumlah box apar harus diisi',
        'bapr.required' => 'Box apar harus diisi',
        'jmlh_ac.required' => 'Jumlah ac harus diisi',
        'ac.required' => 'Ac harus diisi',
        'jmlh_jh.required' => 'Jumlah jas hujan harus diisi',
        'jh.required' => 'Jas hujan harus diisi',
        'jmlh_lm.required' => 'Jumlah layar monitor harus diisi',
        'lm.required' => 'Layar monitor harus diisi',
        'jmlh_cctv.required' => 'Jumlah cctv harus diisi',
        'cctv.required' => 'Cctv harus diisi',
        'jmlh_lla.required' => 'Jumlah lla harus diisi',
        'lla.required' => 'Lla harus diisi',
        'jmlh_rmax.required' => 'Jumlah R.Max(4,1 M) harus diisi',
        'rmax.required' => 'R.Max(4,1 M) harus diisi',
        'jmlh_r2.required' => 'Jumlah r.2,1 M harus diisi',
        'r2.required' => 'R.2,1 M harus diisi',
        'jmlh_mg.required' => 'Jumlah mesin genset harus diisi',
        'mg.required' => 'Mesin genset harus diisi',
        'jmlh_acu.required' => 'Jumlah accu harus diisi',
        'acu.required' => 'Accu harus diisi',
        'jmlh_rsp.required' => 'Jumlah r.stop harus diisi',
        'rsp.required' => 'R.stop harus diisi',
        'jmlh_pg.required' => 'Jumlah r.palang harus diisi',
        'pg.required' => 'R.palang harus diisi',
        'jmlh_sb.required' => 'Jumlah sepatu boat harus diisi',
        'sb.required' => 'Sepatu boat harus diisi',
        'jmlh_pyg.required' => 'Jumlah payung harus diisi',
        'pyg.required' => 'Payung harus diisi',
        'jmlh_dr.required' => 'Jumlah dispenser harus diisi',
        'dr.required' => 'Dispenser harus diisi',
        'jmlh_gn.required' => 'Jumlah galon harus diisi',
        'gn.required' => 'Galon harus diisi',
        'jmlh_sa.required' => 'Jumlah speaker active harus diisi',
        'sa.required' => 'Speaker active harus diisi',
        'jmlh_rc.required' => 'Jumlah rubber cone harus diisi',
        'rc.required' => 'Rubber cone harus diisi',
        'ket.required' => 'Keterangan harus diisi',
        
    ];

    $validator->setCustomMessages($customMessages);

    if ($validator->fails()) {
        return redirect()->back()->withInput()->withErrors($validator);
    }
       
       
        $data = HandoverTolInventoryLog::find($id);
        $data->personil = $request->personil;
        $data->shift = $request->shift;
        $data->lokasi_aset = $request->lokasi;
        $data->jumlah_handy_talkie = (int)$request->jmlh_ht;
        $data->handy_talkie = $request->ht;
        $data->jumlah_batok_charger = (int)$request->jmlh_bc;
        $data->batok_charger = $request->bc;
        $data->jumlah_adapter_charger = (int)$request->jmlh_acr;
        $data->adapter_charger = $request->acr;
        $data->jumlah_tongkat_t = (int)$request->jmlh_tt;
        $data->tongkat_t = $request->tt;
        $data->jumlah_tali_sling= (int)$request->jmlh_ts;
        $data->tali_sling= $request->ts;
        $data->jumlah_amplifier = (int)$request->jmlh_ar;
        $data->amplifier = $request->ar;
        $data->jumlah_wireless = (int)$request->jmlh_ws;
        $data->wireless = $request->ws;
        $data->jumlah_alarm = (int)$request->jmlh_am;
        $data->alarm = $request->am;
        $data->jumlah_senter_lalin = (int)$request->jmlh_sl;
        $data->senter_lalin = $request->sl;
        $data->jumlah_apar = (int)$request->jmlh_apr;
        $data->apar = $request->apr;
        $data->jumlah_box_apar = (int)$request->jmlh_bapr;
        $data->box_apar = $request->bapr;
        $data->jumlah_ac = (int)$request->jmlh_ac;
        $data->ac = $request->ac;
        $data->jumlah_jas_hujan = (int)$request->jmlh_jh;
        $data->jas_hujan = $request->jh;
        $data->jumlah_layar_monitor = (int)$request->jmlh_lm;
        $data->layar_monitor = $request->lm;
        $data->jumlah_cctv = (int)$request->jmlh_cctv;
        $data->cctv = $request->cctv;
        $data->jumlah_lla = (int)$request->jmlh_lla;
        $data->lla = $request->lla;
        $data->jumlah_r_max = (int)$request->jmlh_rmax;
        $data->r_max = $request->rmax;
        $data->jumlah_r_21 = (int)$request->jmlh_r2;
        $data->r_21 = $request->r2;
        $data->jumlah_mesin_genset = (int)$request->jmlh_mg;
        $data->mesin_genset = $request->mg;
        $data->jumlah_accu = (int)$request->jmlh_acu;
        $data->accu = $request->acu;
        $data->jumlah_r_stop = (int)$request->jmlh_rsp;
        $data->r_stop = $request->rsp;
        $data->jumlah_r_palang = (int)$request->jmlh_pg;
        $data->r_palang = $request->pg;
        $data->jumlah_sepatu_boat = (int)$request->jmlh_sb;
        $data->sepatu_boat = $request->sb;
        $data->jumlah_payung = (int)$request->jmlh_pyg;
        $data->payung = $request->pyg;
        $data->jumlah_dispenser = (int)$request->jmlh_dr;
        $data->dispenser = $request->dr;
        $data->jumlah_galon = (int)$request->jmlh_gn;
        $data->galon = $request->gn;
        $data->jumlah_speaker_active = (int)$request->jmlh_sa;
        $data->speaker_active = $request->sa;
        $data->jumlah_rubber_cone = (int)$request->jmlh_rc;
        $data->rubber_cone = $request->rc;
        $data->keterangan = $request->ket;
        $data->save();
        
        
        if(Auth::user()->operasional_id==10 ){
            Session::flash('message', Lang::get('Data Berhasil Diedit'));
            return redirect()->route('admin.lapenam.ceklis');
        }
        elseif(Auth::user()->operasional_id==7 || Auth::user()->operasional_id==8 || Auth::user()->operasional_id==9){
            Session::flash('message', Lang::get('Data Berhasil Diedit'));
            return redirect()->route('koordinator.lapenam.ceklis');
        }
        Session::flash('message', Lang::get('Data Berhasil Diedit'));
        return redirect()->route('lapenam.ceklis');
    }
    public function export($id)
    {
        try {
            $cek = HandoverTolInventoryLog::where('id',$id)
            ->first();
            // dd($cek);
           
        if ($cek) {
            $date = $cek->created_at;
            //  dd(Auth::user()->operasional_id);
        }
            if(Auth::user()->operasional_id==10){
              $data = HandoverTolInventoryLog::where('unit',$cek->unit)->whereBetween('shift', [1, 3])
             ->get()
            ->toArray();
            // dd($data);
            }
            else{
                $data = HandoverTolInventoryLog::where('unit',$cek->unit)->whereBetween('shift', [1, 3])
                ->whereDate('created_at', $date)
                ->get()
                ->toArray();
                
            }

               
        } catch (\Exception $errors) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['message' => Lang::get('Data Not Found')]);
        }
        $pdf = Pdf::loadView('pdf.serah-terima-inventaris', compact('data'));

        return $pdf->stream('Laporan Serah Terima Inventaris' . '.pdf');
    }
}
