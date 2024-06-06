<?php

namespace App\Http\Controllers;

use App\Models\ActivityMutationServiceTol;
use App\Models\Interference;
use App\Models\Lane;
use App\Models\MonitoringTime;
use App\Models\Officer;
use App\Models\OperationalControlServiceReport;
use App\Models\OutputMutation;
use App\Models\Section;
use App\Models\ImageOperasional;
use App\Models\SourceInformation;
use App\Models\Stationing;
use App\Models\Track;
use App\Models\TypeActivity;
use App\Models\VehicleClass;
use App\Models\VehicleType;
use App\Models\Weather;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Lang, Validator, Session;

class PelayananPengendalianOperasionalController extends Controller
{
    public function index(Request $request){
        $startDate = $request->input('start');
        $endDate = $request->input('end');
        $endDate = date('Y-m-d', strtotime($endDate . ' +1 day'));
        $unit = Auth::user()->nama;
         $time = Carbon::now();
      if(Auth::user()->operasional_id == 10){
            if($startDate==null || $endDate==null){
           
            
                $datas = OperationalControlServiceReport::orderBy('created_at', 'DESC') ->get();
            
            }else{
                $datas = OperationalControlServiceReport::WhereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'DESC') ->get();
            }
      }
      elseif(Auth::user()->operasional_id == 7){
        if ($startDate == null || $endDate == null) {
        $datas = OperationalControlServiceReport::whereIn('unit', [801, 802, 803, 'Derek'])
            ->orderBy('created_at', 'DESC')->get();
    } else {
        $datas = OperationalControlServiceReport::whereBetween('created_at', [$startDate, $endDate])
            ->whereIn('unit', [801, 802, 803, 'Derek'])->orderBy('created_at', 'DESC')->get();
    }
      }
      elseif(Auth::user()->operasional_id == 8){
        if ($startDate == null || $endDate == null) {
        $datas = OperationalControlServiceReport::whereIn('unit', ['Ambulans', 'Rescue'])
            ->orderBy('created_at', 'DESC')->get();
    } else {
        $datas = OperationalControlServiceReport::whereBetween('created_at', [$startDate, $endDate])
            ->whereIn('unit', ['Ambulans', 'Rescue'])->orderBy('created_at', 'DESC')->get();
    }
      }
      elseif(Auth::user()->operasional_id == 9){
        if ($startDate == null || $endDate == null) {
        $datas = OperationalControlServiceReport::whereIn('unit', 'security')
            ->orderBy('created_at', 'DESC')->get();
    } else {
        $datas = OperationalControlServiceReport::whereBetween('created_at', [$startDate, $endDate])
            ->whereIn('unit', 'security')->orderBy('created_at', 'DESC')->get();
    }
      }
      else{
        $datas = OperationalControlServiceReport::where('unit',$unit )->whereDate('created_at', $time->format('Y-m-d'))->orderBy('created_at', 'DESC') ->get();
      }
        
   
        return view('pages.pelayanan-pengendalian-operasional.index')->with('datas', $datas);
     
    }
      public function create(Request $request)
    {
        $personil1 = $request->session()->get('personil1');
        $personil2 = $request->session()->get('personil2');
        $personilAmbulan = $request->session()->get('personil');
        $personilSecurity = $request->session()->get('personilSecurity');
        $rescue= $request->session()->get('personilRescue');
        $senkom = $request->session()->get('personilSenkom');
        $tis = $request->session()->get('personilTis');
        $derek = $request->session()->get('personilDerek');
        $p1= Officer::where('id', $personil1)->first();
        $p2= Officer::where('id', $personil2)->first();
        $pAmbulan= Officer::where('id', $personilAmbulan)->first();
        $pSecurity= Officer::where('id', $personilSecurity)->first();
        $pRescue= Officer::where('id', $personilSecurity)->first();
        $pSecurity= Officer::where('id', $personilSecurity)->first();
        $pr= Officer::where('id', $rescue)->first();
        $psn= Officer::where('id', $senkom)->first();
        $ptis= Officer::where('id', $tis)->first();
        $pdk = Officer::where('id', $derek)->first();
        // dd($ptis,$psn);
        $stationing = Stationing::all();
        $section = Section::all();
        $track = Track::all();
        $lane = Lane::all();
        $weather = Weather::all();
        $information = SourceInformation::all();
        $interference = Interference::all();
        $classVehicle = VehicleClass::all();
        $typeVehicle = VehicleType::all();
        $officer= Officer::all();
        $derek= Officer::where('operasional_id',2)->get();
        $activity = TypeActivity::all();
        // dd($personil1);
        return view('pages.pelayanan-pengendalian-operasional.create')->with(compact('p1', 'p2','pAmbulan','pSecurity','pr', 'psn','ptis', 'pdk','stationing','section', 'track','lane','weather','information','interference','classVehicle','typeVehicle', 'officer','derek', 'activity'));
    }
       public function store(Request $request)

    {
          $validator = [
            'stasioning' => 'required',
            'seksi' => 'required',
            'jalur' => 'required',
            'lajur' => 'required',
            'cuaca' => 'required',
            'sumber_informasi' => 'required',
            'tgl_kejadian' => 'required',
            'wkpo' => 'required',
            'wspo' => 'required',
            'wsipo' => 'required',
            'jk' => 'required',
            'dk' => 'required',
            // 'keterangan' => 'required',
             'dokumentasi' => 'required|array|size:2',
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
            'wkpo.required' => 'Waktu kejadian wajib diisi',
            'wspo.required' => 'Waktu sampai wajib diisi',
            'wsipo.required' => 'Waktu selesai wajib diisi',
            'jk.required' => 'Jenis kegiatan wajib diisi',
            'dk.required' => 'Deskripsi kegiatan wajib diisi',
            'dokumentasi.required' => 'Dokumentasi wajib diisi',
            'dokumentasi.size' => 'Dokumentasi harus terdiri dari 2 gambar',
            // 'keterangan.required' => 'Keterangan wajib diisi'
            // 'gk[].required' =>'Golongan kendaraan wajib diisi',
            // 'nnk[].required' => 'Nopol nomor kendaraan wajib diisi'
            ];
       
        $validator = Validator::make($request->all(), $validator, $customMessages);


    if ($validator->fails()) {
        
        return redirect()->back()->withErrors($validator)->withInput();
    }
        // $validator = Validator::make($request->all(), [
        //     'dokumentasi' => 'required|image|mimes:jpeg,png,jpg',
        // ],);

        //  if($validator->fails())
        // {
        //     $validator->errors()->add('message', Lang::get('gagal'));
        //     return redirect()->back()->withInput()->withErrors($validator);
        // }
        // dd($request->all());
        // try {
            $no = OperationalControlServiceReport::all()->count();
            //upload Gambar
            $file = $request->file('dokumentasi');
            
            $waktuKejadian = strtotime($request->tgl_kejadian . ' ' . $request->wkpo); // Mengubah ke format timestamp
            $waktuSampai = strtotime($request->tgl_kejadian . ' ' . $request->wspo); // Mengubah ke format timestamp
            $responTime = $waktuSampai - $waktuKejadian;
            // Mengonversi respon time ke dalam format jam:menit:detik
            $responTimeFormatted = gmdate('H:i', $responTime);
       
            $personil1 = $request->session()->get('personil1');
        $personil2 = $request->session()->get('personil2');
        $waktu_pantau = ActivityMutationServiceTol::where('waktu_pemantauan',1)->orderBy('created_at', 'DESC')->first();
        $personilAmbulan = $request->session()->get('personil');
        $personilSecurity = $request->session()->get('personilSecurity');
        $personilRescue = $request->session()->get('personilRescue');
        $personilSenkom = $request->session()->get('personilSenkom');
        $personilTis = $request->session()->get('personilTis');
        $personilDerek = $request->session()->get('personilDerek');
            // dd($personil1);
            $data = new OperationalControlServiceReport;
            $data->stationing = $request->stasioning;
            $data->seksi = $request->seksi;
            $data->jalur = $request->jalur;
            $data->lajur = $request->lajur;
            $data->cuaca = $request->cuaca;
            $data->sumber_informasi = $request->sumber_informasi;
            $data->tanggal_kejadian = $request->tgl_kejadian;
            $data->waktu_kejadian = $request->wkpo;
            $data->waktu_sampai = $request->wspo;
            $data->respon_time = $responTimeFormatted;
            $data->waktu_selesai = $request->wsipo;
            $data->durasi_penanganan = $request->dppo ?? '';
            $data->jenis_kegiatan = $request->jk;
            $data->deskripsi_kegiatan = $request->dk;
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
            $data->personil3 = $request->personil3??null;
            $data->personil4 = $request->personil4??null;
            $data->personil5 = $request->personil5??null;
            $data->unit = Auth::user()->nama;
            $current_activity = TypeActivity::where('id', $request->jk)->first();
            $current_stationing = Stationing::where('id', $request->stasioning)->first();
            $current_jalur = Track::where('id', $request->jalur)->first();
            $current_seksi = Section::where('id', $request->seksi)->first();
            $data->auto_text = 'Melakukan ' .$current_activity->nama.' di ' .$current_stationing->nama .' jalur ' .$current_jalur->nama. ' ruas tol ' .$current_seksi->nama;
           
            
            $mutasi = MonitoringTime::all();
        foreach($mutasi as $mutasi){
            // dd($request->wsi);
            if($mutasi->start_time<=$request->wspo && $mutasi->end_time>=$request->wspo )
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
                        ->orderBy('created_at', 'DESC')
                        ->first();
                    }else{
                      
                        $startDate = now()->setTime(6, 45); // Today at 06:30 AM
                        $endDate = now()->addDay(1)->setTime(6, 45); // Tomorrow at 06:30 AM
                        $cekmutasi = ActivityMutationServiceTol::where('waktu_pemantauan', $cekwaktu->id)
                        ->where('no_mutasi', 'LIKE', Auth::user()->nama . '%')
                        ->whereBetween('created_at', [$startDate, $endDate])
                        ->orderBy('created_at', 'DESC')
                        ->first();
                        // dd($endDate);
                    }
                // dd($cekmutasi);
                if($cekmutasi){
                    $cekmutasi->keterangan = $cekmutasi->keterangan."; ".'Melakukan ' .$current_activity->nama.' di ' .$current_stationing->nama .' jalur ' .$current_jalur->nama. ' ruas tol ' .$current_seksi->nama;
                    // dd($cekmutasi);
                    $cekmutasi->save();
                    
                }
                else{
                    //add no mutasi
                    $waktu_pantau = ActivityMutationServiceTol::where('waktu_pemantauan',1)->where('no_mutasi', 'LIKE', Auth::user()->nama.'%')->orderBy('created_at', 'DESC')->first();
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
                        if($hour==6 && $minute >= 45 || $hour>6 && $time->toDateString()!=$waktu_pantau->created_at->toDateString()){
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
                    
                    $addmutasi = new ActivityMutationServiceTol();
                    $addmutasi->unit = Auth::user()->operasional_id;
                    if($personil1!=null && $personil2!=null){
                        $addmutasi->personil1 =  $personil1;
                        $addmutasi->personil2 =  $personil2;
                    }
                    else if($personilAmbulan!=null){
                        $addmutasi->personil1 =  $personilAmbulan;
                        $addmutasi->personil2 =  $personilAmbulan;
                    }
                    else if($personilSecurity!=null){
                        $addmutasi->personil1 =  $personilSecurity;
                        $addmutasi->personil2 =  $personilSecurity;
                    }
                    else if($personilRescue!=null){
                        $addmutasi->personil1 =  $personilRescue;
                        $addmutasi->personil2 =  $personilRescue;
                    }
                    else if($personilSenkom!=null&&$personilTis!=null){
                        $addmutasi->personil1 =  $personilSenkom;
                        $addmutasi->personil2 =  $personilTis;
                    }
                    else if($personilDerek!=null){
                        $addmutasi->personil1 =  $personilDerek;
                        $addmutasi->personil2 =  $personilDerek;
                    }
                    $addmutasi->waktu_pemantauan =  $cekwaktu->id;
                    $addmutasi->keterangan = 'Melakukan ' .$current_activity->nama.' di ' .$current_stationing->nama .' jalur ' .$current_jalur->nama. ' ruas tol ' .$current_seksi->nama;
                    $addmutasi->no_mutasi = $no_mutasi ;
                    $addmutasi->lokasi_pemantauan = 10 ;
                    // dd($addmutasi);
                    $request->session()->put('tanggal',$addmutasi->created_at);
                    $output = OutputMutation::where('no_mutation',$no_mutasi)->first();
                    if($output==null){
                        $datas= new OutputMutation;
                        $datas->no_mutation=$no_mutasi;
                        $datas->save();
                    }
                    // dd($addmutasi);
                    $addmutasi->save();
                }
                

            }
            $data->dokumentasi = "";
            // dd($data);
            $data->save();
            
            $no_gambar =1;
             foreach($file as $file){
                $tujuan_upload = 'LPPO';
                $file->move($tujuan_upload,'LPPO-Nomor Report-'.sprintf($data->id).'-'.$no_gambar.'.'.$file->getClientOriginalExtension());
                $imageOperasional = new ImageOperasional;
                $imageOperasional->id_report = $data->id;
                $imageOperasional->nama = 'LPPO-Nomor Report-'.sprintf($data->id).'-'.$no_gambar.'.'.$file->getClientOriginalExtension();
                $imageOperasional->save();
                // dd($imageOperasional);
                $no_gambar++;
        }
           
        }

            
            Session::flash('message', Lang::get('Data Berhasil Dibuat'));
            return redirect()->route('pelayanan-pengendalian-operasional.index')->with(compact('responTimeFormatted'));
    }
    
          public function export($id)
    {
        // try {
        //     $data = OutputMutation::where('id', $id)
        //         ->first()
        //         ->toArray();
        // } catch (\Exception $errors) {
        //     return redirect()
        //         ->back()
        //         ->withInput()
        //         ->withErrors(['message' => Lang::get('web.data-not-found')]);
        // }

        // dd($data['no_mutasi']);
        $pdf = Pdf::loadView('pdf.pelayanan-pengendalian-operasional');

        return $pdf->stream('Laporan Pelayanan Pengendalian Operasional' . '.pdf');
    }
     public function edit($id) {
        $datas = OperationalControlServiceReport::where('id', $id)->first();
        $p1 = Officer::where('id', $datas->personil1)->first();
        $p2 = Officer::where('id', $datas->personil2)->first();
        $stationing = Stationing::all();
        $section = Section::all();
        $track = Track::all();
        $lane = Lane::all();
        $weather = Weather::all();
        $information = SourceInformation::all();
        $interference = Interference::all();
        $classVehicle = VehicleClass::all();
        $typeVehicle = VehicleType::all();
        $officer= Officer::all();
        $derek= Officer::where('operasional_id',2)->get();
        $activity = TypeActivity::all();
        return view('pages.pelayanan-pengendalian-operasional.edit')->with(compact('p1', 'p2','stationing','section', 'track','lane','weather','information','interference','classVehicle','typeVehicle', 'officer','derek', 'activity', 'datas'));
    }
    public function update($id, Request $request){
       
        $validator = Validator::make($request->all(), [
             'dokumentasi' => 'array|min:2',
        ]);

        if ($validator->fails()) {
            $validator->errors()->add('message', Lang::get('Gagal edit data. Masukkan 2 foto dokumentasi!'));
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
        // try {
        // $no = VaultVehicleReport::all()->count();
        //upload Gambar
        $file = $request->file('dokumentasi');
        $tujuan_upload = 'LPPO';
        
        // dd($file);

        $waktuKejadian = strtotime($request->tgl_kejadian . ' ' . $request->wk); // Mengubah ke format timestamp
        $waktuSampai = strtotime($request->tgl_kejadian . ' ' . $request->ws); // Mengubah ke format timestamp
        $responTime = $waktuSampai - $waktuKejadian;
        // Mengonversi respon time ke dalam format jam:menit:detik
        $responTimeFormatted = gmdate('H:i', $responTime);

        // $personil1 = $request->session()->get('personil1');
        // $personil2 = $request->session()->get('personil2');
        // $personilAmbulan = $request->session()->get('personil');
        // $personilSecurity = $request->session()->get('personilSecurity');
        $data = OperationalControlServiceReport::find($id);
         $mutasicek = MonitoringTime::all();
            foreach($mutasicek as $mutasicek){
               if($mutasicek->start_time<=$data->waktu_sampai && $mutasicek->end_time>=$data->waktu_sampai )
                {  
                    $cekwaktu = MonitoringTime::where('start_time', $mutasicek->start_time)->where('end_time',$mutasicek->end_time)->first();
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
            $personil1 = $request->session()->get('personil1');
            $personil2 = $request->session()->get('personil2');
            $waktu_pantau = ActivityMutationServiceTol::where('waktu_pemantauan',1)->orderBy('no_mutasi', 'DESC')->first();
            $personilAmbulan = $request->session()->get('personil');
            $personilSecurity = $request->session()->get('personilSecurity');
            $personilRescue = $request->session()->get('personilRescue');
            $personilSenkom = $request->session()->get('personilSenkom');
            $personilTis = $request->session()->get('personilTis');
            $personilDerek = $request->session()->get('personilDerek');
        $data->stationing = $request->stasioning;
            $data->seksi = $request->seksi;
            $data->jalur = $request->jalur;
            $data->lajur = $request->lajur;
            $data->cuaca = $request->cuaca;
            $data->sumber_informasi = $request->sumber_informasi;
            $data->tanggal_kejadian = $request->tgl_kejadian;
            $data->waktu_kejadian = $request->wkpo;
            $data->waktu_sampai = $request->wspo;
            $data->respon_time = $responTimeFormatted;
            $data->waktu_selesai = $request->wsipo;
            $data->durasi_penanganan = $request->dppo ?? '';
            $data->jenis_kegiatan = $request->jk;
            $data->deskripsi_kegiatan = $request->dk;
            // $data->personil1 =$personil1;
            // $data->personil2 =$personil2;
            $data->personil3 = $request->personil3??null;
            $data->personil4 = $request->personil4??null;
            $data->personil5 = $request->personil5??null;
             $current_activity = TypeActivity::where('id', $request->jk)->first();
            $current_stationing = Stationing::where('id', $request->stasioning)->first();
            $current_jalur = Track::where('id', $request->jalur)->first();
            $current_seksi = Section::where('id', $request->seksi)->first();
            $data->auto_text = 'Melakukan ' .$current_activity->nama.' di ' .$current_stationing->nama .' jalur ' .$current_jalur->nama. ' ruas tol ' .$current_seksi->nama;
        if($file){
            // dd($file);
            $no_gambar=0;
              $imageOperasional = ImageOperasional::where('id_report',$data->id)->get();
          foreach($imageOperasional as $imageOperasional){
                $tujuan_upload = 'LPPO';
                // $imageOperasional->id_report = $report->id;
                $file[$no_gambar]->move($tujuan_upload,'LPPO-Nomor Report-'.sprintf($id).'-'.sprintf($no_gambar+1).'.'.$file[$no_gambar]->getClientOriginalExtension());
                // $imagePath = public_path($tujuan_upload . '/LPPO-Nomor Report-' . sprintf($id) .'-'.sprintf($no_gambar+1).'.' . $file[$no_gambar]->getClientOriginalExtension());
                $compressionQuality = 70;
                // Image::make($imagePath)->save($imagePath, $compressionQuality);
                $imageOperasional->nama = 'LPPO-Nomor Report-' . sprintf($id). '-'.sprintf($no_gambar+1).'.' . $file[$no_gambar]->getClientOriginalExtension();
                // $file->move($tujuan_upload,'LPKG-Nomor Report-'.sprintf($id).'-'.$no_gambar.'.'.$file->getClientOriginalExtension());
                // $imageOperasional->nama = 'LPKG-Nomor Report-'.sprintf($id).'-'.$no_gambar.'.'.$file->getClientOriginalExtension();
                $imageOperasional->save();
                $no_gambar++;
            }
        }
        $mutasi = MonitoringTime::all();
        foreach($mutasi as $mutasi){
            // dd($request->wsi);
            if($mutasi->start_time<=$request->wspo && $mutasi->end_time>=$request->wspo )
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
                if($cekmutasi){
                    $cekmutasi->keterangan = $cekmutasi->keterangan."; ".'Melakukan ' .$current_activity->nama.' di ' .$current_stationing->nama .' jalur ' .$current_jalur->nama. ' ruas tol ' .$current_seksi->nama;
                    // dd($cekmutasi);
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
                        if($hour==6 && $minute >= 45 || $hour>6 && $time->toDateString()!=$waktu_pantau->created_at->toDateString()){
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
                    
                    $addmutasi = new ActivityMutationServiceTol();
                    $addmutasi->unit = Auth::user()->operasional_id;
                    if($personil1!=null && $personil2!=null){
                        $addmutasi->personil1 =  $personil1;
                        $addmutasi->personil2 =  $personil2;
                    }
                    else if($personilAmbulan!=null){
                        $addmutasi->personil1 =  $personilAmbulan;
                        $addmutasi->personil2 =  $personilAmbulan;
                    }
                    else if($personilSecurity!=null){
                        $addmutasi->personil1 =  $personilSecurity;
                        $addmutasi->personil2 =  $personilSecurity;
                    }
                    else if($personilRescue!=null){
                        $addmutasi->personil1 =  $personilRescue;
                        $addmutasi->personil2 =  $personilRescue;
                    }
                    else if($personilSenkom!=null&&$personilTis!=null){
                        $addmutasi->personil1 =  $personilSenkom;
                        $addmutasi->personil2 =  $personilTis;
                    }
                    else if($personilDerek!=null){
                        $addmutasi->personil1 =  $personilDerek;
                        $addmutasi->personil2 =  $personilDerek;
                    }
                    $addmutasi->waktu_pemantauan =  $cekwaktu->id;
                    $addmutasi->keterangan = 'Melakukan ' .$current_activity->nama.' di ' .$current_stationing->nama .' jalur ' .$current_jalur->nama. ' ruas tol ' .$current_seksi->nama;
                    $addmutasi->no_mutasi = $no_mutasi ;
                    $addmutasi->lokasi_pemantauan = 10 ;
                    // dd($addmutasi);
                    $request->session()->put('tanggal',$addmutasi->created_at);
                    $output = OutputMutation::where('no_mutation',$no_mutasi)->first();
                    if($output==null){
                        $datas= new OutputMutation;
                        $datas->no_mutation=$no_mutasi;
                        $datas->save();
                    }
                    // dd($addmutasi);
                    $addmutasi->save();
                }
                

            }}
        $data->save();
        Session::flash('message', Lang::get('Edit Data Berhasil'));
        return redirect()
            ->route('pelayanan-pengendalian-operasional.index')
            ->with(compact('responTimeFormatted'));
    }
    
      public function delete($id)

    {    // Mendapatkan tanggal hari ini
        $data =  OperationalControlServiceReport::where('id', $id)->first();
         $mutasicek = MonitoringTime::all();
            foreach($mutasicek as $mutasicek){
               if($mutasicek->start_time<=$data->waktu_sampai && $mutasicek->end_time>=$data->waktu_sampai )
                {  
                    $cekwaktu = MonitoringTime::where('start_time', $mutasicek->start_time)->where('end_time',$mutasicek->end_time)->first();
                        // dd($cekwaktu);
                    $cekmutasi= ActivityMutationServiceTol::where('waktu_pemantauan', $cekwaktu->id)->where('no_mutasi', 'LIKE', '%'.$data->unit.'%')
                    ->first();
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
             ImageOperasional::where('id_report',$id)->delete();
       OperationalControlServiceReport::where('id',$id)->delete();
        if(Auth::user()->operasional_id==10){
            Session::flash('message', Lang::get('Data Berhasil Dihapus'));
            return redirect()->route('admin.pelayanan-pengendalian-operasional.index');   
        }
        else{
            Session::flash('message', Lang::get('Data Berhasil Dihapus'));
        return redirect()->route('pelayanan-pengendalian-operasional.index');
        }
        
    }
}
