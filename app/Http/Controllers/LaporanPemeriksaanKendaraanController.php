<?php

namespace App\Http\Controllers;

use App\Models\ActivityMutationServiceTol;
use App\Models\AmbulanceVehicleLog;
use App\Models\ConditionStatus;
use App\Models\DerekBesarVehicleLog;
use App\Models\DerekKecilVehicleLog;
use App\Models\HandoverTolInventoryLog;
use App\Models\MedicalEquipmentLog;
use App\Models\Officer;
use App\Models\PatroliVehicleLog;
use Auth, Session, Lang;
use Illuminate\Http\Request;
use Validator;
use App\Models\RescueVehicleLog;

class LaporanPemeriksaanKendaraanController extends Controller
{
     public function index(Request $request)

    {    // Mendapatkan tanggal hari ini
     $currentHour = date('H');
        $currentMinute = date('i');

        if ($currentHour == 6 && $currentMinute == 45) {
           return redirect()->route('logout.index');
        }
        $tanggal_today= date('Y-m-d');
        $personil1 = $request->session()->get('personil1');
        $personil2 = $request->session()->get('personil2');
        $p1= Officer::where('id', $personil1)->first();
        $p2= Officer::where('id', $personil2)->first();
        $total=ActivityMutationServiceTol::where('unit',Auth::user()->id)
        ->where('personil1', $personil1)
        ->where('personil2', $personil2)
        ->whereDate('created_at',$tanggal_today)->count();
    
        return view("pages.dashboard-lalin.lapenam")->with(compact('p1','p2','total'));
    }
    public function ceklisKendaraan(Request $request)

    {    // Mendapatkan tanggal hari ini
        $tanggal_today= date('Y-m-d');
        $judul = 'LAPENAM';
        $startDate = $request->input('start');
        $endDate = $request->input('end');
        $endDate = date('Y-m-d', strtotime($endDate . ' +1 day'));
      
        $datas = PatroliVehicleLog::where('unit',Auth::user()->nama.'-'.$tanggal_today)->whereDate('created_at',$tanggal_today)->where('shift',1)->get();
 
        $datasRescue = RescueVehicleLog::where('unit',Auth::user()->nama.'-'.$tanggal_today)->whereDate('created_at',$tanggal_today)->where('shift',1)->get();
      
        $datasAmbulan = AmbulanceVehicleLog::where('unit',Auth::user()->nama.'k'.'-'.$tanggal_today)->whereDate('created_at',$tanggal_today)->where('shift',1)->get();
        $datasMedical = MedicalEquipmentLog::where('unit',Auth::user()->nama.'m'.'-'.$tanggal_today)->whereDate('created_at',$tanggal_today)->where('shift',1)->get();
        $datasDerekKecil = DerekKecilVehicleLog::where('unit',Auth::user()->nama.'k'.'-'.$tanggal_today)->whereDate('created_at',$tanggal_today)->where('shift',1)->get();
        $datasDerekBesar = DerekBesarVehicleLog::where('unit',Auth::user()->nama.'b'.'-'.$tanggal_today)->whereDate('created_at',$tanggal_today)->where('shift',1)->get();
        $datasSecurity = HandoverTolInventoryLog::where('unit',Auth::user()->nama.'-'.$tanggal_today)->whereDate('created_at',$tanggal_today)->where('shift',1)->get();
        // dd($datasAmbulan);
        return view('pages.lapanenam.ceklis')->with(compact('datas', 'datasRescue', 'datasAmbulan', 'datasMedical', 'datasDerekKecil', 'datasDerekBesar','datasSecurity','judul'));
    }
    public function ceklisKendaraanDetail($nama)

    {    // Mendapatkan tanggal hari ini
        $tanggal_today= date('Y-m-d');
        $judul = 'LAPENAM';
        $datas = PatroliVehicleLog::where('unit',$nama)->whereDate('created_at',$tanggal_today)->orderby('id', 'Desc')->get();
        $datasRescue = RescueVehicleLog::where('unit',$nama)->whereDate('created_at',$tanggal_today)->orderby('id', 'Desc')->get();
        $datasAmbulan = AmbulanceVehicleLog::where('unit',$nama)->whereDate('created_at',$tanggal_today)->orderby('id', 'Desc')->get();
        $datasMedical = MedicalEquipmentLog::where('unit',$nama)->whereDate('created_at',$tanggal_today)->orderby('id', 'Desc')->get();
        $datasSecurity = HandoverTolInventoryLog::where('unit',$nama)->whereDate('created_at',$tanggal_today)->orderby('id', 'Desc')->get();
        $datasDerekKecil = DerekKecilVehicleLog::where('unit',$nama)->whereDate('created_at',$tanggal_today)->orderby('id', 'Desc')->get();
        $datasDerekBesar = DerekBesarVehicleLog::where('unit',$nama)->whereDate('created_at',$tanggal_today)->orderby('id', 'Desc')->get();

      
        return view('pages.lapanenam.ceklisDetail')->with(compact('datas', 'datasSecurity','judul', 'datasRescue', 'datasAmbulan', 'datasDerekKecil','datasDerekBesar', 'datasMedical'));

    }
    public function ceklisKendaraanDelete($id)

    {    // Mendapatkan tanggal hari ini
        PatroliVehicleLog::where('id',$id)->delete();
        Session::flash('message', Lang::get('Data Berhasil Dihapus'));
        return redirect()->route('lapenam.ceklis');
    }

   
}

