<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ActivityMutationServiceTol;
use App\Models\CategoryAccident;
use App\Models\CauseAccident;
use App\Models\ImageTrafficAccident;
use App\Models\Interference;
use App\Models\Lane;
use App\Models\LossAccident;
use App\Models\MonitoringTime;
use App\Models\Officer;
use App\Models\TrafficAccidentVictim;
use App\Models\OutputMutation;
use App\Models\Section;
use App\Models\SourceInformation;
use App\Models\Stationing;
use App\Models\Track;
use App\Models\TrafficAccidentReport;
use App\Models\TrafficAccidentReportVehicleClass;
use App\Models\TypeAccident;
use App\Models\VehicleClass;
use App\Models\VehicleType;
use App\Models\VictimCondition;
use App\Models\Weather;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Lang,Session, Image, Auth;

class PelayananKecelakaanLaluLintasController
{
public function  index(){
     $datas = TrafficAccidentReport::get();
     return view('pages.pelayanan-kecelakaan-lalu-lintas.index')->with('datas', $datas);
   
}


public function  next(Request $request){
    // $formData = $request->session()->get('gk');
    // dd($formData);
    $kondisi = VictimCondition::all();
    $stationing = Stationing::all();
    $section = Section::all();
    $track = Track::all();
    $lane = Lane::all();
    $weather = Weather::all();
    $information = SourceInformation::all();
    $interference = Interference::all();
    $classVehicle = VehicleClass::all();
    $typeVehicle = VehicleType::all();
    $typeAccident = TypeAccident::all();
    $causeAccident = CauseAccident::all();
    $categoryAccident = CategoryAccident::all();
    $lossAccident = LossAccident::all();
    $officer= Officer::all();
    $patroli= Officer::all();
    $pAmbulan = Officer::whereIn('operasional_id', [4, 8, 6])
    ->orderByRaw("FIELD(operasional_id, 4, 8, 6)")
    ->get();
    $pRescue= Officer::whereIn('operasional_id', [3, 8, 6])
    ->orderByRaw("FIELD(operasional_id, 3, 8, 6)")
    ->get();
    $pDerek= Officer::whereIn('operasional_id', [2,7,6])
    ->orderByRaw("FIELD(operasional_id, 2, 7, 6)")
    ->get();
    $pAnother= Officer::whereIn('operasional_id', [5, 11 ,7, 8, 9, 10,  6])
    ->orderByRaw("FIELD(operasional_id, 5, 11, 7, 8, 9, 10, 6)")
    ->get();
     return view('pages.pelayanan-kecelakaan-lalu-lintas.next')->with(compact('patroli','kondisi','section','track','lane','weather','information','interference','classVehicle','typeVehicle', 'officer', 'typeAccident', 'causeAccident', 'categoryAccident', 'lossAccident','pAmbulan','pRescue','pAnother','pDerek'));
}
public function  create(Request $request){
   
 
    $stationing = Stationing::all();
    $section = Section::all();
    $track = Track::all();
    $lane = Lane::all();
    $weather = Weather::all();
    $information = SourceInformation::all();
    $interference = Interference::all();
    $classVehicle = VehicleClass::all();
    $typeVehicle = VehicleType::all();
    $typeAccident = TypeAccident::all();
    $causeAccident = CauseAccident::all();
    $categoryAccident = CategoryAccident::all();
    $lossAccident = LossAccident::all();
    $officer= Officer::all();
    $pAmbulan = Officer::whereIn('operasional_id', [4, 8, 6])
    ->orderByRaw("FIELD(operasional_id, 4, 8, 6)")
    ->get();
    $pPatroli = Officer::where('operasional_id', 1)->get();
    $pRescue= Officer::whereIn('operasional_id', [3, 8, 6])
    ->orderByRaw("FIELD(operasional_id, 3, 8, 6)")
    ->get();
    $pDerek= Officer::whereIn('operasional_id', [2,7, 6])
    ->orderByRaw("FIELD(operasional_id, 2, 7, 6)")
    ->get();
    $pAnother= Officer::whereIn('operasional_id', [5, 11 ,7, 8, 9, 10,  6])
    ->orderByRaw("FIELD(operasional_id, 5, 11, 7, 8, 9, 10, 6)")
    ->get();
    $patroli= Officer::where('operasional_id', 1)
    ->get();
    return view('pages.pelayanan-kecelakaan-lalu-lintas.create')->with(compact('patroli','stationing','section','track','lane','weather','information','interference','classVehicle','typeVehicle', 'officer', 'typeAccident', 'causeAccident', 'categoryAccident', 'lossAccident','pAmbulan','pRescue','pAnother','pDerek', 'pPatroli'));
}
public function store(Request $request)
    {
        
        $no = TrafficAccidentReport::all()->count();
        $latestReport = TrafficAccidentReport::latest()->first();

        // dd($latestReport->id+1);
    //   dd($request->all()); 
        
            $validator = [
            'stasioning' => 'required',
            'seksi' => 'required',
            'jalur' => 'required',
            'lajur' => 'required',
            'cuaca' => 'required',
            'sumber_informasi' => 'required',
            'tgl_kejadian' => 'required',
            'wkm' => 'required',
            'wsm' => 'required',
            'wsim' => 'required',
            'jk' => 'required',
            'pk' => 'required',
            'kk' => 'required',
            'kek' => 'required',
            'petugasLain' => 'required',
            'petugasRescue' => 'required',
            'petugasAmbulan' => 'required',
            'inlineRadioOptions' => 'required',
            'personil1' => 'required',
            'personil2' => 'required',
            'keterangan' => 'required',
            // 'nnk' => 'required',
            'dokumentasi' => 'required|array|size:4',
            // 'gk[]' => 'required',
            // 'nnk[]' => 'required'

            ];
            $customMessages = [
            'stasioning.required' => 'Stationing wajib diisi', 
            'seksi.required' => 'Seksi wajib diisi',
            'jalur.required' => 'Jalur wajib diisi',
            'lajur.required' => 'Lajur wajib diisi',
            'cuaca.required' => 'Cuaca wajib diisi',
            'tgl_kejadian.required' => 'Tanggal kejadian wajib diisi',
            'sumber_informasi.required' => 'Sumber informasi wajib diisi',
            'wkm.required' => 'Waktu kejadian wajib diisi',
            'wsm.required' => 'Waktu sampai wajib diisi',
            'wsim.required' => 'Waktu selesai wajib diisi',
            'jk.required' => 'Jenis kecelakaan wajib diisi',
            'pk.required' => 'Penyebab kecelakaan wajib diisi',
            'kk.required' => 'Kategori kecelakaan wajib diisi',
            'kek.required' => 'Kerugian kecelakaan wajib diisi',
            'petugasLain.required' => 'Petugas lain wajib diisi',
            'petugasRescue.required' => 'Petugas rescue wajib diisi',
            'petugasAmbulan.required' => 'Petugas ambulan wajib diisi',
            'inlineRadioOptions.required' => 'Penderekan wajib diisi',
            'personil1.required' => 'Petugas patroli 1 wajib diisi',
            'personil2.required' => 'Petugas patroli 2 wajib diisi',
            'keterangan.required' => 'Keterangan wajib diisi',
            // 'nnk.required' => 'Nopol nomor kendaraan wajib diisi',
            'dokumentasi.required' => 'Dokumentasi wajib diisi',
            'dokumentasi.min' => 'Dokumentasi minimal harus terdiri dari 4 gambar.',
            // 'gk[].required' =>'Golongan kendaraan wajib diisi',
            // 'nnk[].required' => 'Nopol nomor kendaraan wajib diisi'
            ];
       
        $validator = Validator::make($request->all(), $validator, $customMessages);

    
    if ($validator->fails()) {
        
        return redirect()->back()->withErrors($validator)->withInput();
    }
    // dd($request->has('action') && $request->input('action') === 'next'); 
        //upload Gambar
        
        if ($request->has('action') && $request->input('action') === 'next') {
        // Tombol "Next" diklik, lakukan validasi sesuai kebutuhan
        // Misalnya, validasi untuk field input
        $validator = [
            'stasioning' => 'required',
            'seksi' => 'required',
            'jalur' => 'required',
            'lajur' => 'required',
            'cuaca' => 'required',
            'sumber_informasi' => 'required',
            'tgl_kejadian' => 'required',
            'wkm' => 'required',
            'wsm' => 'required',
            'wsim' => 'required',
            'jk' => 'required',
            'pk' => 'required',
            'kk' => 'required',
            'kek' => 'required',
            'petugasLain' => 'required',
            'petugasRescue' => 'required',
            'petugasAmbulan' => 'required',
            'inlineRadioOptions' => 'required',
            'personil1' => 'required',
            'personil2' => 'required',
            'keterangan' => 'required',
            'nnk' => 'required',
             'dokumentasi' => 'required|array|min:4',
            // 'gk[]' => 'required',
            // 'nnk[]' => 'required'

            ];
            $customMessages = [
            'stasioning.required' => 'Stationing wajib diisi', 
            'seksi.required' => 'Seksi wajib diisi',
            'jalur.required' => 'Jalur wajib diisi',
            'lajur.required' => 'Lajur wajib diisi',
            'cuaca.required' => 'Cuaca wajib diisi',
            'tgl_kejadian.required' => 'Tanggal kejadian wajib diisi',
            'sumber_informasi.required' => 'Sumber informasi wajib diisi',
            'wkm.required' => 'Waktu kejadian wajib diisi',
            'wsm.required' => 'Waktu sampai wajib diisi',
            'wsim.required' => 'Waktu selesai wajib diisi',
            'jk.required' => 'Jenis kecelakaan wajib diisi',
            'pk.required' => 'Penyebab kecelakaan wajib diisi',
            'kk.required' => 'Kategori kecelakaan wajib diisi',
            'kek.required' => 'Kerugian kecelakaan wajib diisi',
            'petugasLain.required' => 'Petugas lain wajib diisi',
            'petugasRescue.required' => 'Petugas rescue wajib diisi',
            'petugasAmbulan.required' => 'Petugas ambulan wajib diisi',
            'inlineRadioOptions.required' => 'Penderekan wajib diisi',
            'personil1.required' => 'Petugas patroli 1 wajib diisi',
            'personil2.required' => 'Petugas patroli 2 wajib diisi',
            'keterangan.required' => 'Keterangan wajib diisi',
            'nnk.required' => 'Nopol nomor kendaraan wajib diisi',
            'dokumentasi.required' => 'Dokumentasi wajib diisi',
            'dokumentasi.min' => 'Dokumentasi minimal harus terdiri dari 4 gambar.',
            // 'gk[].required' =>'Golongan kendaraan wajib diisi',
            // 'nnk[].required' => 'Nopol nomor kendaraan wajib diisi'
            ];
       
        $validator = Validator::make($request->all(), $validator, $customMessages);


    if ($validator->fails()) {
        
        return redirect()->back()->withErrors($validator)->withInput();
    }
        $waktuKejadian = strtotime($request->session()->get('tgl_kejadian') . ' ' . $request->session()->get('wkm')); // Mengubah ke format timestamp
        $waktuSampai = strtotime($request->session()->get('tgl_kejadian') . ' ' .$request->session()->get('wsm')); // Mengubah ke format timestamp
        $responTime = $waktuSampai - $waktuKejadian;
        // Mengonversi respon time ke dalam format jam:menit:detik
        $responTimeFormatted = gmdate('H:i', $responTime);
        $request->session()->put('stasioning', $request->stasioning);
        $request->session()->put('seksi', $request->seksi);
        $request->session()->put('jalur', $request->jalur);
        $request->session()->put('lajur', $request->lajur);
        $request->session()->put('cuaca', $request->cuaca);
        $request->session()->put('sumber_informasi', $request->sumber_informasi);
        $request->session()->put('tgl_kejadian', $request->tgl_kejadian);
        $request->session()->put('wkm', $request->wkm);
        $request->session()->put('wsm', $request->wsm);
        $request->session()->put('wsim', $request->wsim);
        $request->session()->put('jk', $request->jk);
        $request->session()->put('pk', $request->pk);
        $request->session()->put('kk', $request->kk);
        $request->session()->put('kek', $request->kek);
        $request->session()->put('kat', $request->kat);
        $request->session()->put('asal', $request->asal);
        $request->session()->put('tujuan', $request->tujuan);
        $request->session()->put('petugasLain', $request->petugasLain);
        $request->session()->put('petugasRescue', $request->petugasRescue);
        $request->session()->put('petugasAmbulan', $request->petugasAmbulan);
        $request->session()->put('personil1', $request->personil1);
        $request->session()->put('personil2', $request->personil2);
        $request->session()->put('keterangan', $request->keterangan);
        $request->session()->put('rtp', $request->rtp);
        $request->session()->put('dp', $request->dp);
        $request->session()->put('derek', $request->derek);
        $request->session()->put('inlineRadioOptions', $request->inlineRadioOptions);
        $request->session()->put('petugasDerek', $request->petugasDerek);
        $request->session()->put('widdkc', $request->widdkc);
        $request->session()->put('wdslkc', $request->wdslkc);
        $request->session()->put('rtdkc', $request->rtdkc);
        $request->session()->put('nnk', $request->nnk);
        $request->session()->put('gk', $request->gk);
        
        $file = $request->file('dokumentasi');
        $no_gambar =1;
        foreach($file as $file){
            $tujuan_upload = 'LKLL';
            $file->move($tujuan_upload,'LKLL-Nomor Report-'.sprintf($latestReport->id+1).'-'.$no_gambar.'.'.$file->getClientOriginalExtension());
            $imageAccident = 'LKLL-Nomor Report-'.sprintf($latestReport->id+1).'-'.$no_gambar.'.'.$file->getClientOriginalExtension();
            $images[]= $imageAccident;
            $no_gambar++;
        }
        $request->session()->put('gambar', $images);
        // dd($request->action);
         return redirect()->route('pelayanan-kecelakaan-lalu-lintas.next');
    }
    // dd($request->has('action') && $request->input('action') === 'nextSubmit');
        
        // dd($request->session()->get('next'));
        $file = $request->file('dokumentasi');
        //respond time
        $waktuKejadian = strtotime($request->session()->get('tgl_kejadian') . ' ' . $request->session()->get('wkm')); // Mengubah ke format timestamp
        $waktuSampai = strtotime($request->session()->get('tgl_kejadian') . ' ' .$request->session()->get('wsm')); // Mengubah ke format timestamp
        $responTime = $waktuSampai - $waktuKejadian;
        // Mengonversi respon time ke dalam format jam:menit:detik
        $responTimeFormatted = gmdate('H:i', $responTime);

        
        $report = new TrafficAccidentReport;
        $report->stationing = $request->stasioning;
        $report->seksi = $request->seksi;
        $report->jalur = $request->jalur;
        $report->lajur = $request->lajur;
        $report->cuaca = $request->cuaca;
        $report->sumber_informasi = $request->sumber_informasi;
        $report->tanggal_kejadian = $request->tgl_kejadian;
        $report->waktu_kejadian = $request->wkm;
        $report->waktu_sampai = $request->wsm;
        $report->respon_time = $request->rtp;
        $report->waktu_selesai = $request->wsim;
        $report->durasi_penanganan = $request->dp;
        $report->jenis_kecelakaan = $request->jk;
        $report->penyebab_kecelakaan = $request->pk;
        $report->kategori_kecelakaan = $request->kk;
        $report->kerugian_kecelakaan = $request->kek;
        $report->kerugian_tol = $request->kat;
        $report->asal_perjalanan =  $request->asal;
        $report->tujuan_perjalanan =  $request->tujuan;
        $report->personil1 =$request->personil1;
        $report->personil2 =$request->personil2;
        $report->petugas_lainnya = $request->petugasLain ;
        $report->personil_rescue = $request->petugasRescue ;
        $report->personil_ambulan = $request->petugasAmbulan ;
        $report->penderekan = $request->inlineRadioOptions ?? '';
        $report->petugas_derek = $request->petugasDerek ??71;
        $report->unit_derek = $request->derek??'';
        $report->waktu_dibutuhkan = $request->widdkc??'';
        $report->waktu_sampai_tkp = $request->wdslkc??'';
        $report->respon_time_derek = $request->rtdkc??'';
        $senkom = $request->session()->get('personilSenkom');
        $report->senkom =  $senkom;
        $report->dokumentasi = '';
        
        $current_stationing = Stationing::where('id', $request->stasioning)->first();
        $current_jalur = Track::where('id', $request->jalur)->first();
        $current_seksi = Section::where('id', $request->seksi)->first();
        $report->auto_text = 'Menangani kecelakaan lalu lintas di ' .$current_stationing->nama.' jalur ' .$current_jalur->nama. ' ruas tol ' .$current_seksi->nama. ' pada pukul ' .$request->wkm;
        $report->waktu_info_medis_dibutuhkan = '';
    //    dd($report->auto_text);
        $report->waktu_tiba_medis = '';
        $report->respond_time_medis = '';
        $report->waktu_medis_meninggalkan_tkp = '';
        $report->durasi_penanganan_medis = '';
        $report->waktu_sampai_rs = '';
        $report->durasi_perjalanan = '';
        $report->keterangan = $request->keterangan;
        $no_gambar = 1;
        $report->save(); 
        $mutasi = MonitoringTime::all();
        foreach($mutasi as $mutasi){
            if($mutasi->start_time<=$request->wsm && $mutasi->end_time>=$request->wsm )
                {     
                    $cekwaktu = MonitoringTime::where('start_time', $mutasi->start_time)->where('end_time',$mutasi->end_time)->first();
                    // dd($cekwaktu, $mutasi->start_time, $request->wsi);
                    $time = Carbon::now();
                    $hour = $time->hour;
                    $minute = $time->minute;
                    if($hour>=0&&$hour<6 || $hour ==6 && $minute<=45) {
                        $startDate = now()->setTime(6, 45); // Today at 06:30 AM
                        $endDate = now()->subDay(1)->setTime(6, 45); // Tomorrow at 06:30 AM
                        $cekmutasi = ActivityMutationServiceTol::where('waktu_pemantauan', $cekwaktu->id)
                        ->where('no_mutasi', 'LIKE', Auth::user()->nama . '%')
                        ->whereBetween('created_at', [$endDate, $startDate])
                        ->orderBy('no_mutasi', 'DESC')
                        ->first();
                    }else{
                      
                        $startDate = now()->setTime(6, 45); // Today at 06:30 AM
                        $endDate = now()->addDay(1)->setTime(6, 45); // Tomorrow at 06:30 AM
                        $cekmutasi = ActivityMutationServiceTol::where('waktu_pemantauan', $cekwaktu->id)
                        ->where('no_mutasi', 'LIKE', Auth::user()->nama . '%')
                        ->whereBetween('created_at', [$startDate, $endDate])
                        ->orderBy('no_mutasi', 'DESC')
                        ->first();
                        // dd($endDate);
                    }
                // dd($cekmutasi);
                if($cekmutasi){
                    $cekmutasi->keterangan = $cekmutasi->keterangan."; ".$report->auto_text; 
                    $cekmutasi->save();
                }
                else{
                    //add no mutasi
                    $waktu_pantau = ActivityMutationServiceTol::where('waktu_pemantauan',1)->where('no_mutasi', 'LIKE', Auth::user()->nama.'%')->orderBy('no_mutasi', 'DESC')->first();
                    $time = Carbon::now();
                    $hour = $time->hour;
                    $minute = $time->minute;
                    $no_mutasi = OutputMutation::where('no_mutation', 'LIKE', '%'.Auth::user()->nama.'%')->count();
                    // dd($no_mutasi);
                    $request->session()->put('no_mutasi', $no_mutasi);
                    // dd($time->toDateString());
                  if($no_mutasi==0){
                        $no = $request->session()->get('no_muta');
                        $no_mutasi= Auth::user()->nama.'-'.sprintf($no+1);
                        $request->session()->put('no_muta', $no+1);
                    }
                    
                    else{
                        // $unit = User::where('id',$waktu_pantau->unit)->first();
                      if ($hour == 6 && $minute >= 45 || $hour > 6 && $time->toDateString() != $waktu_pantau->created_at->toDateString()) {
                            // $no= $request->session()->get('no_mutasi');
                            $non= OutputMutation::where('no_mutation', 'LIKE', '%'.Auth::user()->nama.'%')->count();
                            $no_mutasi= Auth::user()->nama.'-'.sprintf($non+1);
                            // dd($non);
                            $request->session()->put('no_muta', $non+1);
                             $request->session()->put('no_mutasi', $no_mutasi);
                            
                           
                        }else{
                            //   $no= $request->session()->get('no_mutasi');
                            //   dd($no);
                              $no_muta = OutputMutation::where('no_mutation',  'LIKE', '%'.Auth::user()->nama.'%')->count();
                            //   dd($no_muta);
                              $no_mutasi = Auth::user()->nama.'-'.sprintf($no_muta);
                              $request->session()->put('no_muta',  $no_muta);
                               $request->session()->put('no_mutasi', $no_mutasi);
                             
                            }    
                        //  dd($no_mutasi);   
                    }
                     $senkom = $request->session()->get('personilSenkom');
                     $tis = $request->session()->get('personilTis');
                  
                   
                    $addmutasi = new ActivityMutationServiceTol();
                    $addmutasi->unit = Auth::user()->operasional_id;
                    $addmutasi->personil1 =  $senkom;
                    $addmutasi->personil2 =  $tis;
                    $addmutasi->waktu_pemantauan =  $cekwaktu->id;
                    $addmutasi->keterangan = $report->auto_text;   
                    $addmutasi->no_mutasi = $no_mutasi ;
                    $addmutasi->lokasi_pemantauan = 10 ;
                    $addmutasi->save();
                    // dd($addmutasi);
                    $request->session()->put('tanggal',$addmutasi->created_at);
                    $output = OutputMutation::where('no_mutation',$no_mutasi)->first();
                    if($output==null){
                        $datas= new OutputMutation;
                        $datas->no_mutation=$no_mutasi;
                        // dd($datas);
                        $datas->save();
                    }
                    
                }
                
            }
        }
        // dd($file);
        
         foreach($file as $file){
                $tujuan_upload = 'LKLL';
                $file->move($tujuan_upload,'LKLL-Nomor Report-'.sprintf($report->id).'-'.$no_gambar.'.'.$file->getClientOriginalExtension());
                $imageAccident = new ImageTrafficAccident;
                $imageAccident->id_report = $report->id;
                $imageAccident->nama = 'LKLL-Nomor Report-'.sprintf($report->id).'-'.$no_gambar.'.'.$file->getClientOriginalExtension();
                $imageAccident->save();
                $no_gambar++;
            }
            // dd($imageAccident);
        //Detail kecelakaan
        $i=0;
        foreach($request->gk as $gk){
        $detailclass = new TrafficAccidentReportVehicleClass;
        $detailclass->report_id = $report->id;
        $detailclass->vehicle_class_id = $gk;
        $detailclass->nopol = $request->nnk[$i];
        
        // dd($detailclass);
        $detailclass->save(); 
        $i++;
        }
       
        Session::flash('message', Lang::get('Data Berhasil Masuk'));
        return redirect()->route('pelayanan-kecelakaan-lalu-lintas.index');
    }

    public function storeNext(Request $request)
    {
            
            $waktuKejadian = strtotime($request->tgl_kejadian . ' ' . $request->wk); // Mengubah ke format timestamp
            $waktuSampai = strtotime($request->tgl_kejadian . ' ' . $request->ws); // Mengubah ke format timestamp
            $responTime = $waktuSampai - $waktuKejadian;
            // Mengonversi respon time ke dalam format jam:menit:detik
            $responTimeFormatted = gmdate('H:i', $responTime);
    
            // Buat data baru dalam model TrafficAccidentReport
            $report = new TrafficAccidentReport;
            $report->stationing = $request->session()->get('stasioning');
            $report->seksi = $request->session()->get('seksi');
            $report->jalur = $request->session()->get('jalur');
            $report->lajur = $request->session()->get('lajur');
            $report->cuaca = $request->session()->get('cuaca');
            $report->sumber_informasi = $request->session()->get('sumber_informasi');
            $report->tanggal_kejadian = $request->session()->get('tgl_kejadian');
            $report->waktu_kejadian = $request->session()->get('wkm');
            $report->waktu_sampai =$request->session()->get('wsm');
            $report->respon_time = $request->session()->get('rtp');
            $report->waktu_selesai = $request->session()->get('wsim');
            $report->durasi_penanganan = $request->session()->get('dp');
            $report->jenis_kecelakaan = $request->session()->get('jk');
            $report->penyebab_kecelakaan = $request->session()->get('pk');
            $report->kategori_kecelakaan = $request->session()->get('kk');
            $report->kerugian_kecelakaan = $request->session()->get('kek');
            $report->kerugian_tol = $request->session()->get('kat');
            $report->asal_perjalanan =  $request->session()->get('asal');
            $report->tujuan_perjalanan =  $request->session()->get('tujuan');
            $report->personil1 =$request->session()->get('personilSenkom');
            $report->personil2 =$request->session()->get('personilTis');
            $report->petugas_lainnya =$request->session()->get('petugasLain');
            $report->personil_rescue = $request->session()->get('petugasRescue');
            $report->personil_ambulan = $request->session()->get('petugasAmbulan');
            $report->penderekan = $request->session()->get('inlineRadioOptions');
            $report->petugas_derek = $request->session()->get('petugasDerek')??71;
            $report->unit_derek = $request->session()->get('derek')??'';
            $report->waktu_dibutuhkan = $request->session()->get('widdkc')??'';
            $report->waktu_sampai_tkp = $request->session()->get('wdslkc')??'';
            $report->respon_time_derek = $request->session()->get('rtdkc')??'';
            $report->keterangan = $request->session()->get('keterangan');
            $report->dokumentasi = '';
            $current_stationing = Stationing::where('id', $request->session()->get('stasioning'))->first();
            $current_jalur = Track::where('id', $request->session()->get('jalur'))->first();
            $current_seksi = Section::where('id', $request->session()->get('seksi'))->first();
            $report->auto_text = 'Menangani kecelakaan lalu lintas di ' .$current_stationing->nama.' jalur ' .$current_jalur->nama. ' ruas tol ' .$current_seksi->nama. ' pada pukul ' .$request->session()->get('wkm');
            $report->waktu_info_medis_dibutuhkan = $request->widm;
            $report->waktu_tiba_medis = $request->wtmt;
            $report->respond_time_medis = $request->rtpm;
            $report->waktu_medis_meninggalkan_tkp = $request->wmmt;
            $report->durasi_penanganan_medis = $request->dpn;
            $report->waktu_sampai_rs = $request->wmrs;
            $report->durasi_perjalanan = $request->dpe;
            $senkom = $request->session()->get('personilSenkom');
            $report->senkom =  $senkom;
            // dd($report);
            $no_gambar = 1;
    
           
            $mutasi = MonitoringTime::all();
                foreach($mutasi as $mutasi){
                  
                    if($mutasi->start_time<=$request->session()->get('wsm') && $mutasi->end_time>=$request->session()->get('wsm') )
                        {     
                            $cekwaktu = MonitoringTime::where('start_time', $mutasi->start_time)->where('end_time',$mutasi->end_time)->first();
                            // dd($cekwaktu, $mutasi->start_time, $request->wsi);
                            $time = Carbon::now();
                            $hour = $time->hour;
                            $minute = $time->minute;
                            if($hour>=0&&$hour<6 || $hour ==6 && $minute<=30) {
                                $startDate = now()->setTime(6, 30); // Today at 06:30 AM
                                $endDate = now()->subDay(1)->setTime(6, 30); // Tomorrow at 06:30 AM
                                $cekmutasi = ActivityMutationServiceTol::where('waktu_pemantauan', $cekwaktu->id)
                                ->where('no_mutasi', 'LIKE', Auth::user()->nama . '%')
                                ->whereBetween('created_at', [$endDate, $startDate])
                                ->orderBy('no_mutasi', 'DESC')
                                ->first();
                            }else{
                              
                                $startDate = now()->setTime(6, 30); // Today at 06:30 AM
                                $endDate = now()->addDay(1)->setTime(6, 30); // Tomorrow at 06:30 AM
                                $cekmutasi = ActivityMutationServiceTol::where('waktu_pemantauan', $cekwaktu->id)
                                ->where('no_mutasi', 'LIKE', Auth::user()->nama . '%')
                                ->whereBetween('created_at', [$startDate, $endDate])
                                ->orderBy('no_mutasi', 'DESC')
                                ->first();
                                // dd($endDate);
                            }
                        if($cekmutasi){
                            $cekmutasi->keterangan = $cekmutasi->keterangan."; ".'Menangani kecelakaan lalu lintas di ' .$current_stationing->nama.' jalur ' .$current_jalur->nama. ' ruas tol ' .$current_seksi->nama. ' pada pukul ' .$request->session()->get('wkm');
                            $cekmutasi->save();
                        }
                        else{
                            //add no mutasi
                          $waktu_pantau = ActivityMutationServiceTol::where('waktu_pemantauan',1)->where('no_mutasi', 'LIKE', Auth::user()->nama.'%')->orderBy('no_mutasi', 'DESC')->first();
                            $time = Carbon::now();
                            $hour = $time->hour;
                            $minute = $time->minute;
                            $no_mutasi = OutputMutation::where('no_mutation', 'LIKE', '%'.Auth::user()->nama.'%')->count();
                            // dd($no_mutasi);
                            $request->session()->put('no_mutasi', $no_mutasi);
                            // dd($time->toDateString());
                            if($no_mutasi==0){
                                $no = $request->session()->get('no_mutasi');
                                $no_mutasi= Auth::user()->nama.'-'.sprintf($no+1);
                                $request->session()->put('no_mutasi', $no_mutasi);
                            }
                            
                            else{
                                // $unit = User::where('id',$waktu_pantau->unit)->first();
                                if(!is_null($waktu_pantau) && ($hour==6 && $minute >= 30 || $hour>6 && $time->toDateString()!=$waktu_pantau->created_at->toDateString())){
                                    $no= $request->session()->get('no_mutasi');
                                    $non= OutputMutation::where('no_mutation',  Auth::user()->nama.'-'.sprintf($no))->count();
                                    $no_mutasi= Auth::user()->nama.'-'.sprintf($non+1);
                                    // dd($non);
                                    $request->session()->put('no_mutasi', $no_mutasi);    
                                
                                }else{
                                    $no= $request->session()->get('no_mutasi');
                                    //   dd($no);
                                    //   $no_muta = OutputMutation::where('no_mutation',  'LIKE', '%'.Auth::user()->nama.'%')->count();
                                    //   dd($no_muta);
                                    $no_mutasi = Auth::user()->nama.'-'.sprintf($no);
                                    $request->session()->put('no_mutasi', $no_mutasi);
                                    
                                    } 
                                    
                            }
                            $senkom = $request->session()->get('personilSenkom');
                            $tis = $request->session()->get('personilTis');
                    
                            $addmutasi = new ActivityMutationServiceTol();
                            $addmutasi->unit = Auth::user()->operasional_id;
                            $addmutasi->personil1 =  $senkom;
                            $addmutasi->personil2 =  $tis;
                            $addmutasi->waktu_pemantauan =  $cekwaktu->id;
                            $addmutasi->keterangan = 'Menangani kecelakaan lalu lintas di ' .$current_stationing->nama.' jalur ' .$current_jalur->nama. ' ruas tol ' .$current_seksi->nama. ' pada pukul ' .$request->session()->get('wkm'); 
                            $addmutasi->no_mutasi = $no_mutasi ;
                            $addmutasi->lokasi_pemantauan = 10 ;
                            // dd($addmutasi);
                            $request->session()->put('tanggal',$addmutasi->created_at);
                            $output = OutputMutation::where('no_mutation',$no_mutasi)->first();
                            if($output==null){
                                $datas= new OutputMutation;
                                $datas->no_mutation=$no_mutasi;
                                // dd($datas);
                                $datas->save();
                            }
                            $addmutasi->save();
                        }
                         
                    }
                }
                    // $report->keterangan = $request->keterangan;
           $report->save();
            $file = $request->session()->get('gambar');
            foreach($file as $file){
                // $tujuan_upload = 'LKLL';
                // $file->move($tujuan_upload,'LKLL-Nomor Report-'.sprintf($no+1).'-'.$no_gambar.'.'.$file->getClientOriginalExtension());
                $imageAccident = new ImageTrafficAccident;
                $imageAccident->id_report = $report->id;
                $imageAccident->nama = $file;
                $imageAccident->save();
                $no_gambar++;
            }
            //Detail kecelakaan
            $i=0;
            $nnk =  $request->session()->get('nnk');
            foreach( $request->session()->get('gk') as $gk){
            $detailclass = new TrafficAccidentReportVehicleClass;
            $detailclass->report_id = $report->id;
            $detailclass->vehicle_class_id = $gk;
            $detailclass->nopol = $nnk[$i];
            
            // dd($detailclass);
            $detailclass->save(); 
            $i++;
            }
            $k=0;
            // dd($request->umur);
            foreach($request->korban as $korban){
                $dataKorban = new TrafficAccidentVictim;
                $dataKorban->report_id = $report->id;
                $dataKorban->nama = $korban;
                $dataKorban->umur = $request->umur[$k];
                $dataKorban->kondisi = $request->kondisi[$k];
                $dataKorban->tindakan = $request->tindakan[$k];
                $k++;
                $dataKorban->save();
                // dd($dataKorban);
            }
            Session::flash('message', Lang::get('Data Berhasil Masuk'));
            return redirect()->route('pelayanan-kecelakaan-lalu-lintas.index');
        

    }

    public function deletepkk($id)
    {
        // $data =  TrafficAccidentReport::where('id', $id)->first();
        ImageTrafficAccident::where('id_report',$id)->delete();
        TrafficAccidentVictim::where('report_id',$id)->delete();
        TrafficAccidentReportVehicleClass::where('report_id',$id)->delete();
        TrafficAccidentReport::where('id', $id)->delete();
        
        Session::flash('message', Lang::get('Data Berhasil Dihapus'));
        return redirect()->route('pelayanan-kecelakaan-lalu-lintas.index');
    }
          public function export($id)
    {
        try {
            $data = TrafficAccidentReport::with('detail')->with('image')->where('id', $id)
                ->first()
                ->toArray();
        } catch (\Exception $errors) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['message' => Lang::get('web.data-not-found')]);
        }

        // dd($data['image'][0]['nama']);
        $pdf = Pdf::loadView('pdf.pelayanan-kecelakaan', compact('data'));

        return $pdf->stream('Laporan Kecelakaan' . '.pdf');
    }
    public function editpkk($id){
        try {
            $datas = TrafficAccidentReport::with('detail')->with('image')->where('id', $id)->first();
            // dd($datas);
            // $p1= Officer::where('id', $datas->personil1)->first();
            // $p2= Officer::where('id', $datas->personil2)->first();
            $patroli = Officer::where('operasional_id', 1)->get();
            $stationing = Stationing::all();
            $section = Section::all();
            $track = Track::all();
            $lane = Lane::all();
            $weather = Weather::all();
            $information = SourceInformation::all();
            $interference = Interference::all();
            $classVehicle = VehicleClass::all();
            $typeVehicle = VehicleType::all();
            $typeAccident = TypeAccident::all();
            $causeAccident = CauseAccident::all();
            $categoryAccident = CategoryAccident::all();
            $lossAccident = LossAccident::all();
            $officer= Officer::all();
            $pAmbulan = Officer::whereIn('operasional_id', [4, 8, 6])
            ->orderByRaw("FIELD(operasional_id, 4, 8, 6)")
            ->get();
            $pRescue= Officer::whereIn('operasional_id', [3, 8, 6])
            ->orderByRaw("FIELD(operasional_id, 3, 8, 6)")
            ->get();
            $pDerek= Officer::whereIn('operasional_id', [2,7, 6])
            ->orderByRaw("FIELD(operasional_id, 2, 7, 6)")
            ->get();
            $pAnother= Officer::whereIn('operasional_id', [5, 11 ,7, 8, 9, 10,  6])
            ->orderByRaw("FIELD(operasional_id, 5, 11, 7, 8, 9, 10, 6)")
            ->get();
             $pPatroli = Officer::where('operasional_id', 1)->get();
            // dd($datas);
        } catch (\Throwable $th) {
            return redirect()->back()
            ->withInput()->withErrors(['message' => Lang::get('web.data-not-found')]);
        }
       
        return view('pages.pelayanan-kecelakaan-lalu-lintas.edit')->with(compact('datas','stationing','section','track','lane','weather','information','interference','classVehicle','typeVehicle', 'officer', 'typeAccident', 'causeAccident', 'categoryAccident', 'lossAccident','pAmbulan','pRescue','pAnother','pDerek', 'patroli'));
    }
    public function  editNext(Request $request, $id){
        $korban = TrafficAccidentVictim::where('report_id', $id)->get();
        $datas = TrafficAccidentReport::where('id', $id)->first();
        $kondisi = VictimCondition::all();
        $stationing = Stationing::all();
        $section = Section::all();
        $track = Track::all();
        $lane = Lane::all();
        $weather = Weather::all();
        $information = SourceInformation::all();
        $interference = Interference::all();
        $classVehicle = VehicleClass::all();
        $typeVehicle = VehicleType::all();
        $typeAccident = TypeAccident::all();
        $causeAccident = CauseAccident::all();
        $categoryAccident = CategoryAccident::all();
        $lossAccident = LossAccident::all();
        $officer= Officer::all();
        $patroli= Officer::all();
        $pAmbulan = Officer::whereIn('operasional_id', [4, 8, 6])
        ->orderByRaw("FIELD(operasional_id, 4, 8, 6)")
        ->get();
        $pRescue= Officer::whereIn('operasional_id', [3, 8, 6])
        ->orderByRaw("FIELD(operasional_id, 3, 8, 6)")
        ->get();
        $pDerek= Officer::whereIn('operasional_id', [4,7, 6])
        ->orderByRaw("FIELD(operasional_id, 2, 7, 6)")
        ->get();
        $pAnother= Officer::whereIn('operasional_id', [5, 11 ,7, 8, 9, 10,  6])
        ->orderByRaw("FIELD(operasional_id, 5, 11, 7, 8, 9, 10, 6)")
        ->get();
         return view('pages.pelayanan-kecelakaan-lalu-lintas.editNext')->with(compact('datas','korban','patroli','kondisi','section','track','lane','weather','information','interference','classVehicle','typeVehicle', 'officer', 'typeAccident', 'causeAccident', 'categoryAccident', 'lossAccident','pAmbulan','pRescue','pAnother','pDerek'));
    }
    public function updatepkk(Request $request, $id)
    {
        if ($request->has('action') && $request->input('action') === 'next') {
            // Tombol "Next" diklik, lakukan validasi sesuai kebutuhan
            // Misalnya, validasi untuk field input
            $validator = [
                'stasioning' => 'required',
                'seksi' => 'required',
                'jalur' => 'required',
                'lajur' => 'required',
                'cuaca' => 'required',
                'sumber_informasi' => 'required',
                'tgl_kejadian' => 'required',
                'wkm' => 'required',
                'wsm' => 'required',
                'wsim' => 'required',
                'jk' => 'required',
                'pk' => 'required',
                'kk' => 'required',
                'kek' => 'required',
                'petugasLain' => 'required',
                'petugasRescue' => 'required',
                'petugasAmbulan' => 'required',
                'inlineRadioOptions' => 'required',
                // 'personil1' => 'required',
                // 'personil2' => 'required',
                'keterangan' => 'required',
                'nnk' => 'required',
                'dokumentasi' => 'array|min:4',
                // 'gk[]' => 'required',
                // 'nnk[]' => 'required'
    
                ];
                $customMessages = [
                'stasioning.required' => 'Stationing wajib diisi', 
                'seksi.required' => 'Seksi wajib diisi',
                'jalur.required' => 'Jalur wajib diisi',
                'lajur.required' => 'Lajur wajib diisi',
                'cuaca.required' => 'Cuaca wajib diisi',
                'tgl_kejadian.required' => 'Tanggal kejadian wajib diisi',
                'sumber_informasi.required' => 'Sumber informasi wajib diisi',
                'wkm.required' => 'Waktu kejadian wajib diisi',
                'wsm.required' => 'Waktu sampai wajib diisi',
                'wsim.required' => 'Waktu selesai wajib diisi',
                'jk.required' => 'Jenis kecelakaan wajib diisi',
                'pk.required' => 'Penyebab kecelakaan wajib diisi',
                'kk.required' => 'Kategori kecelakaan wajib diisi',
                'kek.required' => 'Kerugian kecelakaan wajib diisi',
                'petugasLain.required' => 'Petugas lain wajib diisi',
                'petugasRescue.required' => 'Petugas rescue wajib diisi',
                'petugasAmbulan.required' => 'Petugas ambulan wajib diisi',
                'inlineRadioOptions.required' => 'Penderekan wajib diisi',
                // 'personil1.required' => 'Petugas patroli 1 wajib diisi',
                // 'personil2.required' => 'Petugas patroli 2 wajib diisi',
                'keterangan.required' => 'Keterangan wajib diisi',
                'nnk.required' => 'Nopol nomor kendaraan wajib diisi',
                'dokumentasi.min' => 'Dokumentasi minimal harus terdiri dari 4 gambar.',
                ];
           
            $validator = Validator::make($request->all(), $validator, $customMessages);
    
    
        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator)->withInput();
        }
            $request->session()->put('stasioning', $request->stasioning);
            $request->session()->put('seksi', $request->seksi);
            $request->session()->put('jalur', $request->jalur);
            $request->session()->put('lajur', $request->lajur);
            $request->session()->put('cuaca', $request->cuaca);
            $request->session()->put('sumber_informasi', $request->sumber_informasi);
            $request->session()->put('tgl_kejadian', $request->tgl_kejadian);
            $request->session()->put('wkm', $request->wkm);
            $request->session()->put('wsm', $request->wsm);
            $request->session()->put('wsim', $request->wsim);
            $request->session()->put('jk', $request->jk);
            $request->session()->put('pk', $request->pk);
            $request->session()->put('kk', $request->kk);
            $request->session()->put('kek', $request->kek);
            $request->session()->put('kat', $request->kat);
            $request->session()->put('asal', $request->asal);
            $request->session()->put('tujuan', $request->tujuan);
            $request->session()->put('petugasLain', $request->petugasLain);
            $request->session()->put('petugasRescue', $request->petugasRescue);
            $request->session()->put('petugasAmbulan', $request->petugasAmbulan);
            // $request->session()->put('personil1', $request->personil1);
            // $request->session()->put('personil2', $request->personil2);
            $request->session()->put('keterangan', $request->keterangan);
            $request->session()->put('rtp', $request->rtp);
            $request->session()->put('dp', $request->dp);
            $request->session()->put('derek', $request->derek);
            $request->session()->put('petugasDerek', $request->petugasDerek);
            $request->session()->put('widdkc', $request->widdkc);
            $request->session()->put('wdslkc', $request->wdslkc);
            $request->session()->put('rtdkc', $request->rtdkc);
            $request->session()->put('nnk', $request->nnk);
            $request->session()->put('gk', $request->gk);
            
            $file = $request->file('dokumentasi');
            $no_gambar =1;
            if($file){
                foreach($file as $file){
                    $tujuan_upload = 'LKLL';
                    $file->move($tujuan_upload,'LKLL-Nomor Report-'.sprintf($id).'-'.$no_gambar.'.'.$file->getClientOriginalExtension());
                    $imageAccident = 'LKLL-Nomor Report-'.sprintf($id).'-'.$no_gambar.'.'.$file->getClientOriginalExtension();
                    $images[]= $imageAccident;
                    $no_gambar++;
                }
                $request->session()->put('gambar', $images);
            }
            // dd($request->action);
             return redirect()->route('pelayanan-kendaraan-kecelakaan.editNext',$id);
        }
        
        //upload Gambar
        $file = $request->file('dokumentasi');
        
        //respond time
        $waktuKejadian = strtotime($request->tgl_kejadian . ' ' . $request->wkm); // Mengubah ke format timestamp
        $waktuSampai = strtotime($request->tgl_kejadian . ' ' . $request->wsm); // Mengubah ke format timestamp
        $responTime = $waktuSampai - $waktuKejadian;
        // Mengonversi respon time ke dalam format jam:menit:detik
        $responTimeFormatted = gmdate('H:i', $responTime);
        // Buat data baru dalam model TrafficAccidentReport
        $report = TrafficAccidentReport::where('id', $id)->first();
        // dd($report);
        $mutasicek = MonitoringTime::all();
            foreach($mutasicek as $mutasicek){
               if($mutasicek->start_time<=$report->waktu_sampai && $mutasicek->end_time>=$report->waktu_sampai )
                {  
                    $cekwaktu = MonitoringTime::where('start_time', $mutasicek->start_time)->where('end_time',$mutasicek->end_time)->first();
                        // dd($cekwaktu);
                    $cekmutasi= ActivityMutationServiceTol::where('waktu_pemantauan', $cekwaktu->id)->where('no_mutasi', 'LIKE', '%'.Auth::user()->nama.'%')
                    ->orderBy('no_mutasi', 'DESC')->first();
                    // dd($cekmutasi);
                    if ($cekmutasi) {
                        $lastSemicolonPos = strrpos($cekmutasi->keterangan, ';');
                        // dd($lastSemicolonPos);
                 if ($lastSemicolonPos !== false) {
                        // Ambil potongan keterangan sebelum tanda ; terakhir
                        $trimmedKeterangan = substr($cekmutasi->keterangan, 0, $lastSemicolonPos);
                        
                        // Simpan keterangan yang sudah di-update
                        $cekmutasi->keterangan = $trimmedKeterangan;
                        // dd($cekmutasi->keterangan);
                        $cekmutasi->save();
                    } else {
                            $cekmutasi->delete();
                        }
                    }
                    // dd($cekmutasi);
                     
                } 
            }
        $report->stationing = $request->stasioning;
        $report->seksi = $request->seksi;
        $report->jalur = $request->jalur;
        $report->lajur = $request->lajur;
        $report->cuaca = $request->cuaca;
        $report->sumber_informasi = $request->sumber_informasi;
        $report->tanggal_kejadian = $request->tgl_kejadian;
        $report->waktu_kejadian = $request->wkm;
        $report->waktu_sampai = $request->wsm;
        $report->respon_time = $responTimeFormatted;
        $report->waktu_selesai = $request->wsim;
        $report->durasi_penanganan = $request->dp;
        $report->jenis_kecelakaan = $request->jk;
        $report->penyebab_kecelakaan = $request->pk;
        $report->kategori_kecelakaan = $request->kk;
        $report->kerugian_kecelakaan = $request->kek;
        $report->kerugian_tol = $request->kat;
        $report->asal_perjalanan =  $request->asal;
        $report->tujuan_perjalanan =  $request->tujuan;
        $report->penderekan = $request->inlineRadioOptions ?? '';
        // $report->personil1 =$personil1;
        // $report->personil2 =$personil2;
        $report->petugas_lainnya = $request->petugasLain ;
        $report->personil_rescue = $request->petugasRescue ;
        $report->personil_ambulan = $request->petugasAmbulan ;
        $report->petugas_derek = $request->petugasDerek ??71;
        $report->unit_derek = $request->derek??'';
        $report->waktu_dibutuhkan = $request->widdkc??'';
        $report->waktu_sampai_tkp = $request->wdslkc??'';
       // Hitung respon time derek
        $widdkc = $request->widdkc;
        $wdslkc = $request->wdslkc;
        if ($widdkc && $wdslkc) {
            $widdkc =(new Carbon("2023-01-01 $widdkc:00"));
            $wdslkc = (new Carbon("2023-01-01 $wdslkc:00"));

            $respon_time_derek = $wdslkc->diffInSeconds($widdkc);
            $respon_time_derek = gmdate('H:i', $respon_time_derek);
        }

        $report->respon_time_derek = $request->rtdkc??'';
        $report->dokumentasi = '';
        $current_stationing = Stationing::where('id', $request->stasioning)->first();
        $current_jalur = Track::where('id', $request->jalur)->first();
        $current_seksi = Section::where('id', $request->seksi)->first();
        $report->auto_text = 'Menangani kecelakaan lalu lintas di ' .$current_stationing->nama.' jalur ' .$current_jalur->nama. ' ruas tol ' .$current_seksi->nama. ' pada pukul ' .$request->wkm;
        $no_gambar = 0;
        
        $report->keterangan = $request->keterangan;
       $mutasi = MonitoringTime::all();
        foreach($mutasi as $mutasi){
            if($mutasi->start_time<=$request->wsm && $mutasi->end_time>=$request->wsm )
                {     
                $cekwaktu = MonitoringTime::where('start_time', $mutasi->start_time)->where('end_time',$mutasi->end_time)->first();
                // dd($cekwaktu);
                $today = Carbon::today();
                $cekmutasi = ActivityMutationServiceTol::where('waktu_pemantauan', $cekwaktu->id)
                                    ->whereDate('created_at', $today)->where('no_mutasi', 'LIKE', '%'.Auth::user()->nama.'%')->orderBy('no_mutasi', 'DESC')
                                    ->first();
                // dd($cekmutasi);
                if($cekmutasi){
                    $cekmutasi->keterangan = $cekmutasi->keterangan."; ".'Menangani kecelakaan lalu lintas di ' .$current_stationing->nama.' jalur ' .$current_jalur->nama. ' ruas tol ' .$current_seksi->nama. ' pada pukul ' .$request->wkm;
                    $cekmutasi->save();
                }
                else{
                    //add no mutasi
                    $waktu_pantau = ActivityMutationServiceTol::where('waktu_pemantauan',1)->where('no_mutasi', 'LIKE', Auth::user()->nama.'%')->orderBy('no_mutasi', 'DESC')->first();
                    $time = Carbon::now();
                    $hour = $time->hour;
                    $minute = $time->minute;
                    $no_mutasi = OutputMutation::where('no_mutation', 'LIKE', '%'.Auth::user()->nama.'%')->count();
                    // dd($no_mutasi);
                    $request->session()->put('no_mutasi', $no_mutasi);
                    // dd($time->toDateString());
                    if($no_mutasi==0){
                        $no = $request->session()->get('no_mutasi');
                        $no_mutasi= Auth::user()->nama.'-'.sprintf($no+1);
                        $request->session()->put('no_mutasi', $no_mutasi);
                    }
                    
                    else{
                        // $unit = User::where('id',$waktu_pantau->unit)->first();
                        if(!is_null($waktu_pantau) && ($hour==6 && $minute >= 30 || $hour>6 && $time->toDateString()!=$waktu_pantau->created_at->toDateString())){
                            $no= $request->session()->get('no_mutasi');
                            $non= OutputMutation::where('no_mutation',  Auth::user()->nama.'-'.sprintf($no))->count();
                            $no_mutasi= Auth::user()->nama.'-'.sprintf($non+1);
                            // dd($non);
                            $request->session()->put('no_mutasi', $no_mutasi);    
                        
                        }else{
                  $no= $request->session()->get('no_mutasi');
                //   dd($no);
                //   $no_muta = OutputMutation::where('no_mutation',  'LIKE', '%'.Auth::user()->nama.'%')->count();
                //   dd($no_muta);
                  $no_mutasi = Auth::user()->nama.'-'.sprintf($no);
                  $request->session()->put('no_mutasi', $no_mutasi);
                 
                }    
                            
                    }
                     $senkom = $request->session()->get('personilSenkom');
                     $tis = $request->session()->get('personilTis');
                  
                   
                    $addmutasi = new ActivityMutationServiceTol();
                    $addmutasi->unit = Auth::user()->operasional_id;
                    if(Auth::user()->operasional_id==10){
                        $addmutasi->personil1 =  $report->personil1;
                    $addmutasi->personil2 =  $report->personil2;
                    }else{
                         $addmutasi->personil1 =  $senkom;
                    $addmutasi->personil2 =  $tis;
                    }
                   
                    $addmutasi->waktu_pemantauan =  $cekwaktu->id;
                    $addmutasi->keterangan = 'Menangani kecelakaan lalu lintas di ' .$current_stationing->nama.' jalur ' .$current_jalur->nama. ' ruas tol ' .$current_seksi->nama. ' pada pukul ' .$request->wkm;   
                    $addmutasi->no_mutasi = $no_mutasi ;
                    $addmutasi->lokasi_pemantauan = 10 ;
                    $addmutasi->save();
                    // dd($addmutasi);
                    $request->session()->put('tanggal',$addmutasi->created_at);
                    $output = OutputMutation::where('no_mutation',$no_mutasi)->first();
                    if($output==null){
                        $datas= new OutputMutation;
                        $datas->no_mutation=$no_mutasi;
                        // dd($datas);
                        $datas->save();
                    }
                    
                }
               
            }
        }
        
         $report->save(); 
        // dd($file[$no_gambar]); 
        if($file){
            $imageAccident = ImageTrafficAccident::where('id_report', $id)->get();
            foreach($imageAccident as $imageAccident){
                $tujuan_upload = 'LKLL';
                // $imageAccident->id_report = $report->id;
                $file[$no_gambar]->move($tujuan_upload,'LKLL-Nomor Report-'.sprintf($id).'-'.sprintf($no_gambar+1).'.'.$file[$no_gambar]->getClientOriginalExtension());
                $imagePath = public_path($tujuan_upload . '/LKLL-Nomor Report-' . sprintf($id) .'-'.sprintf($no_gambar+1).'.' . $file[$no_gambar]->getClientOriginalExtension());
                $compressionQuality = 70;
                Image::make($imagePath)->save($imagePath, $compressionQuality);
                $imageAccident->nama = 'LKLL-Nomor Report-' . sprintf($id). '-'.sprintf($no_gambar+1).'.' . $file[$no_gambar]->getClientOriginalExtension();
                // $file->move($tujuan_upload,'LKLL-Nomor Report-'.sprintf($id).'-'.$no_gambar.'.'.$file->getClientOriginalExtension());
                // $imageAccident->nama = 'LKLL-Nomor Report-'.sprintf($id).'-'.$no_gambar.'.'.$file->getClientOriginalExtension();
                $imageAccident->save();
                $no_gambar++;
            }
        }
        //Detail kecelakaan
        $nnk = $request->nnk;
            foreach ($request->gk as $key => $gk) {
                $detailclass = TrafficAccidentReportVehicleClass::where('report_id', $id)->where('nopol', $nnk[$key])->first();
            
                if ($detailclass) {
                    // Update the existing record
                    $detailclass->vehicle_class_id = $gk;
                    $detailclass->nopol = $nnk[$key];
                    $detailclass->save();
                } else {
                    // Create a new record
                    TrafficAccidentReportVehicleClass::create([
                        'report_id' => $id,
                        'vehicle_class_id' => $gk,
                        'nopol' => $nnk[$key],
                    ]);
                }
            }
            
            // Delete any remaining records that were not included in the updated request data
            $existingRecords = TrafficAccidentReportVehicleClass::where('report_id', $id)->get();
            foreach ($existingRecords as $existingRecord) {
                if (!in_array($existingRecord->nopol, $nnk)) {
                    $existingRecord->delete();
                }
            }
            
        Session::flash('message', Lang::get('Data Berhasil Diedit'));
        if(Auth::user()->operasional_id==10){
           return redirect()->route('admin.pelayanan-kendaraan-kecelakaan'); 
        }else{
           return redirect()->route('pelayanan-kecelakaan-lalu-lintas.index'); 
        }
        
    }
    public function updateNext(Request $request, $id)
    {
            
            // dd($request->session()->get('wsim'));
            $waktuKejadian = strtotime($request->tgl_kejadian . ' ' . $request->wk); // Mengubah ke format timestamp
            $waktuSampai = strtotime($request->tgl_kejadian . ' ' . $request->ws); // Mengubah ke format timestamp
            $responTime = $waktuSampai - $waktuKejadian;
            // Mengonversi respon time ke dalam format jam:menit:detik
            $responTimeFormatted = gmdate('H:i', $responTime);
            // dd($request->session()->get('nnk'));
            // Buat data baru dalam model TrafficAccidentReport
            $report = TrafficAccidentReport::where('id', $id)->first();
            // dd($report);
            $mutasicek = MonitoringTime::all();
            foreach($mutasicek as $mutasicek){
               if($mutasicek->start_time<=$report->waktu_sampai && $mutasicek->end_time>=$report->waktu_sampai )
                {  
                    $cekwaktu = MonitoringTime::where('start_time', $mutasicek->start_time)->where('end_time',$mutasicek->end_time)->first();
                        // dd($cekwaktu);
                    $cekmutasi= ActivityMutationServiceTol::where('waktu_pemantauan', $cekwaktu->id)->where('no_mutasi', 'LIKE', '%'.Auth::user()->nama.'%')
                    ->orderBy('no_mutasi', 'DESC')->first();
                    // dd($cekmutasi);
                    if ($cekmutasi) {
                        $lastSemicolonPos = strrpos($cekmutasi->keterangan, ';');
                        // dd($lastSemicolonPos);
                 if ($lastSemicolonPos !== false) {
                        // Ambil potongan keterangan sebelum tanda ; terakhir
                        $trimmedKeterangan = substr($cekmutasi->keterangan, 0, $lastSemicolonPos);
                        
                        // Simpan keterangan yang sudah di-update
                        $cekmutasi->keterangan = $trimmedKeterangan;
                        // dd($cekmutasi->keterangan);
                        $cekmutasi->save();
                    } else {
                            $cekmutasi->delete();
                        }
                    }
                    // dd($cekmutasi);
                     
                } 
            }
            // dd($request->session()->get('wsm'));
            $report->stationing = $request->session()->get('stasioning');
            $report->seksi = $request->session()->get('seksi');
            $report->jalur = $request->session()->get('jalur');
            $report->lajur = $request->session()->get('lajur');
            $report->cuaca = $request->session()->get('cuaca');
            $report->sumber_informasi = $request->session()->get('sumber_informasi');
            $report->tanggal_kejadian = $request->session()->get('tgl_kejadian');
            $report->waktu_kejadian = $request->session()->get('wkm');
            $report->waktu_sampai =$request->session()->get('wsm');
            $report->respon_time = $responTimeFormatted;
            $report->waktu_selesai = $request->session()->get('wsim');
            // dd($report->waktu_selesai );
            $report->durasi_penanganan = $request->session()->get('dp');
            $report->jenis_kecelakaan = $request->session()->get('jk');
            $report->penyebab_kecelakaan = $request->session()->get('pk');
            $report->kategori_kecelakaan = $request->session()->get('kk');
            $report->kerugian_kecelakaan = $request->session()->get('kek');
            $report->kerugian_tol = $request->session()->get('kat');
            $report->asal_perjalanan =  $request->session()->get('asal');
            $report->tujuan_perjalanan =  $request->session()->get('tujuan');
            // $report->personil1 =$request->session()->get('personil1');
            // $report->personil2 =$request->session()->get('personil2');
            $report->petugas_lainnya =$request->session()->get('petugasLain');
            $report->personil_rescue = $request->session()->get('petugasRescue');
            $report->personil_ambulan = $request->session()->get('petugasAmbulan');
            $report->petugas_derek = $request->session()->get('petugasDerek')??71;
            $report->unit_derek = $request->session()->get('derek')??'';
            $report->waktu_dibutuhkan = $request->session()->get('widdkc')??'';
            $report->waktu_sampai_tkp = $request->session()->get('wdslkc')??'';
            $report->respon_time_derek = $request->session()->get('rtd')??'';
            $report->respon_time_derek = $request->session()->get('rtdkc')??'';
            $report->keterangan = $request->session()->get('keterangan');
            $report->dokumentasi = '';
            $report->waktu_info_medis_dibutuhkan = $request->widm;
            $report->waktu_tiba_medis = $request->wtmt;
            $report->respond_time_medis = $request->rtpm;
            $report->waktu_medis_meninggalkan_tkp = $request->wmmt;
            $report->durasi_penanganan_medis = $request->dpn;
            $report->waktu_sampai_rs = $request->wmrs;
            $report->durasi_perjalanan = $request->dpe;
             $current_stationing = Stationing::where('id', $request->session()->get('stasioning'))->first();
            $current_jalur = Track::where('id', $request->session()->get('jalur'))->first();
            $current_seksi = Section::where('id', $request->session()->get('seksi'))->first();
            $report->auto_text = 'Menangani kecelakaan lalu lintas di ' .$current_stationing->nama.' jalur ' .$current_jalur->nama. ' ruas tol ' .$current_seksi->nama. ' pada pukul ' .$request->session()->get('wkm');
            $mutasi = MonitoringTime::all();
            foreach($mutasi as $mutasi){
            if($mutasi->start_time<=$request->session()->get('wsm') && $mutasi->end_time>=$request->session()->get('wsm') )
                {     
                $cekwaktu = MonitoringTime::where('start_time', $mutasi->start_time)->where('end_time',$mutasi->end_time)->first();
                // dd($cekwaktu);
                $today = Carbon::today();
                $cekmutasi = ActivityMutationServiceTol::where('waktu_pemantauan', $cekwaktu->id)
                                    ->whereDate('created_at', $today)->where('no_mutasi', 'LIKE', '%'.Auth::user()->nama.'%')->orderBy('no_mutasi', 'DESC')
                                    ->first();
                // dd($cekmutasi);
                if($cekmutasi){
                    $cekmutasi->keterangan = $cekmutasi->keterangan."; ".'Menangani kecelakaan lalu lintas di ' .$current_stationing->nama.' jalur ' .$current_jalur->nama. ' ruas tol ' .$current_seksi->nama. ' pada pukul ' .$request->session()->get('wkm');
                    $cekmutasi->save();
                }
                else{
                    //add no mutasi
                   $waktu_pantau = ActivityMutationServiceTol::where('waktu_pemantauan',1)->where('no_mutasi', 'LIKE', Auth::user()->nama.'%')->orderBy('no_mutasi', 'DESC')->first();
                    $time = Carbon::now();
                    $hour = $time->hour;
                    $minute = $time->minute;
                    $no_mutasi = OutputMutation::where('no_mutation', 'LIKE', '%'.Auth::user()->nama.'%')->count();
                    // dd($no_mutasi);
                    $request->session()->put('no_mutasi', $no_mutasi);
                    // dd($time->toDateString());
                    if($no_mutasi==0){
                        $no = $request->session()->get('no_mutasi');
                        $no_mutasi= Auth::user()->nama.'-'.sprintf($no+1);
                        $request->session()->put('no_mutasi', $no_mutasi);
                    }
                    
                    else{
                        // $unit = User::where('id',$waktu_pantau->unit)->first();
                        if(!is_null($waktu_pantau) && ($hour==6 && $minute >= 30 || $hour>6 && $time->toDateString()!=$waktu_pantau->created_at->toDateString())){
                            $no= $request->session()->get('no_mutasi');
                            $non= OutputMutation::where('no_mutation',  Auth::user()->nama.'-'.sprintf($no))->count();
                            $no_mutasi= Auth::user()->nama.'-'.sprintf($non+1);
                            // dd($non);
                            $request->session()->put('no_mutasi', $no_mutasi);    
                        
                        }else{
                  $no= $request->session()->get('no_mutasi');
                //   dd($no);
                //   $no_muta = OutputMutation::where('no_mutation',  'LIKE', '%'.Auth::user()->nama.'%')->count();
                //   dd($no_muta);
                  $no_mutasi = Auth::user()->nama.'-'.sprintf($no);
                  $request->session()->put('no_mutasi', $no_mutasi);
                 
                }    
                            
                    }
                     $senkom = $request->session()->get('personilSenkom');
                     $tis = $request->session()->get('personilTis');
                  
                   
                    $addmutasi = new ActivityMutationServiceTol();
                    $addmutasi->unit = Auth::user()->operasional_id;
                     if(Auth::user()->operasional_id==10){
                        $addmutasi->personil1 =  $report->personil1;
                    $addmutasi->personil2 =  $report->personil2;
                    }else{
                         $addmutasi->personil1 =  $senkom;
                    $addmutasi->personil2 =  $tis;
                    }
                    $addmutasi->waktu_pemantauan =  $cekwaktu->id;
                    $addmutasi->keterangan = 'Menangani kecelakaan lalu lintas di ' .$current_stationing->nama.' jalur ' .$current_jalur->nama. ' ruas tol ' .$current_seksi->nama. ' pada pukul ' .$request->session()->get('wkm');   
                    $addmutasi->no_mutasi = $no_mutasi ;
                    $addmutasi->lokasi_pemantauan = 10 ;
                    $addmutasi->save();
                    // dd($addmutasi);
                    $request->session()->put('tanggal',$addmutasi->created_at);
                    $output = OutputMutation::where('no_mutation',$no_mutasi)->first();
                    if($output==null){
                        $datas= new OutputMutation;
                        $datas->no_mutation=$no_mutasi;
                        // dd($datas);
                        $datas->save();
                    }
                    
                }
               
            }
        } 
            
             $report->save(); 
            $file = $request->session()->get('gambar');
            if($file){
                $imageAccident = ImageTrafficAccident::where('id_report', $id)->get();
                foreach($imageAccident as $key=>$imageAccident){
                    // $tujuan_upload = 'LKLL';
                    // $imageAccident->id_report = $report->id;
                    // $file[$no_gambar]->move($tujuan_upload,'LKLL-Nomor Report-'.sprintf($id).'-'.sprintf($no_gambar+1).'.'.$file[$no_gambar]->getClientOriginalExtension());
                    // $imagePath = public_path($tujuan_upload . '/LKLL-Nomor Report-' . sprintf($id) .'-'.sprintf($no_gambar+1).'.' . $file[$no_gambar]->getClientOriginalExtension());
                    // $compressionQuality = 70;
                    // Image::make($imagePath)->save($imagePath, $compressionQuality);
                    $imageAccident->nama = $request->session()->get('gambar')[$key];
                    // $file->move($tujuan_upload,'LKLL-Nomor Report-'.sprintf($id).'-'.$no_gambar.'.'.$file->getClientOriginalExtension());
                    // $imageAccident->nama = 'LKLL-Nomor Report-'.sprintf($id).'-'.$no_gambar.'.'.$file->getClientOriginalExtension();
                    $imageAccident->save();
                }
            }
            //Detail kecelakaan
            $nnk = $request->session()->get('nnk');
            foreach ($request->session()->get('gk') as $key => $gk) {
                $detailclass = TrafficAccidentReportVehicleClass::where('report_id', $id)->where('nopol', $nnk[$key])->first();
            
                if ($detailclass) {
                    // Update the existing record
                    $detailclass->vehicle_class_id = $gk;
                    $detailclass->nopol = $nnk[$key];
                    $detailclass->save();
                } else {
                    // Create a new record
                    TrafficAccidentReportVehicleClass::create([
                        'report_id' => $id,
                        'vehicle_class_id' => $gk,
                        'nopol' => $nnk[$key],
                    ]);
                }
            }
            
            // Delete any remaining records that were not included in the updated request data
            $existingRecords = TrafficAccidentReportVehicleClass::where('report_id', $id)->get();

            foreach ($existingRecords as $existingRecord) {
                if (!in_array($existingRecord->nopol, $nnk)) {
                    $existingRecord->delete();
                }
            }
            
            $dataKorban = TrafficAccidentVictim::where('report_id', $id)->get();
            $existingVictimNames = $dataKorban->pluck('nama')->all();
            // dd($dataKorban));
            if($dataKorban->count() > 0){
                foreach ($request->korban as $key => $korban) {
                    // Check if the victim already exists in the database
                    $dataKorban = $dataKorban->where('nama', $existingVictimNames[$key])->first();
                
                    if ($dataKorban) {
                        // Update the existing victim with complete data
                        $dataKorban->nama = $korban;
                        $dataKorban->umur = $request->umur[$key];
                        $dataKorban->kondisi = $request->kondisi[$key];
                        $dataKorban->tindakan = $request->tindakan[$key];
                        $dataKorban->save();
                    } else {
                        // Create a new victim
                        TrafficAccidentVictim::create([
                            'report_id' => $id,
                            'nama' => $korban,
                            'umur' => $request->umur[$key],
                            'kondisi' => $request->kondisi[$key],
                            'tindakan' => $request->tindakan[$key],
                        ]);
                    }
                }
                
                // Delete any remaining victims that were not included in the updated request data
                foreach ($existingVictimNames as $existingName) {
                    if (!in_array($existingName, $request->korban)) {
                        $dataKorban = TrafficAccidentVictim::where('report_id', $id)->where('nama', $existingName)->first();
                        $dataKorban->delete();
                    }
                }
                
            }else{
                foreach($request->korban as $key=>$korban){
                    $dataKorbanNew = new TrafficAccidentVictim;
                    $dataKorbanNew->report_id = $report->id;
                    $dataKorbanNew->nama = $korban;
                    $dataKorbanNew->umur = $request->umur[$key];
                    $dataKorbanNew->kondisi = $request->kondisi[$key];
                    $dataKorbanNew->tindakan = $request->tindakan[$key];
                    $dataKorbanNew->save();
                    // dd($dataKorban);
                }
            }
            
            
          
            Session::flash('message', Lang::get('Data Berhasil Diedit'));
              if(Auth::user()->operasional_id==10){
           return redirect()->route('admin.pelayanan-kendaraan-kecelakaan'); 
        }else{
           return redirect()->route('pelayanan-kecelakaan-lalu-lintas.index'); 
        }

    }
    

}
