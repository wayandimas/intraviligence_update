<?php

namespace App\Http\Controllers;

use App\Exports\PerbaikanKerusakanDanPerawatanKendaraanExport;
use App\Http\Controllers\Controller;
use App\Models\ActivityMutationServiceTol;
use App\Models\MaintenanceReport;
use App\Models\MaintenanceType;
use App\Models\MaintenanceUnit;
use App\Models\Officer;
use App\Models\RepairWorkshop;
use Auth;
use Excel;
use Illuminate\Http\Request;
use Lang;
use Session;
use Validator;

class MonitoringPerawatanKendaraanController extends Controller
{
    public function index(){
        if(Auth::user()->operasional_id==10){
        $datas = MaintenanceReport::orderby('id', 'desc')->get();
        $judul = 'LAPENAM';
        return view('pages.lapanenam.perbaikan-kerusakan-dan-perawatan')->with('datas',$datas)->with('judul',$judul);
        }else{
            $datas = MaintenanceReport::where('unit',Auth::user()->nama)->orderby('id', 'desc')->get();
            $judul = 'LAPENAM';
        return view('pages.lapanenam.perbaikan-kerusakan-dan-perawatan')->with('datas',$datas)->with('judul',$judul);
        }
    }
    public function create(Request $request)

    {    // Mendapatkan tanggal hari ini
        $tanggal_today= date('Y-m-d',);
        $personil1 = $request->session()->get('personil1');
        $personil2 = $request->session()->get('personil2');
        $personilAmbulan = $request->session()->get('personil');
        $personilSecurity = $request->session()->get('personilSecurity');
        $personilRescue = $request->session()->get('personilRescue');
     
        $p1= Officer::where('id', $personil1)->first();
        $p2= Officer::where('id', $personil2)->first();
        $pa= Officer::where('id', $personilAmbulan)->first();
        $ps= Officer::where('id', $personilSecurity)->first();
        $pr= Officer::where('id', $personilRescue)->first();
        $petugas =  Officer::whereIn('operasional_id', [1, 2, 3, 4, 7, 8 ,10])
                ->orderByRaw("FIELD(operasional_id, 1, 2, 3, 4, 7, 8, 10)")
                ->get();
        $unitPerawatan = MaintenanceUnit::all();
        $jenisPerawatan = MaintenanceType::all();
        $bengkel = RepairWorkshop::all();
        
         if($p1!=null && $p2!=null){
            $total= ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id,)
                ->where('personil1', $personil1)
                ->where('personil2', $personil2)
                ->whereDate('created_at',$tanggal_today)->count();
        }
        else if($pa!=null){
            $total= ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id,)
                ->where('personil1', $pa)
                ->where('personil2', $pa)
                ->whereDate('created_at',$tanggal_today)->count();
        }
        else if($ps!=null){
                 $total= ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id,)
                ->where('personil1', $ps)
                ->where('personil2', $ps)
                ->whereDate('created_at',$tanggal_today)->count();
        }
    
        else if($pr!=null){
                 $total= ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id,)
                ->where('personil1', $pr)
                ->where('personil2', $pr)
                ->whereDate('created_at',$tanggal_today)->count();
        }
        // dd($p1,$p2);
        return view("pages.monitoring-perawatan-kendaraan.index")->with(compact('p1','p2','pr','total','unitPerawatan', 'jenisPerawatan', 'bengkel', 'petugas'));
    }
    public function edit(Request $request, $id)

    {    // Mendapatkan tanggal hari ini
        $datas = MaintenanceReport::where('id', $id)->first();
        $tanggal_today= date('Y-m-d',);
        $personil1 = $request->session()->get('personil1');
        $personil2 = $request->session()->get('personil2');
        $personilAmbulan = $request->session()->get('personil');
        $personilSecurity = $request->session()->get('personilSecurity');
     
        $p1= Officer::where('id', $personil1)->first();
        $p2= Officer::where('id', $personil2)->first();
        $pa= Officer::where('id', $personilAmbulan)->first();
        $ps= Officer::where('id', $personilSecurity)->first();
        $petugas =  Officer::whereIn('operasional_id', [1, 2, 3, 4, 7, 8 ,10])
                ->orderByRaw("FIELD(operasional_id, 1, 2, 3, 4, 7, 8, 10)")
                ->get();
        $unitPerawatan = MaintenanceUnit::all();
        $jenisPerawatan = MaintenanceType::all();
        $bengkel = RepairWorkshop::all();
        if(Auth::user()->operasional_id==10){
            return view("pages.monitoring-perawatan-kendaraan.edit")->with(compact('datas','p1','p2','unitPerawatan', 'jenisPerawatan', 'bengkel', 'petugas'));
        }
        else{
               if($p1!=null && $p2!=null){
            $total= ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id,)
                ->where('personil1', $personil1)
                ->where('personil2', $personil2)
                ->whereDate('created_at',$tanggal_today)->count();
            }
            else if($pa!=null){
                $total= ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id,)
                    ->where('personil1', $pa)
                    ->where('personil2', $pa)
                    ->whereDate('created_at',$tanggal_today)->count();
            }
            else if($ps!=null){
                    $total= ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id,)
                    ->where('personil1', $ps)
                    ->where('personil2', $ps)
                    ->whereDate('created_at',$tanggal_today)->count();
            }
            return view("pages.monitoring-perawatan-kendaraan.edit")->with(compact('datas','total','p1','p2','unitPerawatan', 'jenisPerawatan', 'bengkel', 'petugas'));
        }   
    }
    public function update(Request $request, $id)
    {
        $no = MaintenanceReport::all()->count();
      
        $report = MaintenanceReport::where('id', $id)->first();
        // $report->unit = Auth::user()->nama;
        $report->unit_perawatan = $request->unit_perawatan;
        $report->tanggal_perawatan = $request->tgl_perawatan;
        $report->odo_meter = $request->odo_meter;
        $report->jenis_perawatan = $request->jenis_perawatan;
        $report->bengkel = $request->bengkel;
        $report->keterangan = $request->keterangan;
        $report->personil1 = $request->personil1;
        $report->personil2 = $request->personil2;
        $file = $request->file('foto');
        //  dd($file);
        if($file==null){
            $report->save();
        }
        else{
        $report->foto_odo_meter = 'LPKPK-'.sprintf($id).'.'.$file->getClientOriginalExtension();
        $tujuan_upload = 'LPKPK';
        $file->move($tujuan_upload,'LPKPK-'.sprintf($id).'.'.$file->getClientOriginalExtension());
        $report->save();
        }
        if(Auth::user()->operasional_id==10){
            Session::flash('message', Lang::get('Data Berhasil Diedit'));
            return redirect()->route('admin.lapenam.perawatan-kendaraan.index');
        }
        else{
            Session::flash('message', Lang::get('Data Berhasil Diedit'));
            return redirect()->route('lapenam.perawatan-kendaraan.index');
        }
    }
    public function store(Request $request)
    {
          $validator = [
            'unit_perawatan' => 'required',
            'tgl_perawatan' => 'required',
            'odo_meter' => 'required',
            'jenis_perawatan' => 'required',
            'bengkel' => 'required',
            'keterangan' => 'required',
            'foto' => 'required',
    
            // 'jk[]' => 'required',
            // 'nnk[]' => 'required'

            ];
            $customMessages = [
            'unit_perawatan.required' => 'Unit perawatan wajib diisi', 
            'tgl_perawatan.required' => 'Tanggal perawatan wajib diisi',
            'odo_meter.required' => 'Odo meter wajib diisi',
            'jenis_perawatan.required' => 'Jenis perawatan wajib diisi',
            'bengkel.required' => 'Bengkel wajib diisi',
            'keterangan.required' => 'Keterangan wajib diisi',
            'foto.required' => 'Foto odometer pengisian wajib diisi',
            ];
        $validator = Validator::make($request->all(), $validator, $customMessages);


        if ($validator->fails()) {
        
        return redirect()->back()->withErrors($validator)->withInput();
     }
        $no = MaintenanceReport::all()->count();
        // $personil1 = $request->session()->get('personil1');
        // $personil2 = $request->session()->get('personil2');
        $report = new MaintenanceReport;
        $report->unit = Auth::user()->nama;
        $report->unit_perawatan = $request->unit_perawatan;
        $report->tanggal_perawatan = $request->tgl_perawatan;
        $report->odo_meter = $request->odo_meter;
        $report->jenis_perawatan = $request->jenis_perawatan;
        $report->bengkel = $request->bengkel;
        $report->keterangan = $request->keterangan;
        $report->personil1 = $request->personil1;
        $report->personil2 = $request->personil2;
        $file = $request->file('foto');
        //  dd($file);
        $report->foto_odo_meter = 'LPKPK-'.sprintf($no+1).'.'.$file->getClientOriginalExtension();
        $tujuan_upload = 'LPKPK';
        $file->move($tujuan_upload,'LPKPK-'.sprintf($no+1).'.'.$file->getClientOriginalExtension());
        $report->save();
        Session::flash('message', Lang::get('Terima Kasih, Telah Mengisi Form Pelayanan Kendaraan Gangguan ! Selamat Bertugas Kembali ! Tetap Utamakan Keselamatan !'));
        return redirect()->route('lapenam.perawatan-kendaraan.index');
    }
    public function Delete($id)

    {    // Mendapatkan tanggal hari ini
        MaintenanceReport::where('id',$id)->delete();
        if(Auth::user()->operasional_id == 10){
            Session::flash('message', Lang::get('Data Berhasil Dihapus'));
        return redirect()->route('admin.lapenam.perawatan-kendaraan.index');
        }else{
            Session::flash('message', Lang::get('Data Berhasil Dihapus'));
        return redirect()->route('lapenam.perawatan-kendaraan.index');
        }
        
    }
        public function exportAll(){
        $perawatan= MaintenanceReport::all();
        // dd($perawatan);
        return Excel::Download(new PerbaikanKerusakanDanPerawatanKendaraanExport($perawatan), 'Perbaikan Kerusakan dan Perawatan Kendaraan - '. date("d-m-Y") .'.xlsx');
    }
}
    
