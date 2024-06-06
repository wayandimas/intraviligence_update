<?php

namespace App\Http\Controllers;

use App\Exports\PengisianBahanBakarExport;
use App\Http\Controllers\Controller;
use App\Models\ActivityMutationServiceTol;
use App\Models\MaintenanceReport;
use App\Models\MaintenanceType;
use App\Models\MaintenanceUnit;
use App\Models\Officer;
use App\Models\RefuelingReport;
use App\Models\RepairWorkshop;
use Auth;
use Illuminate\Http\Request;
use Lang;
use Session;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class PengisianBahanBakarController extends Controller
{
    public function create(Request $request)

    {   
        $tanggal_today= date('Y-m-d',);
        $personil1 = $request->session()->get('personil1');
        $personil2 = $request->session()->get('personil2');
        $personilAmbulan = $request->session()->get('personil');
        $personilSecurity = $request->session()->get('personilSecurity');
        $personilRescue = $request->session()->get('personilRescue');
        $personilSenkom = $request->session()->get('personilSenkom');
        $personilTis = $request->session()->get('personilTis');
        $personilDerek = $request->session()->get('personilDerek');
     
        $p1= Officer::where('id', $personil1)->first();
        $p2= Officer::where('id', $personil2)->first();
        $pa= Officer::where('id', $personilAmbulan)->first();
        $ps= Officer::where('id', $personilSecurity)->first();
        $pr= Officer::where('id', $personilRescue)->first();
        $psn= Officer::where('id', $personilSenkom)->first();
        $ptis= Officer::where('id', $personilTis)->first();
        $pdk= Officer::where('id', $personilDerek)->first();
        $petugas =  Officer::whereIn('operasional_id', [1, 2, 3, 4, 7, 8 ,10])
                ->orderByRaw("FIELD(operasional_id, 1, 2, 3, 4, 7, 8, 10)")
                ->get();
        $unitPengisian = MaintenanceUnit::whereNotIn('id',[1,9,10,11])->get();  
        $jenisPengisian = MaintenanceType::all();
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
        else if($psn!=null ){
                 $total= ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id,)
                ->where('personil1', $psn)
                ->where('personil2', $ptis)
                ->whereDate('created_at',$tanggal_today)->count();
        }
        else if($pdk!=null ){
                 $total= ActivityMutationServiceTol::where('unit', Auth::user()->operasional_id,)
                ->where('personil1', $pdk)
                ->where('personil2', $pdk)
                ->whereDate('created_at',$tanggal_today)->count();
        }
        return view("pages.pengisian-bahan-bakar.index")->with(compact('pdk','p1','p2','psn','ptis','pa' ,'pr','total','unitPengisian', 'jenisPengisian', 'bengkel', 'petugas'));
         
    }
    public function edit(Request $request, $id)

    {    // Mendapatkan tanggal hari ini
        $datas = RefuelingReport::where('id',$id)->first();
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
        $unitPengisian = MaintenanceUnit::whereNotIn('id',[1,9,10,11])->get();  
        $jenisPengisian = MaintenanceType::all();
        $bengkel = RepairWorkshop::all();
        
         if(Auth::user()->operasional_id==10){
            return view("pages.pengisian-bahan-bakar.edit")->with(compact('datas','p1','p2','unitPengisian', 'jenisPengisian', 'bengkel', 'petugas'));
         }else{
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
        
            return view("pages.pengisian-bahan-bakar.edit")->with(compact('datas','p1','p2','total','unitPengisian', 'jenisPengisian', 'bengkel', 'petugas'));
         }
    }
    public function store(Request $request)
    {
         $validator = [
            'unit_pengisian' => 'required',
            'tgl_pengisian' => 'required',
            'waktu_pengisian' => 'required',
            'odo_meter' => 'required',
            'jmlh_pengisian' => 'required',
            'kembalian' => 'required',
            'dokumentasi' => 'required',
    
            // 'jk[]' => 'required',
            // 'nnk[]' => 'required'

            ];
            $customMessages = [
            'unit_pengisian.required' => 'Unit pengisian wajib diisi', 
            'tgl_pengisian.required' => 'Tanggal pengisian wajib diisi',
            'waktu_pengisian.required' => 'Waktu pengisian wajib diisi',
            'odo_meter.required' => 'Odo meter wajib diisi',
            'jmlh_pengisian.required' => 'Jumlah pengisian wajib diisi',
            'kembalian.required' => 'Kembalian wajib diisi',
            'dokumentasi.required' => 'Foto struk pengisian wajib diisi',
            ];
        $validator = Validator::make($request->all(), $validator, $customMessages);


        if ($validator->fails()) {
        
        return redirect()->back()->withErrors($validator)->withInput();
     }
        $no = RefuelingReport::all()->count();
        $personil1 = $request->session()->get('personil1');
        $personil2 = $request->session()->get('personil2');
        $personilAmbulan = $request->session()->get('personil');
        $personilSecurity = $request->session()->get('personilSecurity');
        $personilRescue = $request->session()->get('personilRescue');
        $personilSenkom = $request->session()->get('personilSenkom');
        $personilTis = $request->session()->get('personilTis');
        $personilDerek = $request->session()->get('personilDerek');
        $report = new RefuelingReport;
        $report->unit = Auth::user()->nama;
        $report->unit_pengisian = $request->unit_pengisian;
        $report->tanggal_pengisian = $request->tgl_pengisian;
        $report->waktu_pengisian = $request->waktu_pengisian;
        $report->odo_meter = $request->odo_meter;
        $report->jumlah_pengisian = $request->jmlh_pengisian;
       if($personil1!=null && $personil2!=null){
            $report->personil1 =  $personil1;
            $report->personil2 =  $personil2;
        }
        else if($personilAmbulan!=null){
            $report->personil1 =  $personilAmbulan;
            $report->personil2 =  $personilAmbulan;
        }
        else if($personilSecurity!=null){
            $report->personil1 =  $personilSecurity;
            $report->personil2 =  $personilSecurity;
        }
        else if($personilRescue!=null){
            $report->personil1 =  $personilRescue;
            $report->personil2 =  $personilRescue;
        }
        else if($personilSenkom!=null&&$personilTis!=null){
            $report->personil1 =  $personilSenkom;
            $report->personil2 =  $personilTis;
        }
        else if($personilDerek!=null){
            $report->personil1 =  $personilDerek;
            $report->personil2 =  $personilDerek;
        }
       
        $report->kembalian = $request->kembalian_numeric;
        $file = $request->file('dokumentasi');
            // dd($file);
        if($request->hasFile('dokumentasi')){
            
            $report->foto_struk = 'LPBBM-'.sprintf($no+1).'.'.$file->getClientOriginalExtension();
            $tujuan_upload = 'LPBBM';
            $file->move($tujuan_upload,'LPBBM-'.sprintf($no+1).'.'.$file->getClientOriginalExtension());
        }

   
        $report->save();

        Session::flash('message', Lang::get('Terima Kasih, Telah Mengisi Form Pengisian BBM ! Selamat Bertugas Kembali ! Tetap Utamakan Keselamatan !'));
        return redirect()->route('lapenam.pengisian-bbm.index');
    }
    public function update(Request $request, $id)
    {
        $no = RefuelingReport::all()->count();
      
        $report = RefuelingReport::where('id',$id)->first();
        // $report->unit = Auth::user()->nama;
        $report->unit_pengisian = $request->unit_pengisian;
        $report->tanggal_pengisian = $request->tgl_pengisian;
        $report->waktu_pengisian = $request->waktu_pengisian;
        $report->odo_meter = $request->odo_meter;
        $report->jumlah_pengisian = $request->jmlh_pengisian;
        $report->personil1 = $request->personil1;
        $report->personil2 = $request->personil2;
        $report->kembalian = $request->kembalian_numeric;
        $file = $request->file('foto');
        if($file==null){
            $report->save();
        }
        else{
            $report->foto_struk = 'LPBBM-'.sprintf($no+1).'.'.$file->getClientOriginalExtension();
            $tujuan_upload = 'LPBBM';
            $file->move($tujuan_upload,'LPBBM-'.sprintf($no+1).'.'.$file->getClientOriginalExtension());
        }
        if(Auth::user()->operasional_id==10){
            Session::flash('message', Lang::get('Data Berhasil Diedit'));
            return redirect()->route('admin.lapenam.pengisian-bbm.index');
        }
        else{
            Session::flash('message', Lang::get('Data Berhasil Diedit'));
            return redirect()->route('lapenam.pengisian-bbm.index'); 
        }
        
    }
    public function index(){
      
        if(Auth::user()->operasional_id==10 ||Auth::user()->operasional_id == 9||Auth::user()->operasional_id == 8||Auth::user()->operasional_id == 7){
          
            $datas = RefuelingReport::orderby('id', 'desc')->get();
            $judul = 'LAPENAM';
            return view('pages.lapanenam.pengisian-bahan-bakar')->with('datas', $datas)->with('judul', $judul);
        }
        else{
            $datas = RefuelingReport::where('unit',Auth::user()->nama)->orderby('id', 'desc')->get();
            $judul = 'LAPENAM';
            return view('pages.lapanenam.pengisian-bahan-bakar')->with('datas', $datas)->with('judul', $judul);
        }
      
    }
    public function delete($id)

    {    // Mendapatkan tanggal hari ini
        RefuelingReport::where('id',$id)->delete();
        if(Auth::user()->operasional_id==10){
            Session::flash('message', Lang::get('Data Berhasil Dihapus'));
            return redirect()->route('admin.lapenam.pengisian-bbm.index');   
        }
        else{
            Session::flash('message', Lang::get('Data Berhasil Dihapus'));
        return redirect()->route('lapenam.pengisian-bbm.index');
        }
        
    }
    public function exportAll(){
        $pengisian = RefuelingReport::all();
        return Excel::Download(new PengisianBahanBakarExport($pengisian), 'pengisian Bahan Bakar - '. date("d-m-Y") .'.xlsx');
    }
}
    
