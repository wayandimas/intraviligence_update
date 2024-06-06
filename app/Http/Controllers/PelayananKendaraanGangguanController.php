<?php

namespace App\Http\Controllers;

use App\Models\ActivityMutationServiceTol;
use App\Models\CategoryAccident;
use App\Models\CauseAccident;
use App\Models\ImageTrafficAccident;
use App\Models\Interference;
use App\Models\ImageVault;
use Carbon\Carbon;
use App\Models\Lane;
use App\Models\LossAccident;
use App\Models\MonitoringLocation;
use App\Models\MonitoringTime;
use App\Models\Officer;
use App\Models\OutputMutation;
use App\Models\Section;
use App\Models\SourceInformation;
use App\Models\Stationing;
use App\Models\Track;
use App\Models\TrafficAccidentReport;
use App\Models\TrafficAccidentReportVehicleClass;
use App\Models\TypeAccident;
use App\Models\VaultVehicleReport;
use App\Models\VehicleClass;
use App\Models\VehicleType;
use App\Models\Weather;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Lang, Validator, Session, Image, Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PelayananKendaraanGangguanController extends Controller
{
    public function index(Request $request)
    {
         $startDate = $request->input('start');
        $endDate = $request->input('end');
        $endDate = date('Y-m-d', strtotime($endDate . ' +1 day'));
        $unit = Auth::user()->nama;
         $time = Carbon::now();
       if(Auth::user()->operasional_id == 10){
            if($startDate==null || $endDate==null){
           
            
                $datas =VaultVehicleReport::orderBy('created_at', 'DESC') ->get();
            
            }else{
                $datas =VaultVehicleReport::WhereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'DESC') ->get();
            }
      }
      elseif(Auth::user()->operasional_id == 7){
        if ($startDate == null || $endDate == null) {
        $datas =VaultVehicleReport::whereIn('unit', [801, 802, 803, 'Derek'])
            ->orderBy('created_at', 'DESC')->get();
    } else {
        $datas =VaultVehicleReport::whereBetween('created_at', [$startDate, $endDate])
            ->whereIn('unit', [801, 802, 803, 'Derek'])->orderBy('created_at', 'DESC')->get();
    }
      }
      elseif(Auth::user()->operasional_id == 8){
        if ($startDate == null || $endDate == null) {
        $datas =VaultVehicleReport::whereIn('unit', ['Ambulans', 'Rescue'])
            ->orderBy('created_at', 'DESC')->get();
    } else {
        $datas =VaultVehicleReport::whereBetween('created_at', [$startDate, $endDate])
            ->whereIn('unit', ['Ambulans', 'Rescue'])->orderBy('created_at', 'DESC')->get();
    }
      }
      elseif(Auth::user()->operasional_id == 9){
        if ($startDate == null || $endDate == null) {
        $datas =VaultVehicleReport::whereIn('unit', 'security')
            ->orderBy('created_at', 'DESC')->get();
    } else {
        $datas =VaultVehicleReport::whereBetween('created_at', [$startDate, $endDate])
            ->whereIn('unit', 'security')->orderBy('created_at', 'DESC')->get();
    }
      }
      else{
        $datas =VaultVehicleReport::where('unit',$unit )->whereDate('created_at', $time->format('Y-m-d'))->orderBy('created_at', 'DESC') ->get();
      }
        
        // dd($datas);
        return view('pages.pelayanan-kendaraan-gangguan.index')->with('datas', $datas);
    }
    public function create(Request $request)
    {   $personil1 = $request->session()->get('personil1');
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

        $stationing = Stationing::all();
        $section = Section::all();
        $track = Track::all();
        $lane = Lane::all();
        $weather = Weather::all();
        $information = SourceInformation::all();
        $interference = Interference::all();
        $classVehicle = VehicleClass::all();
        $typeVehicle = VehicleType::all();
        $officer = Officer::all();
        $derek = Officer::where('operasional_id', 2)->get();
        return view('pages.pelayanan-kendaraan-gangguan.create')->with(compact('p1', 'p2','pAmbulan','pSecurity','pr', 'psn','ptis', 'pdk', 'stationing', 'section', 'track', 'lane', 'weather', 'information', 'interference', 'classVehicle', 'typeVehicle', 'officer', 'derek'));
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
            'wk' => 'required',
            'ws' => 'required',
            'wsi' => 'required',
            'jg' => 'required',
            'gk' => 'required',
            'jk' => 'required',
            'pnk' => 'required',
            'asal' => 'required',
            'tujuan' => 'required',
            'inlineRadioOptions' => 'required',
            'keterangan' => 'required',
            'dokumentasi' => 'required|array|size:2',
    
            // 'jk[]' => 'required',
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
            'wk.required' => 'Waktu kejadian wajib diisi',
            'ws.required' => 'Waktu sampai wajib diisi',
            'wsi.required' => 'Waktu selesai wajib diisi',
            'jg.required' => 'Jenis gangguan wajib diisi',
            'gk.required' => 'Penyebab kendaraan wajib diisi',
            'jk.required' => 'Jenis kendaraan wajib diisi',
            'pnk.required' => 'Plat nomor kendaraan wajib diisi',
            'asal.required' => 'Asal perjalanan wajib diisi',
            'tujuan.required' => 'Tujuan perjalanan wajib diisi',
            'inlineRadioOptions.required' => 'Penderekan wajib diisi',
            'keterangan.required' => 'Keterangan wajib diisi',
            'dokumentasi.required' => 'Dokumentasi wajib diisi',
            'dokumentasi.size' => 'Dokumentasi harus terdiri dari 2 gambar',
            ];
        $validator = Validator::make($request->all(), $validator, $customMessages);


        if ($validator->fails()) {
        
        return redirect()->back()->withErrors($validator)->withInput();
     }
       
        $no = VaultVehicleReport::all()->count();
        //upload Gambar
        $file = $request->file('dokumentasi');
        
        // $tujuan_upload = 'LPKG';
        // // dd($file->move($tujuan_upload, 'LPKG-' . sprintf($no + 1) . '.' . $file->getClientOriginalExtension()));
        // $file->move($tujuan_upload, 'LPKG-' . sprintf($no + 1) . '.' . $file->getClientOriginalExtension());
        $waktuKejadian = strtotime($request->tgl_kejadian . ' ' . $request->wk); // Mengubah ke format timestamp
        $waktuSampai = strtotime($request->tgl_kejadian . ' ' . $request->ws); // Mengubah ke format timestamp
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
        // dd($personilRescue);
        $data = new VaultVehicleReport();
        $data->stationing = $request->stasioning;
        $data->seksi = $request->seksi;
        $data->jalur = $request->jalur;
        $data->lajur = $request->lajur;
        $data->cuaca = $request->cuaca;
        $data->sumber_informasi = $request->sumber_informasi;
        $data->tanggal_kejadian = $request->tgl_kejadian;
        $data->waktu_kejadian = $request->wk;
        $data->waktu_sampai = $request->ws;
        $data->respon_time = $responTimeFormatted;
        $data->waktu_selesai = $request->wsi;
        $data->durasi_penanganan = $request->dp ?? '';
        $data->jenis_gangguan = $request->jg;
        $data->golongan_kendaraan = $request->gk;
        $data->jenis_kendaraan = $request->jk;
        $data->plat_nomor = $request->pnk;
        $data->asal_perjalanan = $request->asal;
        $data->tujuan_perjalanan = $request->tujuan;
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
        $data->personil3 = $request->personil3 ?? null;
        $data->penderekan = $request->inlineRadioOptions ?? '';
        $data->petugas_derek = $request->pd ?? 71;
        $data->unit_derek = $request->derek ?? '';
        $data->waktu_dibutuhkan = $request->widd ?? '';
        $data->waktu_sampai_tkp = $request->wdsl ?? '';
        $data->respon_time_derek = $request->rtd ?? '';
        $data->keterangan = $request->keterangan;   
        $data->dokumentasi = '';
        $data->unit = Auth::user()->nama;
        $current_interference = Interference::where('id', $request->jg)->first();
        $data->auto_text = 'Menangani kendaraan gangguan ' .$current_interference->nama.' dengan plat nomor ' .$request->pnk;
        
        $no_gambar =0;
        // dd($file);
      
        $mutasi = MonitoringTime::all();
        foreach($mutasi as $mutasi){
            // dd($request->wsi);
            if($mutasi->start_time<=$request->ws && $mutasi->end_time>=$request->ws )
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
                    $cekmutasi->keterangan = $cekmutasi->keterangan."; ".'Menangani kendaraan gangguan ' .$current_interference->nama.' dengan plat nomor ' .$request->pnk;;
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
                    // // $no_mutasi);
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
                     // dd($no_mutasi);
                    $addmutasi = new ActivityMutationServiceTol();
                    $addmutasi->unit = Auth::user()->operasional_id;
                    // dd($personilRescue!=null);
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
                    $addmutasi->keterangan = 'Menangani kendaraan gangguan ' .$current_interference->nama.' dengan plat nomor ' .$request->pnk;
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
                $data->save();
            }
           
        }
        foreach($file as $file){
            $tujuan_upload = 'LPKG';
            $file->move($tujuan_upload,'LPKG-Nomor Report-'.sprintf($data->id).'-'.$no_gambar.'.'.$file->getClientOriginalExtension());
            $imageVault = new ImageVault;
            $imageVault->id_report = $data->id;
            $imageVault->nama = 'LPKG-Nomor Report-'.sprintf($data->id).'-'.$no_gambar.'.'.$file->getClientOriginalExtension();
            $imageVault->save();
            // dd($imageVault);
            $no_gambar++;
        }
        
        Session::flash('message', Lang::get('Data Berhasil Masuk'));
        return redirect()
            ->route('pelayanan-kendaraan-gangguan.index')
            ->with(compact('responTimeFormatted'));
    }
    public function export(Request $request)
    {
        $ids = $request->input('ids');
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
        $pdf = Pdf::loadView('pdf.pelayanan-kendaraan-gangguan');

        return $pdf->stream('Pelayanan Kendaraan Gangguan' . '.pdf');
    }
    public function editKendaraanGangguan($id) {
        $datas = VaultVehicleReport::where('id', $id)->first();
        $p1 = Officer::where('id', $datas->personil1)->first();
        $p2 = Officer::where('id', $datas->personil2)->first();
        // $pa = Officer::where('id', $personilAmbulan)->first();
        // $ps = Officer::where('id', $personilSecurity)->first();

        $stationing = Stationing::all();
        $section = Section::all();
        $track = Track::all();
        $lane = Lane::all();
        $weather = Weather::all();
        $information = SourceInformation::all();
        $interference = Interference::all();
        $classVehicle = VehicleClass::all();
        $typeVehicle = VehicleType::all();
        $officer = Officer::all();
        // $image = ImageVault::where; 
        $derek = Officer::where('operasional_id', 2)->get();
        return view('pages.pelayanan-kendaraan-gangguan.edit')->with(compact('datas','p1', 'p2', 'stationing', 'section', 'track', 'lane', 'weather', 'information', 'interference', 'classVehicle', 'typeVehicle', 'officer', 'derek'));
    }
    public function updateKendaraanGangguan($id, Request $request){
       
        $validator = Validator::make($request->all(), [
            // 'dokumentasi' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            $validator->errors()->add('message', Lang::get('gagal'));
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
        // try {
        // $no = VaultVehicleReport::all()->count();
        //upload Gambar
        $file = $request->file('dokumentasi');
        $tujuan_upload = 'LPKG';
        $personil1 = $request->session()->get('personil1');
        $personil2 = $request->session()->get('personil2');
        $waktu_pantau = ActivityMutationServiceTol::where('waktu_pemantauan',1)->orderBy('no_mutasi', 'DESC')->first();
        $personilAmbulan = $request->session()->get('personil');
        $personilSecurity = $request->session()->get('personilSecurity');
        $personilRescue = $request->session()->get('personilRescue');
        $personilSenkom = $request->session()->get('personilSenkom');
        $personilTis = $request->session()->get('personilTis');
        $personilDerek = $request->session()->get('personilDerek');
        // dd($file);

        $waktuKejadian = strtotime($request->tgl_kejadian . ' ' . $request->wk); // Mengubah ke format timestamp
        $waktuSampai = strtotime($request->tgl_kejadian . ' ' . $request->ws); // Mengubah ke format timestamp
        $responTime = $waktuSampai - $waktuKejadian;
        // Mengonversi respon time ke dalam format jam:menit:detik
        $responTimeFormatted = gmdate('H:i', $responTime);

        $personil1 = $request->session()->get('personil1');
        $personil2 = $request->session()->get('personil2');
        $personilAmbulan = $request->session()->get('personil');
        $personilSecurity = $request->session()->get('personilSecurity');
        $data = VaultVehicleReport::find($id);
        // dd($data);
        //  dd($data->waktu_sampai);
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
                      
                        $startDate = now()->setTime(6, 30); // Today at 06:30 AM
                        $endDate = now()->addDay(1)->setTime(6, 30); // Tomorrow at 06:30 AM
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
        $data->stationing = $request->stasioning;
        $data->seksi = $request->seksi;
        $data->jalur = $request->jalur;
        $data->lajur = $request->lajur;
        $data->cuaca = $request->cuaca;
        $data->sumber_informasi = $request->sumber_informasi;
        $data->tanggal_kejadian = $request->tgl_kejadian;
        $data->waktu_kejadian = $request->wk;
        $data->waktu_sampai = $request->ws;
        $data->respon_time = $responTimeFormatted;
        $data->waktu_selesai = $request->wsi;
        $data->durasi_penanganan = $request->dp ?? '';
        $data->jenis_gangguan = $request->jg;
        $data->golongan_kendaraan = $request->gk;
        $data->jenis_kendaraan = $request->jk;
        $data->plat_nomor = $request->pnk;
        $data->asal_perjalanan = $request->asal;
        $data->tujuan_perjalanan = $request->tujuan;
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
        $data->petugas_derek = $request->pd ?? 71;
        $data->personil3 = $request->personil3 ?? null;
        $data->penderekan = $request->inlineRadioOptions ?? '';
        $data->unit_derek = $request->derek ?? '';
        $data->waktu_dibutuhkan = $request->widd ?? '';
        $data->waktu_sampai_tkp = $request->wdsl ?? '';
        $data->respon_time_derek = $request->rtd ?? '';
        $data->keterangan = $request->keterangan;
        $current_interference = Interference::where('id', $request->jg)->first();
        $data->auto_text = 'Menangani kendaraan gangguan ' .$current_interference->nama.' dengan plat nomor ' .$request->pnk;
        $no_gambar=0;
       
            $mutasi = MonitoringTime::all();
        foreach($mutasi as $mutasi){
            if($mutasi->start_time<=$request->ws && $mutasi->end_time>=$request->ws )
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
                    $cekmutasi->keterangan = $cekmutasi->keterangan."; ".'Menangani kendaraan gangguan ' .$current_interference->nama.' dengan plat nomor ' .$request->pnk;;
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
                    $addmutasi->keterangan = 'Menangani kendaraan gangguan ' .$current_interference->nama.' dengan plat nomor ' .$request->pnk;
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
                $data->save();
            }
           
        }
         if($file){
            $imageVault = ImageVault::where('id_report',$data->id)->get();
          foreach($imageVault as $imageVault){
                $tujuan_upload = 'LPKG';
                // $imageVault->id_report = $report->id;
                $file[$no_gambar]->move($tujuan_upload,'LPKG-Nomor Report-'.sprintf($id).'-'.sprintf($no_gambar+1).'.'.$file[$no_gambar]->getClientOriginalExtension());
                $imagePath = public_path($tujuan_upload . '/LPKG-Nomor Report-' . sprintf($id) .'-'.sprintf($no_gambar+1).'.' . $file[$no_gambar]->getClientOriginalExtension());
                $compressionQuality = 70;
                Image::make($imagePath)->save($imagePath, $compressionQuality);
                $imageVault->nama = 'LPKG-Nomor Report-' . sprintf($id). '-'.sprintf($no_gambar+1).'.' . $file[$no_gambar]->getClientOriginalExtension();
                // $file->move($tujuan_upload,'LPKG-Nomor Report-'.sprintf($id).'-'.$no_gambar.'.'.$file->getClientOriginalExtension());
                // $imageVault->nama = 'LPKG-Nomor Report-'.sprintf($id).'-'.$no_gambar.'.'.$file->getClientOriginalExtension();
                $imageVault->save();
                $no_gambar++;
            }
         
         }
        //  dd($imageVault);
       
        $data->save();
        Session::flash('message', Lang::get('Data Berhasil Diedit'));
        return redirect()
            ->route('pelayanan-kendaraan-gangguan.index')
            ->with(compact('responTimeFormatted'));
    }
    public function deletepkk($id)
    {
        // $data =  TrafficAccidentReport::where('id', $id)->first();
        ImageTrafficAccident::where('id_report',$id)->delete();
        TrafficAccidentReportVehicleClass::where('report_id',$id)->delete();
        TrafficAccidentReport::where('id', $id)->delete();
        
        Session::flash('message', Lang::get('Data Berhasil Dihapus'));
        return redirect()->route('pelayanan-kendaraan-kecelakaan.index');
    }
    public function deletepkg($id)
    {
        // $data =  TrafficAccidentReport::where('id', $id)->first();
        ImageVault::where('id_report', $id)->delete();
        VaultVehicleReport::where('id', $id)->delete();
        Session::flash('message', Lang::get('Data Berhasil Dihapus'));
        return redirect()->route('pelayanan-kendaraan-gangguan.index');
    }
}
