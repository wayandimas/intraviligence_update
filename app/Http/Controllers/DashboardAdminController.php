<?php

namespace App\Http\Controllers;

use App\Models\ActivityMutationServiceTol;
use App\Models\AmbulanceVehicleLog;
use App\Models\CategoryAccident;
use App\Models\CauseAccident;
use App\Models\Condition;
use App\Models\ImageVault;
use App\Models\DerekBesarVehicleLog;
use App\Models\DerekKecilVehicleLog;
use App\Models\HandoverTolInventoryLog;
use App\Models\ImageTrafficAccident;
use App\Models\Interference;
use App\Models\Lane;
use App\Models\LossAccident;
use App\Models\MedicalEquipmentLog;
use App\Models\MonitoringLocation;
use App\Models\MonitoringTime;
use App\Models\Officer;
use App\Models\OperationalControlServiceReport;
use App\Models\OutputMutation;
use App\Models\PatroliVehicleLog;
use App\Models\RescueVehicleLog;
use App\Models\Section;
use App\Models\SourceInformation;
use App\Models\Stationing;
use App\Models\Track;
use App\Models\TrafficAccidentReport;
use App\Models\TrafficAccidentReportVehicleClass;
use App\Models\TrafficAccidentVictim;
use App\Models\TypeAccident;
use App\Models\VaultVehicleReport;
use App\Models\VehicleClass;
use App\Models\VehicleType;
use App\Models\Weather;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Lang, Validator, Session, Auth;
use Intervention\Image\Facades\Image;


class DashboardAdminController extends Controller
{
    public function index()
    {

        return view('admin.page.dashboard-admin.index');
    }
    public function mutasiKegiatan(Request $request)
    {   
        $startDate = $request->input('start');
        $endDate = $request->input('end');
        $endDate = date('Y-m-d', strtotime($endDate . ' +1 day'));
        $koordPelayananTol = $request->session()->get('koordPelayananTol');
        // dd($startDate);
        if($startDate==null||$endDate==null){
            $datas = OutputMutation::orderBy('created_at', 'DESC') ->get();
            
            if($koordPelayananTol==7){
            $datas = OutputMutation::where(function ($query) {
            $query->where('no_mutation', 'LIKE', '801-%')
            ->orWhere('no_mutation', 'LIKE', '802-%')
            ->orWhere('no_mutation', 'LIKE', '803-%')
            ->orWhere('no_mutation', 'LIKE', 'Derek-%');
            })->orderBy('created_at', 'DESC')->get();
            };
            if($koordPelayananTol==8){
            $datas = OutputMutation::where(function ($query) {
            $query->where('no_mutation', 'LIKE', 'Ambulans-%')
            ->orWhere('no_mutation', 'LIKE', 'Rescue-%');
            })->orderBy('created_at', 'DESC')->get();
            };
            if($koordPelayananTol==9){
            $datas = OutputMutation::where(function ($query) {
            $query->where('no_mutation', 'LIKE', 'Gerbang%');
            })->orderBy('created_at', 'DESC') ->get();
            };
        }else{
            $datas = OutputMutation::WhereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'DESC') ->get();
            if($koordPelayananTol==7){
                $datas = OutputMutation::where(function ($query) use ($startDate, $endDate) {
                    $query->where('no_mutation', 'LIKE', '801-%')
                        ->orWhere('no_mutation', 'LIKE', '802-%')
                        ->orWhere('no_mutation', 'LIKE', '803-%')
                        ;
                })->WhereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'DESC') ->get();
            }
            if($koordPelayananTol==8){
                $datas = OutputMutation::where(function ($query) use ($startDate, $endDate) {
                    $query->where('no_mutation', 'LIKE', 'Ambulans-%')
            ->orWhere('no_mutation', 'LIKE', 'Rescue-%');
                        
                })->WhereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'DESC') ->get();
            }
            if($koordPelayananTol==9){
                $datas = OutputMutation::where(function ($query) use ($startDate, $endDate) {
                    $query->where('no_mutation', 'LIKE', 'Gerbang%');
                })->WhereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'DESC') ->get();
                //  dd($datas);
        }
       
        }
        // dd($koordPelayananTol);
         return view('admin.page.mutasi-kegiatan.index')->with('datas', $datas);
    }


    public function aktivitasHarian()
    {
        return view('admin.page.dashboard-admin.ashiap');
    }
    public function kendaraanGangguan(Request $request)
    {
        $startDate = $request->input('start');
        $endDate = $request->input('end');
        $endDate = date('Y-m-d', strtotime($endDate . ' +1 day'));
        if($startDate==null||$endDate==null){
            $datas = VaultVehicleReport::orderBy('created_at', 'DESC') ->get();
        }else{
            $datas = VaultVehicleReport::WhereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'DESC') ->get();
        }
        
        return view('admin.page.pelayanan-kendaraan-gangguan.index')->with('datas', $datas);
    }
    public function kendaraanKecelakaan(Request $request)
    {
        $startDate = $request->input('start');
        $endDate = $request->input('end');
        $endDate = date('Y-m-d', strtotime($endDate . ' +1 day'));
        if($startDate==null||$endDate==null){
            $datas = TrafficAccidentReport::orderBy('created_at', 'DESC') ->get();
        }else{
            $datas = TrafficAccidentReport::WhereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'DESC') ->get();
        }
       
        // dd($datas);
        return view('admin.page.pelayanan-kecelakaan-lalulintas.index')->with('datas', $datas);
    }
    public function detail($no_mutation)
    {
        // $out = OutputMutation::where('id',$id)->first();
        $datas = ActivityMutationServiceTol::where('no_mutasi', $no_mutation)->orderBy('id','ASC')->get();
        return view('admin.page.mutasi-kegiatan.detail')->with('datas', $datas);
    }
    public function export($id)
    {
        try{
            $data = OutputMutation::where('id', $id)
            ->first()
            ->toArray();
        } catch(\Exception $errors) {
            return redirect()->back()
            ->withInput()->withErrors(['message' => Lang::get('Data Not Found')]);
        }
        
            // dd($data);
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
           
            if($hour==6 && $minute >= 46 || $hour>6 && $hour<15 || $hour ==14 && $minute==30){
                $shift = 1;
            }
            if($hour==14 && $minute >= 31 || $hour>14 && $hour<23 || $hour ==22 && $minute==30){
                $shift=2;
            }
            if($hour==22 && $minute >= 31 || $hour>22 && $hour<24|| $hour<7 || $hour ==6 && $minute==45){
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
        return view('admin.page.mutasi-kegiatan.edit')->with(compact('p1', 'p2','times', 'locations', 'data'));
    }
    public function updateMutasi(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // 'keterangan' => 'required',
            'waktu_pemantauan'=> 'required',
            'lokasi_pemantauan'=> 'required'
        ]);
       
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
        if(Auth::user()->operasional_id==10){
            return redirect()->route('admin.mutasi.detail',$data->no_mutasi);
        }
        else{
            return redirect()->route('koordinator.mutasi.detail', $data->no_mutasi);
        }
    }
    public function deleteMutasi($id)
    {
    
        $data =  ActivityMutationServiceTol::where('id', $id)->first();
        $dataMutasi = $data->no_mutasi;
        ActivityMutationServiceTol::where('id', $id)->delete();
        
        Session::flash('message', Lang::get('Data Berhasil Dihapus'));
        return redirect()->route('admin.mutasi.detail',$dataMutasi);
    }
    
    public function editKendaraanGangguan($id) 
    {
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
        $derek = Officer::where('operasional_id', 2)->get();
        return view('admin.page.pelayanan-kendaraan-gangguan.edit')->with(compact('datas','p1', 'p2', 'stationing', 'section', 'track', 'lane', 'weather', 'information', 'interference', 'classVehicle', 'typeVehicle', 'officer', 'derek'));
    }
    public function updateKendaraanGangguan($id, Request $request)
    {
       
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
        $data = VaultVehicleReport::find($id);
        // dd($data);
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
        // if ($personil1 != null && $personil2 != null) {
        //     $data->personil1 = $personil1;
        //     $data->personil2 = $personil2;
        // } elseif ($personilAmbulan != null) {
        //     $data->personil1 = $personilAmbulan;
        //     $data->personil2 = $personilAmbulan;
        // } elseif ($personilSecurity != null) {
        //     $data->personil1 = $personilSecurity;
        //     $data->personil2 = $personilSecurity;
        // }
        $data->petugas_derek = $request->pd ?? 71;
        $data->personil3 = $request->personil3 ?? null;
        $data->penderekan = $request->inlineRadioOptions ?? '';
        $data->unit_derek = $request->derek ?? '';
        $data->waktu_dibutuhkan = $request->widd ?? '';
        $data->waktu_sampai_tkp = $request->wdsl ?? '';
        $data->respon_time_derek = $request->rtd ?? '';
        $data->keterangan = $request->keterangan;
        $data->save();
        $no_gambar=0;
        // dd($file);
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
       
      
        Session::flash('message', Lang::get('Edit Data Berhasil'));
        return redirect()
            ->route('admin.pelayanan-kendaraan-gangguan')
            ->with(compact('responTimeFormatted'));
    }
    public function deletepkk($id)
    {
        $data =  TrafficAccidentReport::find($id);
        // dd($data);
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
        ImageTrafficAccident::where('id_report',$id)->delete();
        TrafficAccidentVictim::where('report_id',$id)->delete();
        TrafficAccidentReportVehicleClass::where('report_id',$id)->delete();
        TrafficAccidentReport::where('id', $id)->delete();
        
        Session::flash('message', Lang::get('Data Berhasil Dihapus'));
        return redirect()->route('admin.pelayanan-kendaraan-kecelakaan');
    }
    public function deletepkg($id)
    {
        $data =  VaultVehicleReport::where('id', $id)->first();
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
        ImageVault::where('id_report', $id)->delete();
        VaultVehicleReport::where('id', $id)->delete();
       
        
        Session::flash('message', Lang::get('Data Berhasil Dihapus'));
        return redirect()->route('admin.pelayanan-kendaraan-gangguan');
    }
    public function editpkk($id)
    {
        try {
            $datas = TrafficAccidentReport::where('id', $id)->first();
            // $personil1 = $request->session()->get('personil1');
            // $personil2 = $request->session()->get('personil2');
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
            $pDerek= Officer::whereIn('operasional_id', [4,7, 6])
            ->orderByRaw("FIELD(operasional_id, 2, 7, 6)")
            ->get();
            $pAnother= Officer::whereIn('operasional_id', [5, 11 ,7, 8, 9, 10,  6])
            ->orderByRaw("FIELD(operasional_id, 5, 11, 7, 8, 9, 10, 6)")
            ->get();
            // dd($patroli);
        } catch (\Throwable $th) {
            return redirect()->back()
            ->withInput()->withErrors(['message' => Lang::get('web.data-not-found')]);
        }
       
        return view('admin.page.pelayanan-kecelakaan-lalulintas.edit')->with(compact('datas','stationing','section','track','lane','weather','information','interference','classVehicle','typeVehicle', 'officer', 'typeAccident', 'causeAccident', 'categoryAccident', 'lossAccident','pAmbulan','pRescue','pAnother','pDerek', 'patroli'));
    }
    public function updatepkk(Request $request, $id)
    {
        // $no = TrafficAccidentReport::all()->count();
        
        //upload Gambar
        $file = $request->file('dokumentasi');
        
        //respond time
        $waktuKejadian = strtotime($request->tgl_kejadian . ' ' . $request->wk); // Mengubah ke format timestamp
        $waktuSampai = strtotime($request->tgl_kejadian . ' ' . $request->ws); // Mengubah ke format timestamp
        $responTime = $waktuSampai - $waktuKejadian;
        // Mengonversi respon time ke dalam format jam:menit:detik
        $responTimeFormatted = gmdate('H:i', $responTime);

        $personil1 = $request->session()->get('personil1');
        $personil2 = $request->session()->get('personil2');
        // Buat data baru dalam model TrafficAccidentReport
        $report = TrafficAccidentReport::where('id', $id)->first();
        $report->stationing = $request->stasioning;
        $report->seksi = $request->seksi;
        $report->jalur = $request->jalur;
        $report->lajur = $request->lajur;
        $report->cuaca = $request->cuaca;
        $report->sumber_informasi = $request->sumber_informasi;
        $report->tanggal_kejadian = $request->tgl_kejadian;
        $report->waktu_kejadian = $request->wk;
        $report->waktu_sampai = $request->ws;
        $report->respon_time = $responTimeFormatted;
        $report->waktu_selesai = $request->wsi;
        $report->durasi_penanganan = $request->dp;
        $report->jenis_kecelakaan = $request->jk;
        $report->penyebab_kecelakaan = $request->pk;
        $report->kategori_kecelakaan = $request->kk;
        $report->kerugian_kecelakaan = $request->kek;
        $report->kerugian_tol = $request->kat;
        $report->asal_perjalanan =  $request->asal;
        $report->tujuan_perjalanan =  $request->tujuan;
        $report->personil1 =$personil1;
        $report->personil2 =$personil2;
        $report->petugas_lainnya = $request->petugasLain ;
        $report->personil_rescue = $request->petugasRescue ;
        $report->personil_ambulan = $request->petugasAmbulan ;
        $report->petugas_derek = $request->pd ??6;
        $report->unit_derek = $request->derek??'';
        $report->waktu_dibutuhkan = $request->widd??'';
        $report->waktu_sampai_tkp = $request->wdsl??'';
        $report->respon_time_derek = $request->rtd??'';
        $report->dokumentasi = '';
        $no_gambar = 1;
        
        $report->keterangan = $request->keterangan;
        $report->save(); 
        foreach($file as $file){
            $tujuan_upload = 'LKLL';
            $file->move($tujuan_upload,'LKLL-Nomor Report-'.sprintf($id).'-'.$no_gambar.'.'.$file->getClientOriginalExtension());
            $imageAccident = ImageTrafficAccident::where('id_report', $id)->get();
            // $imageAccident->id_report = $report->id;
            foreach($imageAccident as $imageAccident){
                $imageAccident->nama = 'LKLL-Nomor Report-'.sprintf($id).'-'.$no_gambar.'.'.$file->getClientOriginalExtension();
                $imageAccident->save();
                $no_gambar++;
            }
           
        }
        //Detail kecelakaan
        $i=0;
        foreach($request->gk as $gk){
        $detailclass = TrafficAccidentReportVehicleClass::where('report_id', $id)->get();
        // $detailclass->report_id = $report->id;
        foreach($detailclass as $detailclass){
            $detailclass->vehicle_class_id = $gk;
            $detailclass->nopol = $request->nnk[$i];
            $detailclass->save(); 
            $i++;
        }
       
        }
        Session::flash('message', Lang::get('Data Berhasil Diedit'));
        return redirect()->route('admin.pelayanan-kecelakaan-lalu-lintas.index');
    }
    public function lapanenam()

    {    
    
        return view('admin.page.dashboard-admin.lapenam');
    }
    public function ceklisKendaraan(Request $request)

    {
        $judul = 'LAPENAM';
        $startDate = $request->input('start');
        $endDate = $request->input('end');
        $endDate = date('Y-m-d', strtotime($endDate . ' +1 day'));

        if($startDate == null||$endDate==null){
            $datas = PatroliVehicleLog::where('shift',1)->orderBy('created_at', 'DESC') ->get();
            $datasRescue = RescueVehicleLog::where('shift',1)->orderBy('created_at', 'DESC') ->get();
            $datasAmbulan = AmbulanceVehicleLog::where('shift',1)->orderBy('created_at', 'DESC') ->get();
            $datasMedical = MedicalEquipmentLog::where('shift',1)->orderBy('created_at', 'DESC') ->get();
            $datasDerekKecil = DerekKecilVehicleLog::where('shift',1)->orderBy('created_at', 'DESC') ->get();
            $datasDerekBesar = DerekBesarVehicleLog::where('shift',1)->orderBy('created_at', 'DESC') ->get();
            $datasSecurity = HandoverTolInventoryLog::where('shift',1)->orderBy('created_at', 'DESC') ->get();
          
            
        }

        
        else{
            $datas = PatroliVehicleLog::where('shift',1)->WhereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'DESC') ->get(); 
            $datasRescue = RescueVehicleLog::where('shift',1)->WhereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'DESC') ->get();
            $datasAmbulan = AmbulanceVehicleLog::where('shift',1)->WhereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'DESC') ->get();
            $datasMedical = MedicalEquipmentLog::where('shift',1)->WhereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'DESC') ->get();  
            $datasDerekKecil = DerekKecilVehicleLog::where('shift',1)->WhereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'DESC') ->get();  
            $datasDerekBesar = DerekBesarVehicleLog::where('shift',1)->WhereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'DESC') ->get();  
            $datasSecurity = HandoverTolInventoryLog::where('shift',1)->WhereBetween('created_at', [$startDate, $endDate])->orderBy('created_at', 'DESC') ->get();  
          
            
        }
  
    
    
        return view('admin.page.lapanenam.ceklis')->with(compact('datas', 'datasRescue', 'datasAmbulan', 'datasMedical', 'datasDerekKecil', 'datasDerekBesar', 'datasSecurity','judul'));
    }
    public function ceklisKendaraanDetail($unit)

    {  
        $judul = 'LAPENAM';
        $datas = [];
        $datasRescue = [];
        $datasAmbulan = [];
        $datasMedical = [];
        $datasDerekBesar = [];
        $datasDerekKecil = [];
        $datasSecurity = [];
                $time = Carbon::now();
            if ($time->hour < 6 || ($time->hour == 6 && $time->minute < 45)) {
                // Jika waktu saat ini sebelum jam 6:30, ambil tanggal kemarin
                $tanggal = $time->subDay()->toDateString();
            } else {
                // Jika waktu saat ini setelah atau pada jam 6:30, ambil tanggal hari ini
                $tanggal = $time->toDateString();
            }

            $cek = PatroliVehicleLog::where('unit', $unit)
            ->first();

            $cekRescue = RescueVehicleLog::where('unit', $unit)
                ->first();

            $cekAmbulan = AmbulanceVehicleLog::where('unit', $unit)
                ->first();

            $cekMedical = MedicalEquipmentLog::where('unit', $unit)
                ->first();

            $cekDerekKecil = DerekKecilVehicleLog::where('unit', $unit)
                ->first();

            $cekDerekBesar = DerekBesarVehicleLog::where('unit', $unit)
                ->first();

            $cekSecurity = HandOverTolInventoryLog::where('unit', $unit)
                ->first();
       if ($cek != null) {
            $datas = PatroliVehicleLog::where('unit', $cek->unit)
                 // Filter by the creation date of $cek
                ->orderby('id', 'asc')
                ->get();
        }
            if ($cekAmbulan != null) {
                $datasAmbulan = AmbulanceVehicleLog::where('unit', $cekAmbulan->unit)
                    // Filter by the creation date of $cekAmbulan
                    ->orderby('id', 'asc')
                    ->get();
            }
            // dd($datasAmbulan);
            if ($cekMedical != null) {
                $datasMedical = MedicalEquipmentLog::where('unit', $cekMedical->unit)
                  // Filter by the creation date of $cekAmbulan
                    ->orderby('id', 'asc')
                    ->get();
            }

            if ($cekRescue != null) {
                $datasRescue = RescueVehicleLog::where('unit', $cekRescue->unit)
                     // Filter by the creation date of $cekRescue
                    ->orderby('id', 'asc')
                    ->get();
                 
            }


            // Add similar filters for other data types

            if ($cekDerekBesar != null) {
                $datasDerekBesar = DerekBesarVehicleLog::where('unit', $cekDerekBesar->unit)
                     // Filter by the creation date of $cekDerekBesar
                    ->orderby('id', 'asc')
                    ->get();
            }

            if ($cekDerekKecil != null) {
                $datasDerekKecil = DerekKecilVehicleLog::where('unit', $cekDerekKecil->unit)
                     // Filter by the creation date of $cekDerekKecil
                    ->orderby('id', 'asc')
                    ->get();
            }

            if ($cekSecurity != null) {
                $datasSecurity = HandOverTolInventoryLog::where('unit', $cekSecurity->unit)
                   // Filter by the creation date of $cekSecurity
                    ->orderby('id', 'asc')
                    ->get();
            }
        // dd($datasAmbulan);
        return view('admin.page.lapanenam.ceklisDetail')->with(compact('datasRescue', 'datas', 'datasAmbulan', 'datasMedical', 'datasDerekKecil', 'datasDerekBesar', 'datasSecurity','judul'));
    }
    public function ceklisKendaraanDelete($id)

    {    // Mendapatkan tanggal hari ini
        PatroliVehicleLog::where('id',$id)->delete();
        Session::flash('message', Lang::get('Data Berhasil Dihapus'));
        if(Auth::user()->operasional_id==7){
            return redirect()->route('koordinator.lapenam.ceklis');
        }
        else
        return redirect()->route('admin.lapenam.ceklis');
    }
    public function ceklisKendaraanAmbulanDelete($id)

    {    // Mendapatkan tanggal hari ini
        // dd($id);
        AmbulanceVehicleLog::where('id',$id)->delete();
        Session::flash('message', Lang::get('Data Berhasil Dihapus'));
          if(Auth::user()->operasional_id==8){
            return redirect()->route('koordinator.lapenam.ceklis');
        }   
        return redirect()->route('admin.lapenam.ceklis');
    }
    public function ceklisKendaraanDerekKecilDelete($id)

    {    // Mendapatkan tanggal hari ini
        DerekKecilVehicleLog::where('id',$id)->delete();
        Session::flash('message', Lang::get('Data Berhasil Dihapus'));
          if(Auth::user()->operasional_id==7){
            return redirect()->route('koordinator.lapenam.ceklis');
        }
        else
        return redirect()->route('admin.lapenam.ceklis');
    }
    public function ceklisKendaraanDerekBesarDelete($id)

    {    // Mendapatkan tanggal hari ini
        DerekBesarVehicleLog::where('id',$id)->delete();
        Session::flash('message', Lang::get('Data Berhasil Dihapus'));
          if(Auth::user()->operasional_id==7){
            return redirect()->route('koordinator.lapenam.ceklis');
        }
        else
        return redirect()->route('admin.lapenam.ceklis');
    }
    public function ceklisMedicalDelete($id)

    {    // Mendapatkan tanggal hari ini
        MedicalEquipmentLog::where('id',$id)->delete();
        Session::flash('message', Lang::get('Data Berhasil Dihapus'));
          if(Auth::user()->operasional_id==8){
            return redirect()->route('koordinator.lapenam.ceklis');
        }
        else
        return redirect()->route('admin.lapenam.ceklis');
    }
    public function serahTerimaDelete($id)

    {    // Mendapatkan tanggal hari ini
        HandoverTolInventoryLog::where('id',$id)->delete();
        Session::flash('message', Lang::get('Data Berhasil Dihapus'));
          if(Auth::user()->operasional_id==9){
            return redirect()->route('koordinator.lapenam.ceklis');
        }
        else
        return redirect()->route('admin.lapenam.ceklis');
    }
    public function ceklisRescueDelete($id)

    {    // Mendapatkan tanggal hari ini
        RescueVehicleLog::where('id',$id)->delete();
        Session::flash('message', Lang::get('Data Berhasil Dihapus'));
          if(Auth::user()->operasional_id==8){
            return redirect()->route('koordinator.lapenam.ceklis');
        }
        else
        return redirect()->route('admin.lapenam.ceklis');
    }
    public function exportPkg(Request $request)
    {
        $ids = $request->input('id');
        try {
            $data = VaultVehicleReport::whereIn('id', $ids)->with('image')
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
        $pdf = Pdf::loadView('pdf.pelayanan-kendaraan-gangguan', compact('data'));

        return $pdf->stream('Pelayanan Kendaraan Gangguan' . '.pdf');
    }
    public function exportPpo(Request $request)
    {
        $ids = $request->input('id');
        try {
            $data = OperationalControlServiceReport::whereIn('id', $ids)->with('image')
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
        $pdf = Pdf::loadView('pdf.pelayanan-pengendalian-operasional', compact('data'));

        return $pdf->stream('Laporan Pelayanan Pengendalian Operasional' . '.pdf');
    }

}
