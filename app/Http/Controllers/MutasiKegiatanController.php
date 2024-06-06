<?php

namespace App\Http\Controllers;

use App\Exports\AktivitasEksport;
use App\Models\ActivityMutationServiceTol;
use App\Models\MonitoringLocation;
use App\Models\MonitoringTime;
use App\Models\Officer;
use App\Models\User;
use Lang, Validator, Session,Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\OutputMutation;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Output\Output;


class MutasiKegiatanController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan tanggal saat ini
        $currentDate = date('Y-m-d');
        $yesterdayDate = date('Y-m-d', strtotime('-1 day'));
        $user = Auth::user()->nama;
        $time = Carbon::now();
        $hour = $time->hour;
        $minute = $time->minute;
        // 
        // dd($s1);
        
        // dd($currentDate);
        if (($hour == 6 && $minute >= 45) || ($hour > 6 && $hour < 14) || ($hour == 14 && $minute <= 30)){
            $shift = 1;
            
        }
        if (($hour == 14 && $minute >= 31) || ($hour > 14 && $hour < 22) || ($hour == 22 && $minute <= 30)){
            $shift =2;

        }
        if (($hour == 22 && $minute >= 31) || ($hour > 22 && $hour < 24) || ($hour < 6) || ($hour == 6 && $minute <= 45)) {
            $shift = 3;
        }        
        $today = $time->toDateString();
        $yesterday = $time->subDay()->toDateString();
        $endTimeYesterday = Carbon::parse('06:45:00')->format('H:i:s');
        $startTime = Carbon::parse('06:45:00')->format('H:i:s');
        if (($hour == 0 && $minute >= 0) || ($hour < 6) || ($hour == 6 && $minute <= 45)) {
            $datas = OutputMutation::where('no_mutation', 'LIKE', Auth::user()->nama.'-%')
            ->where(function ($query) use ($today, $yesterday, $startTime, $endTimeYesterday, $time) {
                $query->where(function ($q) use ($yesterday, $endTimeYesterday, $time) {
                    $q->whereDate('created_at', $yesterday)
                      ->whereTime('created_at', '>=', $endTimeYesterday);
                })
                ->orWhere(function ($q) use ($today, $startTime, $time) {
                    $q->whereDate('created_at', $today)
                      ->whereTime('created_at', '<=', $startTime);
                });
            })
            ->get();
            
        }else{
            $datas = OutputMutation::where('no_mutation', 'LIKE', $user.'-%')
            ->whereDate('created_at', 
                $currentDate )
            ->get();
            
        }
       
        // dd($datas);
        
        return view('pages.mutasi-kegiatan.index')->with('datas', $datas);
    }
    public function detail($no_mutation)
    {
        // $out = OutputMutation::where('id',$id)->first();
        $datas = ActivityMutationServiceTol::where('no_mutasi', $no_mutation)->orderBy('id','ASC')->get();
        return view('pages.mutasi-kegiatan.detail')->with('datas', $datas);
    }
    public function create(Request $request)
    {
         $time = Carbon::now();
       

         $today = $time->toDateString();
         $yesterday = $time->subDay()->toDateString();
         $tomorrow = $time->addDay(2)->toDateString();
         $hour = $time->hour;
         $minute = $time->minute;
         $startTime = Carbon::parse('06:45:00')->format('H:i:s');
         $startTimeLate = Carbon::parse('06:45:00')->format('H:i:s');
         $endTimeToday = Carbon::parse('23:59:59')->format('H:i:s');
         $endTimeTomorrow = Carbon::parse('06:45:00')->format('H:i:s');
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
        // dd($jumlah_mutasi);
      

          
        
        $personil1 = $request->session()->get('personil1');
        $personil2 = $request->session()->get('personil2');
        $personilAmbulan = $request->session()->get('personil');
        $personilSecurity = $request->session()->get('personilSecurity');
        $personilSenkom = $request->session()->get('personilSenkom');
        $personilTis = $request->session()->get('personilTis');
        $personilDerek = $request->session()->get('personilDerek');
        $personilRescue = $request->session()->get('personilRescue');

        $p1= Officer::where('id', $personil1)->first();
        $p2= Officer::where('id', $personil2)->first();
        $pa= Officer::where('id', $personilAmbulan)->first();
        $ps= Officer::where('id', $personilSecurity)->first();
        $psm= Officer::where('id', $personilSenkom)->first();
        $ptis= Officer::where('id', $personilTis)->first();
        $pdk= Officer::where('id', $personilDerek)->first();
        $prs= Officer::where('id', $personilRescue)->first();
        $waktu_pemantauan = ActivityMutationServiceTol::all();
        // $cekwaktu_pemantauan = ActivityMutationServiceTol::where('personil1',$personil1)->where('personil2',$personil2)->;
        $mutasi = OutputMutation::all();
      
        $no_mutasi= $request->session()->get('no_mutation');
        //   $no = ActivityMutationServiceTol::where('waktu_pemantauan',1)->where('no_mutasi', 'LIKE', Auth::user()->nama.'%')->orderBy('created_at', 'DESC')->first();
        // $no_mutasi = $no->no_mutasi;
        // dd( $no);
        // $no= $mutasi + 1;
        // $no_mutasi= Auth::user()->nama.'-'.sprintf($no);
        // dd(Auth::user()->nama);
     
        // dd($waktu_pemantauan);
        if($waktu_pemantauan->count()==0){
             $times = MonitoringTime::where('shift',$shift)->get();
        }
        else{  
            $time = Carbon::now();
            foreach ($waktu_pemantauan as $key => $waktu_pemantauan) {
                # code...
          
            $times = MonitoringTime::where('shift',$shift)->whereNotIn('id', function ($query) use ($waktu_pemantauan , $no_mutasi,) {
            $query->select('waktu_pemantauan')
                ->from('activity_mutation_service_tol')
                ->where(function($q) use ($waktu_pemantauan, $no_mutasi){
                    $q->where('no_mutasi',$no_mutasi)
                    ->where('waktu_pemantauan', '!=', $waktu_pemantauan);
                      
                });
        //     ->orWhereIn('id', function ($query) use($no_mutasi){
        // $query->select('waktu_pemantauan')
        //         ->from('activity_mutation_service_tol')
        //         ->where('no_mutasi',$no_mutasi);
            

            // dd($no_mutasi);
            
           }   )
        ->get();
    }
        }
        
   
        
        $locations = MonitoringLocation::all();
        // dd($times);
       
        return view("pages.mutasi-kegiatan.create")->with(compact('prs','p1', 'p2','pa','ps', 'psm','ptis','pdk','times', 'locations'));

    
    }
    public function store(Request $request)
    {
         $validator =  [
           
            
            'lokasi_pemantauan'=> 'required',
            'waktu_pemantauan'=> 'required',
            'keterangan' => 'required',
         ];
       
        $customMessages = [
            'lokasi_pemantauan.required' => 'Lokasi pemantauan wajib diisi',
            'waktu_pemantauan.required' => 'Waktu pemantauan wajib diisi',
            'keterangan.required' => 'Keterangan wajib diisi', 
         
            ];
        $validator = Validator::make($request->all(), $validator, $customMessages);


        if ($validator->fails()) {
        
        return redirect()->back()->withErrors($validator)->withInput();
     }
        $personil1 = $request->session()->get('personil1');
        $personil2 = $request->session()->get('personil2');
        $waktu_pantau = ActivityMutationServiceTol::where('waktu_pemantauan',1)->where('no_mutasi', 'LIKE', Auth::user()->nama.'%')->orderBy('created_at', 'DESC')->first();
        $personilAmbulan = $request->session()->get('personil');
        $personilSecurity = $request->session()->get('personilSecurity');
        $personilRescue = $request->session()->get('personilRescue');
        $personilSenkom = $request->session()->get('personilSenkom');
        $personilTis = $request->session()->get('personilTis');
        $personilDerek = $request->session()->get('personilDerek');
        // dd($waktu_pantau);
        $time = Carbon::now();
        $hour = $time->hour;
        $minute = $time->minute;
        $no_mutasi = OutputMutation::where('no_mutation', 'LIKE', '%'.Auth::user()->nama.'%')->count();
        // dd($no_mutasi);
        // $request->session()->put('no_mutasi', $no_mutasi);
        // dd($time->toDateString());
        if($no_mutasi==0){
            $no = $request->session()->get('no_mutasi');
            $no_mutasi= Auth::user()->nama.'-'.sprintf($no+1);
            $request->session()->put('no_muta', $no+1);
        }
        
        else{
            // $unit = User::where('id',$waktu_pantau->unit)->first();
          if (($hour == 6 && $minute >= 45) || ($hour > 6) && ( $time->toDateString() != $waktu_pantau->created_at->toDateString())) {
                // $no= $request->session()->get('no_mutasi');
                $non= OutputMutation::where('no_mutation', 'LIKE', '%'.Auth::user()->nama.'%')->count();
                $no_mutasi= Auth::user()->nama.'-'.sprintf($non+1);
                // dd($non);
                // $request->session()->put('no_muta', $non++);
                 $request->session()->put('no_mutation', $no_mutasi);
                
               
            }else{
                //   $no= $request->session()->get('no_mutasi');
                //   dd($no);
                  $no_muta = OutputMutation::where('no_mutation',  'LIKE', '%'.Auth::user()->nama.'%')->count();
                //   dd($no_muta);
                  $no_mutasi = Auth::user()->nama.'-'.sprintf($no_muta);
                  $request->session()->put('no_muta',  $no_muta);
                   $request->session()->put('no_mutation', $no_mutasi);
                 
                }    
            //  dd($no_mutasi);   
        }
        
        $data = new ActivityMutationServiceTol;
        if($personil1!=null && $personil2!=null){
            $data->personil1 =  $personil1;
            $data->personil2 =  $personil2;
        }
        else if($personilAmbulan!=null){
            $data->personil1 =  $personilAmbulan;
            $data->personil2 =  $personilAmbulan;
        }
        else if($personilSecurity!=null){
            $data->personil1 =  $personilSecurity;
            $data->personil2 =  $personilSecurity;
        }
        else if($personilRescue!=null){
            $data->personil1 =  $personilRescue;
            $data->personil2 =  $personilRescue;
        }
        else if($personilSenkom!=null&&$personilTis!=null){
            $data->personil1 =  $personilSenkom;
            $data->personil2 =  $personilTis;
        }
        else if($personilDerek!=null){
            $data->personil1 =  $personilDerek;
            $data->personil2 =  $personilDerek;
        }
       
        $data->unit = Auth::user()->operasional_id;
        $data->waktu_pemantauan =  $request->waktu_pemantauan;
        $data->lokasi_pemantauan =  $request->lokasi_pemantauan;
        $data->keterangan =  $request->keterangan;
        $data->no_mutasi = $no_mutasi ;
        // dd($data);
        $request->session()->put('tanggal',$data->created_at);
         $data->save();
        $output = OutputMutation::where('no_mutation',$no_mutasi)->first();
        if($output==null){
            $datas= new OutputMutation;
            $datas->no_mutation=$no_mutasi;
            // dd($datas);
            $datas->save();
        }
        
        Session::flash('message', Lang::get('Data Berhasil Masuk'));
        return redirect()->route('mutasi-kegiatan.index');
        
    }
     public function export($id)
    {
        try{
            $data = OutputMutation::where('id', $id)
            ->first()
            ->toArray();
            // dd($data);
        } catch(\Exception $errors) {
            return redirect()->back()
            ->withInput()->withErrors(['message' => Lang::get('web.data-not-found')]);
        }
        
            // dd($data['no_mutasi']);
        $pdf = Pdf::loadView('pdf.mutasi-kegiatan', $data);

        return $pdf->stream('Mutasi Kegiatan Harian' . '.pdf');
    }
    public function editMutasi($id)
    {
        try{
            $data = ActivityMutationServiceTol::where('id', $id)
            ->firstOrFail();
            $time = Carbon::now();
            $hour = $time->hour;
            $minute = $time->minute;
           
            if($hour==6 && $minute >= 31 || $hour>6 && $hour<15 || $hour ==14 && $minute==30){
                $shift = 1;
            }
            if($hour==14 && $minute >= 31 || $hour>14 && $hour<23 || $hour ==22 && $minute==30){
                $shift=2;
            }
            if($hour==22 && $minute >= 31 || $hour>22 && $hour<24|| $hour<7 || $hour ==6 && $minute==30){
                $shift=3;
            }
            
            $p1= Officer::where('id', $data->personil1)->first();
            $p2= Officer::where('id', $data->personil2)->first();
            // $pa = Officer::where('id', $personilAmbulan)->first();
            $waktu_pemantauan = ActivityMutationServiceTol::all();
            $mutasi = OutputMutation::all();
            $no_mutasi= $data->no_mutasi;
            $times = MonitoringTime::where('id',$data->waktu_pemantauan)->first();
            // dd($data->waktu_pemantauan);
            $locations = MonitoringLocation::all();
        } catch(\Exception $errors) {
            return redirect()->back()
            ->withInput()->withErrors(['message' => Lang::get('web.data-not-found')]);
        }
        // dd($data);
        return view('pages.mutasi-kegiatan.edit')->with(compact('p1', 'p2','times', 'locations', 'data'));
    }
    public function updateMutasi(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // 'keterangan' => 'required',
            'waktu_pemantauan'=> 'required',
            'lokasi_pemantauan'=> 'required'
        ],);
       
         if($validator->fails())
        {
            $validator->errors()->add('message', Lang::get('gagal'));
            return redirect()->back()->withInput()->withErrors($validator);
        }
        try{
            $data = ActivityMutationServiceTol::find($id);
        } catch(\Exception $errors) {
            return redirect()->back()
            ->withInput()->withErrors(['message' => Lang::get('Gagal Update')]);
        }
        // dd($request->keterangan);
        $data->waktu_pemantauan =  $request->waktu_pemantauan;
        $data->lokasi_pemantauan =  $request->lokasi_pemantauan;
        $data->keterangan =  $request->keterangan;
        $data->save();
        Session::flash('message', Lang::get('Data Berhasil Diedit'));
        return redirect()->route('mutasi.detail',$data->no_mutasi);
    }
    public function deleteMutasi($id)
    {
    
        $data =  ActivityMutationServiceTol::where('id', $id)->first();
        $dataMutasi = $data->no_mutasi;
        ActivityMutationServiceTol::where('id', $id)->delete();
        
        Session::flash('message', Lang::get('Data Berhasil Dihapus'));
        return redirect()->route('mutasi.detail',$dataMutasi);
    }

    public function export()
    {
        return Excel::download(new AktivitasEksport,'Aktivitas.xlsx');
    }
}
