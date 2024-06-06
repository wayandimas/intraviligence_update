<?php

namespace App\Http\Controllers;

use App\Models\AsetLocation;
use App\Models\Category;
use App\Models\Component;
use App\Models\Interference;
use App\Models\MaintenanceType;
use App\Models\MaintenanceUnit;
use App\Models\Officer;
use App\Models\Operasional;
use App\Models\SourceInformation;
use App\Models\Stationing;
use App\Models\User;
use App\Models\VehicleClass;
use App\Models\VehicleType;
use App\Models\Weather;
use Illuminate\Http\Request;
use Validator, Session, Lang;

class SuperAdminController extends Controller
{
   public function index(){
   $judul = 'Super Admin';
    return view('superadmin.page.dashboard.index')->with(compact('judul'));
   }
    public function Reset($id)
   {
         $users = User::where('id', $id)->first();
         $users->session_token = null;
         $users->save();

           Session::flash('message', Lang::get('User Berhasil DIReset'));

           return redirect()->route('superadmin.users.index');
       }

   public function users(){
      $judul = "Users";
      $op = Operasional::all();
      // dd($op);
      $users = User::with('operasional')->get();
      return view('superadmin.page.users.index')->with(compact('judul','op', 'users'));
   }
   public function createUser(Request $request)
   {
       $validator = Validator::make($request->all(), [
           'nama' => 'required',
           'password' => 'required',
       ]);
   
       if ($validator->fails()) {
           $validator->errors()->add('message', $validator);
           return redirect()->back()->withInput()->withErrors($validator);
       }
       $check = User::where('nama', $request->nama)->first();
       if($check){
           return redirect()->back()->withInput()->withErrors(['message'=>'User Sudah Ada']);
       }else{
           // Membuat pengguna baru
           $users = new User;
           $users->nama = $request->nama;
           $users->operasional_id = $request->operasional;
           $users->password = bcrypt($request->password);
           $users->save();
       // dd($user);
       // dd(Mail::to($user->email)->send(new sendRegister()));
           // Mengirim email
   
           Session::flash('message', Lang::get('Data Berhasil Masuk'));
           return redirect()->route('superadmin.users.index');
       }
       
   }
   public function updateUser(Request $request, $id)
   {
       $validator = Validator::make($request->all(), [
           'nama' => 'required',
       ]);
   
       if ($validator->fails()) {
           $validator->errors()->add('message', $validator);
           return redirect()->back()->withInput()->withErrors($validator);
       }


        if($request->password){
             // Membuat pengguna baru

         $users = User::where('id', $id)->first();
         $users->nama = $request->nama;
         $users->operasional_id = $request->operasional;
         // dd($users);
         $users->password = bcrypt($request->password);
         $users->save();

           Session::flash('message', Lang::get('Data Berhasil Diedit'));
        }else{
            $users = User::where('id', $id)->first();
            $users->nama = $request->nama;
            $users->operasional_id = $request->operasional;
            $users->save();
           }
        
           Session::flash('message', Lang::get('Data Berhasil DIedit'));

           return redirect()->route('superadmin.users.index');
       }
       
   public function deleteUser($id) {
      User::find($id)->delete();
      Session::flash('message', Lang::get('Data Berhasil Dihapus'));
      return redirect()->route('superadmin.users.index');
  }
  public function operasional(){
    $judul = 'Operasional';
    $operasional = Operasional::all();
     return view('superadmin.page.operasional.index')->with(compact('judul', 'operasional'));
    }
    public function createOperasional(Request $request)
   {
       $validator = Validator::make($request->all(), [
           'nama' => 'required',
       ]);
   
       if ($validator->fails()) {
           $validator->errors()->add('message', $validator);
           return redirect()->back()->withInput()->withErrors($validator);
       }
       $check = Operasional::where('nama', $request->nama)->first();
       if($check){
           return redirect()->back()->withInput()->withErrors(['message'=>'User Sudah Ada']);
       }else{
           // Membuat pengguna baru
           $operasional = new Operasional;
           $operasional->nama = $request->nama;
           $operasional->save();

           Session::flash('message', Lang::get('Data Berhasil Masuk'));
           return redirect()->route('superadmin.operasional.index');
       }
       
   }
   public function updateOperasional(Request $request, $id)
   {
       $validator = Validator::make($request->all(), [
           'nama' => 'required',
       ]);
   
       if ($validator->fails()) {
           $validator->errors()->add('message', $validator);
           return redirect()->back()->withInput()->withErrors($validator);
       }
       
         // Membuat pengguna baru
         $operasional = Operasional::where('id', $id)->first();
         $operasional->nama = $request->nama;
         $operasional->save();
           Session::flash('message', Lang::get('Data Berhasil DIedit'));
           return redirect()->route('superadmin.operasional.index');
       }
       public function deleteOperasional($id) {
        Operasional::find($id)->delete();
        Session::flash('message', Lang::get('Data Berhasil Dihapus'));
        return redirect()->route('superadmin.operasional.index');
    }
    public function category(){
        $judul = 'Kategori';
        $op = Operasional::all();
        $kategori = Category::all();
        // dd($kategori);
        return view('superadmin.page.categories.index')->with(compact('judul', 'kategori','op'));
    }
    public function createCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'operasional' => 'required',
        ]);
    
        if ($validator->fails()) {
            $validator->errors()->add('message', $validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $check = Category::where('nama', $request->nama)->first();
        if($check){
            return redirect()->back()->withInput()->withErrors(['message'=>'Kategori Sudah Ada']);
        }else{
            // Membuat pengguna baru
            $category = new Category;
            $category->nama = $request->nama;
            $category->operasional_id = $request->operasional;
            $category->save();
        // dd($user);
        // dd(Mail::to($user->email)->send(new sendRegister()));
            // Mengirim email
    
            Session::flash('message', Lang::get('Data Berhasil Masuk'));
            return redirect()->route('superadmin.category.index');
        }
        
    }
    public function updateCategory(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'operasional' => 'required',
        ]);
    
        if ($validator->fails()) {
            $validator->errors()->add('message', $validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        
          // Membuat pengguna baru
          $category = Category::where('id', $id)->first();
          $category->nama = $request->nama;
          $category->operasional_id = $request->operasional;
          $category->save();
            Session::flash('message', Lang::get('Data Berhasil DIedit'));
            return redirect()->route('superadmin.category.index');
        }
        public function deleteCategory($id) {
            Category::find($id)->delete();
            Session::flash('message', Lang::get('Data Berhasil Dihapus'));
            return redirect()->route('superadmin.category.index');
        }
    public function komponen(){
        $judul = 'Komponen';
        $komponen = Component::with('kategori')->get();
        $kategori = Category::all();
        // dd($komponen);
        return view('superadmin.page.component.index')->with(compact('judul', 'kategori','komponen'));
    }
    public function createKomponen(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kategori' => 'required',
            'alias' => 'required',
        ]);
    
        if ($validator->fails()) {
            $validator->errors()->add('message', $validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $check = Component::where('nama', $request->nama)->first();
        // dd($check);
        if($check){
            return redirect()->back()->withInput()->withErrors(['message'=>'Komponen Sudah Ada']);
        }else{
            // Membuat pengguna baru
               $component = new Component();
                $component->nama = $request->nama;
                $component->alias = $request->alias;
                $component->categori_id = $request->kategori;
                $component->save();
        // dd($user);
        // dd(Mail::to($user->email)->send(new sendRegister()));
            // Mengirim email
    
            Session::flash('message', Lang::get('Data Berhasil Masuk'));
            return redirect()->route('superadmin.komponen.index');
        }
        
    }
    public function updateKomponen(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
              'nama' => 'required',
              'alias' => 'required',
                'kategori' => 'required',
        ]);
    
        if ($validator->fails()) {
            $validator->errors()->add('message', $validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        
          $komponen = Component::where('id', $id)->first();
          $komponen->nama = $request->nama;
          $komponen->alias = $request->alias;
          $komponen->categori_id = $request->kategori;
          $komponen->save();
            Session::flash('message', Lang::get('Data Berhasil DIedit'));
            return redirect()->route('superadmin.komponen.index');
        }
    public function deleteKomponen($id) {
        // dd($id);
        Component::find($id)->delete();
        Session::flash('message', Lang::get('Data Berhasil Dihapus'));
        return redirect()->route('superadmin.komponen.index');
    }
    public function lokasi(){
        $judul = 'Lokasi Aset';
        $lokasi = AsetLocation::all();
        return view('superadmin.page.aset-location.index')->with(compact('judul', 'lokasi'));
    }
     public function createLokasi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);
    
        if ($validator->fails()) {
            $validator->errors()->add('message', $validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $check = AsetLocation::where('nama', $request->nama)->first();
        if($check){
            return redirect()->back()->withInput()->withErrors(['message'=>'Lokasi Aset Sudah Ada']);
        }else{
            // Membuat pengguna baru
            $lokasi = new AsetLocation;
            $lokasi->nama = $request->nama;
            $lokasi->save();
        // dd($user);
        // dd(Mail::to($user->email)->send(new sendRegister()));
            // Mengirim email
    
            Session::flash('message', Lang::get('Data Berhasil Masuk'));
            return redirect()->route('superadmin.lokasi.index');
        }
        
    }
    public function updateLokasi(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);
    
        if ($validator->fails()) {
            $validator->errors()->add('message', $validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        
          $lokasi = AsetLocation::where('id', $id)->first();
          $lokasi->nama = $request->nama;
          $lokasi->save();
            Session::flash('message', Lang::get('Data Berhasil DIedit'));
            return redirect()->route('superadmin.lokasi.index');
        }
        public function deleteLokasi($id) {
            AsetLocation::find($id)->delete();
            Session::flash('message', Lang::get('Data Berhasil Dihapus'));
            return redirect()->route('superadmin.lokasi.index');
        }
    public function gangguan(){
        $judul = 'Jenis Gangguan';
        $data = Interference::all();
        return view('superadmin.page.interference.index')->with(compact('judul', 'data'));
    }
     public function createGangguan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);
    
        if ($validator->fails()) {
            $validator->errors()->add('message', $validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $check =  Interference::where('nama', $request->nama)->first();
        if($check){
            return redirect()->back()->withInput()->withErrors(['message'=>'Jenis Gangguan Sudah Ada']);
        }else{
            // Membuat pengguna baru
            $data = new Interference;
            $data->nama = $request->nama;
            $data->save();
        // dd($user);
        // dd(Mail::to($user->email)->send(new sendRegister()));
            // Mengirim email
    
            Session::flash('message', Lang::get('Data Berhasil Masuk'));
            return redirect()->route('superadmin.gangguan.index');
        }
        
    }
    public function updateGangguan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);
    
        if ($validator->fails()) {
            $validator->errors()->add('message', $validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        
          $data = Interference::where('id', $id)->first();
          $data->nama = $request->nama;
          $data->save();
            Session::flash('message', Lang::get('Data Berhasil DIedit'));
            return redirect()->route('superadmin.gangguan.index');
        }
        public function deleteGangguan($id) {
            Interference::find($id)->delete();
            Session::flash('message', Lang::get('Data Berhasil Dihapus'));
            return redirect()->route('superadmin.gangguan.index');
        }
    public function golonganKendaraan(){
        $judul = 'Golongan Kendaraan';
        $data = VehicleClass::all();
        return view('superadmin.page.vehicle-class.index')->with(compact('judul', 'data'));
    }
     public function createGolonganKendaraan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);
    
        if ($validator->fails()) {
            $validator->errors()->add('message', $validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $check =  VehicleClass::where('nama', $request->nama)->first();
        if($check){
            return redirect()->back()->withInput()->withErrors(['message'=>'Golongan Kendaraan Sudah Ada']);
        }else{
            // Membuat pengguna baru
            $data = new VehicleClass;
            $data->nama = $request->nama;
            $data->save();
        // dd($user);
        // dd(Mail::to($user->email)->send(new sendRegister()));
            // Mengirim email
    
            Session::flash('message', Lang::get('Data Berhasil Masuk'));
            return redirect()->route('superadmin.golonganKendaraan.index');
        }
        
    }
    public function updateGolonganKendaraan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);
    
        if ($validator->fails()) {
            $validator->errors()->add('message', $validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        
          $data = VehicleClass::where('id', $id)->first();
          $data->nama = $request->nama;
          $data->save();
            Session::flash('message', Lang::get('Data Berhasil DIedit'));
            return redirect()->route('superadmin.golonganKendaraan.index');
        }
        public function deleteGolonganKendaraan($id) {
            VehicleClass::find($id)->delete();
            Session::flash('message', Lang::get('Data Berhasil Dihapus'));
            return redirect()->route('superadmin.golonganKendaraan.index');
        }
    public function jenisKendaraan(){
        $judul = 'Jenis Kendaraan';
        $data = VehicleType::all();
        return view('superadmin.page.vehicle-type.index')->with(compact('judul', 'data'));
    }
     public function createJenisKendaraan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);
    
        if ($validator->fails()) {
            $validator->errors()->add('message', $validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $check =  VehicleType::where('nama', $request->nama)->first();
        if($check){
            return redirect()->back()->withInput()->withErrors(['message'=>'Jenis Kendaraan Sudah Ada']);
        }else{
            // Membuat pengguna baru
            $data = new VehicleType;
            $data->nama = $request->nama;
            $data->save();
        // dd($user);
        // dd(Mail::to($user->email)->send(new sendRegister()));
            // Mengirim email
    
            Session::flash('message', Lang::get('Data Berhasil Masuk'));
            return redirect()->route('superadmin.jenisKendaraan.index');
        }
        
    }
    public function updateJenisKendaraan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);
    
        if ($validator->fails()) {
            $validator->errors()->add('message', $validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        
          $data = VehicleType::where('id', $id)->first();
          $data->nama = $request->nama;
          $data->save();
            Session::flash('message', Lang::get('Data Berhasil DIedit'));
            return redirect()->route('superadmin.jenisKendaraan.index');
        }
        public function deleteJenisKendaraan($id) {
            VehicleType::find($id)->delete();
            Session::flash('message', Lang::get('Data Berhasil Dihapus'));
            return redirect()->route('superadmin.jenisKendaraan.index');
        }
    public function cuaca(){
        $judul = 'Cuaca';
        $data = Weather::all();
        return view('superadmin.page.weather.index')->with(compact('judul', 'data'));
    }
     public function createCuaca(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);
    
        if ($validator->fails()) {
            $validator->errors()->add('message', $validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $check =  Weather::where('nama', $request->nama)->first();
        if($check){
            return redirect()->back()->withInput()->withErrors(['message'=>'Cuaca Sudah Ada']);
        }else{
            // Membuat pengguna baru
            $data = new Weather;
            $data->nama = $request->nama;
            $data->save();
        // dd($user);
        // dd(Mail::to($user->email)->send(new sendRegister()));
            // Mengirim email
    
            Session::flash('message', Lang::get('Data Berhasil Masuk'));
            return redirect()->route('superadmin.cuaca.index');
        }
        
    }
    public function updateCuaca(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);
    
        if ($validator->fails()) {
            $validator->errors()->add('message', $validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        
          $data = Weather::where('id', $id)->first();
          $data->nama = $request->nama;
          $data->save();
            Session::flash('message', Lang::get('Data Berhasil DIedit'));
            return redirect()->route('superadmin.cuaca.index');
        }
        public function deleteCuaca($id) {
            Weather::find($id)->delete();
            Session::flash('message', Lang::get('Data Berhasil Dihapus'));
            return redirect()->route('superadmin.cuaca.index');
        }
    public function sumberInformasi(){
        $judul = 'Sumber Informasi';
        $data = SourceInformation::all();
        return view('superadmin.page.source-information.index')->with(compact('judul', 'data'));
    }
     public function createsumberInformasi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);
    
        if ($validator->fails()) {
            $validator->errors()->add('message', $validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $check =  SourceInformation::where('nama', $request->nama)->first();
        if($check){
            return redirect()->back()->withInput()->withErrors(['message'=>'Sumber Informasi Sudah Ada']);
        }else{
            // Membuat pengguna baru
            $data = new SourceInformation;
            $data->nama = $request->nama;
            $data->save();
        // dd($user);
        // dd(Mail::to($user->email)->send(new sendRegister()));
            // Mengirim email
    
            Session::flash('message', Lang::get('Data Berhasil Masuk'));
            return redirect()->route('superadmin.sumberInformasi.index');
        }
        
    }
    public function updatesumberInformasi(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);
    
        if ($validator->fails()) {
            $validator->errors()->add('message', $validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        
          $data = SourceInformation::where('id', $id)->first();
          $data->nama = $request->nama;
          $data->save();
            Session::flash('message', Lang::get('Data Berhasil DIedit'));
            return redirect()->route('superadmin.sumberInformasi.index');
        }
        public function deletesumberInformasi($id) {
            SourceInformation::find($id)->delete();
            Session::flash('message', Lang::get('Data Berhasil Dihapus'));
            return redirect()->route('superadmin.sumberInformasi.index');
        }
    public function stasioning(){
        $judul = 'Stasioning';
        $data = Stationing::all();
        return view('superadmin.page.stasioning.index')->with(compact('judul', 'data'));
    }
     public function createStasioning(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);
    
        if ($validator->fails()) {
            $validator->errors()->add('message', $validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $check =  Stationing::where('nama', $request->nama)->first();
        if($check){
            return redirect()->back()->withInput()->withErrors(['message'=>'Stasioning Sudah Ada']);
        }else{
            // Membuat pengguna baru
            $data = new Stationing;
            $data->nama = $request->nama;
            $data->save();
        // dd($user);
        // dd(Mail::to($user->email)->send(new sendRegister()));
            // Mengirim email
    
            Session::flash('message', Lang::get('Data Berhasil Masuk'));
            return redirect()->route('superadmin.stasioning.index');
        }
        
    }
    public function updateStasioning(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);
    
        if ($validator->fails()) {
            $validator->errors()->add('message', $validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        
          $data = Stationing::where('id', $id)->first();
          $data->nama = $request->nama;
          $data->save();
            Session::flash('message', Lang::get('Data Berhasil DIedit'));
            return redirect()->route('superadmin.stasioning.index');
        }
        public function deleteStasioning($id) {
            Stationing::find($id)->delete();
            Session::flash('message', Lang::get('Data Berhasil Dihapus'));
            return redirect()->route('superadmin.stasioning.index');
        }
    public function jenisPerawatan(){
        $judul = 'Jenis Perawatan';
        $data = MaintenanceType::all();
        return view('superadmin.page.maintenance-type.index')->with(compact('judul', 'data'));
    }
     public function createJenisPerawatan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);
    
        if ($validator->fails()) {
            $validator->errors()->add('message', $validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $check =  MaintenanceType::where('nama', $request->nama)->first();
        if($check){
            return redirect()->back()->withInput()->withErrors(['message'=>'Jenis Perawatan Sudah Ada']);
        }else{
            $data = new MaintenanceType;
            $data->nama = $request->nama;
            $data->save();
    
            Session::flash('message', Lang::get('Data Berhasil Masuk'));
            return redirect()->route('superadmin.jenisPerawatan.index');
        }
        
    }
    public function updatejenisPerawatan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);
    
        if ($validator->fails()) {
            $validator->errors()->add('message', $validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        
          $data = MaintenanceType::where('id', $id)->first();
          $data->nama = $request->nama;
          $data->save();
            Session::flash('message', Lang::get('Data Berhasil DIedit'));
            return redirect()->route('superadmin.jenisPerawatan.index');
        }
        public function deletejenisPerawatan($id) {
            MaintenanceType::find($id)->delete();
            Session::flash('message', Lang::get('Data Berhasil Dihapus'));
            return redirect()->route('superadmin.jenisPerawatan.index');
        }
    public function unitPerawatan(){
        $judul = 'Unit Perawatan';
        $data = MaintenanceUnit::all();
        return view('superadmin.page.maintenance-unit.index')->with(compact('judul', 'data'));
    }
     public function createUnitPerawatan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);
    
        if ($validator->fails()) {
            $validator->errors()->add('message', $validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $check =  MaintenanceUnit::where('nama', $request->nama)->first();
        if($check){
            return redirect()->back()->withInput()->withErrors(['message'=>'unit Perawatan Sudah Ada']);
        }else{
            $data = new MaintenanceUnit;
            $data->nama = $request->nama;
            $data->save();
    
            Session::flash('message', Lang::get('Data Berhasil Masuk'));
            return redirect()->route('superadmin.unitPerawatan.index');
        }
        
    }
    public function updateUnitPerawatan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
        ]);
    
        if ($validator->fails()) {
            $validator->errors()->add('message', $validator);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        
          $data = MaintenanceUnit::where('id', $id)->first();
          $data->nama = $request->nama;
          $data->save();
            Session::flash('message', Lang::get('Data Berhasil DIedit'));
            return redirect()->route('superadmin.unitPerawatan.index');
        }
        public function deleteUnitPerawatan($id) {
            MaintenanceUnit::find($id)->delete();
            Session::flash('message', Lang::get('Data Berhasil Dihapus'));
            return redirect()->route('superadmin.unitPerawatan.index');
        }

        public function officers(){
            $judul = "Officers";
            $op = Operasional::all();
            // dd($op);
            $officers = Officer::with('operasional')->get();
            return view('superadmin.page.officers.index')->with(compact('judul','op', 'officers'));
         }
         public function createOfficer(Request $request)
         {
             $validator = Validator::make($request->all(), [
                 'nama' => 'required',
                //  'password' => 'required',
             ]);
         
             if ($validator->fails()) {
                 $validator->errors()->add('message', $validator);
                 return redirect()->back()->withInput()->withErrors($validator);
             }
             $check = User::where('nama', $request->nama)->first();
             if($check){
                 return redirect()->back()->withInput()->withErrors(['message'=>'User Sudah Ada']);
             }else{
                 // Membuat pengguna baru
                if ($request->hasFile('ttd')) {
                // File uploaded, proceed with processing
                $op = Operasional::where('id',$request->operasional)->first();
                $file = $request->file('ttd');
                $tujuan_upload = 'assets/images/TTD';
                $file->move($tujuan_upload, $op->nama.'-'.$request->nama.'.'.$file->getClientOriginalExtension());
                 $officers = new Officer;
                 $officers->nama = $request->nama;
                 $officers->operasional_id = $request->operasional;
                 $officers->ttd = $tujuan_upload.'/'.$op->nama.'-'.$request->nama.'.'.$file->getClientOriginalExtension();
                 $officers->save();
                } else {
                    return redirect()->back()->withInput()->withErrors(['message'=>'TTD Tidak Terbaca']);
                }
         
                 Session::flash('message', Lang::get('Data Berhasil Masuk'));
                 return redirect()->route('superadmin.officers.index');
             }
             
         }
         public function updateOfficer(Request $request, $id)
         {
             $validator = Validator::make($request->all(), [
                 'nama' => 'required',
                //  'password' => 'required',
             ]);
         
             if ($validator->fails()) {
                 $validator->errors()->add('message', $validator);
                 return redirect()->back()->withInput()->withErrors($validator);
             }
             $officers = Officer::find($id);
            $officers->nama = $request->nama;
            $officers->operasional_id = $request->operasional;

            if ($request->hasFile('ttd')) {
                // File uploaded, proceed with processing
                $op = Operasional::where('id', $request->operasional)->first();
                $file = $request->file('ttd');
                // dd($file);
                $tujuan_upload = 'assets/images/TTD';
                $file->move($tujuan_upload, $op->nama . '-' . $request->nama . '.' . $file->getClientOriginalExtension());
                $officers->ttd = $tujuan_upload . '/' . $op->nama . '-' . $request->nama . '.' . $file->getClientOriginalExtension();
            }

            $officers->save();

            Session::flash('message', Lang::get('Data Berhasil Di Edit'));
            return redirect()->route('superadmin.officers.index');
        }
             
         public function deleteOfficer($id) {
            Officer::find($id)->delete();
            Session::flash('message', Lang::get('Data Berhasil Dihapus'));
            return redirect()->route('superadmin.officers.index');
        }
}
