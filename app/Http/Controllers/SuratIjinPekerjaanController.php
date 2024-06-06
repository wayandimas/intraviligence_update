<?php

namespace App\Http\Controllers;

use App\Models\Officer;
use App\Models\WorkPermit;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Lang;
use Session;

class SuratIjinPekerjaanController extends Controller
{

     public function index(Request $request){
        $judul = 'SIAP';
        $datas = WorkPermit::all();
        return view('pages.surat-ijin-pekerjaan.index')->with('datas', $datas)->with('judul', $judul);
     

    }
    public function create(){
    $judul = 'SIAP';
    return view('pages.surat-ijin-pekerjaan.create')->with(compact('judul'));
   }

    public function store(Request $request){
         $validator = [
                'tgl_mulai_kerja' => 'required',
                'tgl_mulai_izin' => 'required',
                'tgl_selesai_izin' => 'required',
                'jenis_pekerjaan' => 'required',
                'kontraktor' => 'required',
                'dokumentasi' => 'required'
                
    
                ];
                $customMessages = [
                'tgl_mulai_kerja.required' => 'Tanggal mulai kerja wajib diisi',
                'tgl_mulai_izin.required' => 'Tanggal mulai izin kerja wajib diisi',
                'tgl_selesai_izin.required' => 'Tanggal selesai izin kerja wajib diisi',
                'jenis_pekerjaan.required' => 'Jenis pekerjaan wajib diisi',
                'kontraktor.required' => 'Kontraktor/Vendor wajib diisi',
                'dokumentasi.required' => 'Foto surat izin kerja wajib diisi',
                
                ];
           
            $validator = Validator::make($request->all(), $validator, $customMessages);
    
    
        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        $no = WorkPermit::all()->count();
        $file = $request->file('dokumentasi');
        $tujuan_upload = 'SIAP';
        $file->move($tujuan_upload, 'SIAP-' . sprintf($no + 1) . '.' . $file->getClientOriginalExtension());
       
        $suratIjin = new WorkPermit;
        $suratIjin->tanggal_mulai_pekerjaan = $request->tgl_mulai_kerja;
        $suratIjin->tanggal_mulai_izin = $request->tgl_mulai_izin;
        $suratIjin->tanggal_selesai_izin = $request->tgl_selesai_izin;
        $suratIjin->jenis_pekerjaan = $request->jenis_pekerjaan;
        $suratIjin->kontraktor = $request->kontraktor;
        $suratIjin->foto = 'SIAP-' . sprintf($no + 1) . '.' . $file->getClientOriginalExtension();
        $suratIjin->save();


        Session::flash('message', Lang::get('Data Berhasil Masuk'));
        return redirect()
            ->route('siap.index');
    }
     public function edit(Request $request, $id)

    {    // Mendapatkan tanggal hari ini
        $datas = WorkPermit::where('id', $id)->first();

            return view("pages.surat-ijin-pekerjaan.edit")->with(compact('datas'));
        } 

          public function update(Request $request, $id)
    {
       $validator = [
                'tgl_mulai_kerja' => 'required',
                'tgl_mulai_izin' => 'required',
                'tgl_selesai_izin' => 'required',
                'jenis_pekerjaan' => 'required',
                'kontraktor' => 'required',
                'dokumentasi' => 'image|mimes:jpeg,png,jpg,gif'
                
    
                ];
                $customMessages = [
                'tgl_mulai_kerja.required' => 'Tanggal mulai kerja wajib diisi',
                'tgl_mulai_izin.required' => 'Tanggal mulai izin kerja wajib diisi',
                'tgl_selesai_izin.required' => 'Tanggal selesai izin kerja wajib diisi',
                'jenis_pekerjaan.required' => 'Jenis pekerjaan wajib diisi',
                'kontraktor.required' => 'Kontraktor/Vendor wajib diisi',
                'dokumentasi.image' => 'Foto surat izin kerja harus berupa gambar',
                'dokumentasi.mimes' => 'Format foto surat izin kerja harus jpeg, png, jpg, atau gif',
                
                ];
           
            $validator = Validator::make($request->all(), $validator, $customMessages);
    
    
        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        $no = WorkPermit::all()->count();
        $data = WorkPermit::where('id', $id)->first();
        $data->tanggal_mulai_pekerjaan = $request->tgl_mulai_kerja;
        $data->tanggal_mulai_izin = $request->tgl_mulai_izin;
        $data->tanggal_selesai_izin = $request->tgl_selesai_izin;
        $data->jenis_pekerjaan = $request->jenis_pekerjaan;
        $data->kontraktor = $request->kontraktor;
        $file = $request->file('dokumentasi');
        if($file==null){
            $data->save();
      }
        else{
            $data->foto = 'SIAP-'.sprintf($no+1).'.'.$file->getClientOriginalExtension();
            $tujuan_upload = 'SIAP';
            $file->move($tujuan_upload,'SIAP-'.sprintf($no+1).'.'.$file->getClientOriginalExtension());
        }
        if(Auth::user()->operasional_id==10){
            Session::flash('message', Lang::get('Data Berhasil Diedit'));
            return redirect()->route('admin.lapenam.siap.index');
        }
        else{
            Session::flash('message', Lang::get('Data Berhasil Diedit'));
            return redirect()->route('siap.index'); 
        }
       
    }
      public function delete($id)

    {    // Mendapatkan tanggal hari ini
        WorkPermit::where('id',$id)->delete();
        if(Auth::user()->operasional_id==10){
            Session::flash('message', Lang::get('Data Berhasil Dihapus'));
            return redirect()->route('admin.siap.index');   
        }
        else{
            Session::flash('message', Lang::get('Data Berhasil Dihapus'));
        return redirect()->route('siap.index');
        }
        
    }
          
    }
    
     


    

