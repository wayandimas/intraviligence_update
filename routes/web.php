<?php

use App\Http\Controllers\AdminKendaraanGangguanDanKecelakaan;
use App\Http\Controllers\AktivitasHarianPetugasController;
use App\Http\Controllers\AmbulanController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardLalinController;
use App\Http\Controllers\DerekController;
use App\Http\Controllers\LaporanPemeriksaanKendaraanController;
use App\Http\Controllers\MonitoringPerawatanKendaraanController;
use App\Http\Controllers\MutasiKegiatanController;
use App\Http\Controllers\PatroliController;
use App\Http\Controllers\PelayananKecelakaanLaluLintasController;
use App\Http\Controllers\PelayananKendaraanGangguan;
use App\Http\Controllers\PelayananKendaraanGangguanController;
use App\Http\Controllers\PelayananPengendalianOperasionalController;
use App\Http\Controllers\PengisianBahanBakarController;
use App\Http\Controllers\RescueController;
use App\Http\Controllers\RescueyControler;
use App\Http\Controllers\SecurityControler;
use App\Http\Controllers\SenkomController;
use App\Http\Controllers\SuratIjinPekerjaanController;
use App\Http\Controllers\testcontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SuperAdminController; 
use Illuminate\Support\Str; 


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('layouts.index');
// });


 Route::group(['middleware'=>'verify_session_token'],function () {
    Route::get('/', [LoginController::class, 'gate'])->name('login.gate');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'post'])->name('login.post');
    Route::get('/form-patroli', [PatroliController::class, 'index'])->name('patroli.index');
    Route::post('/form-patroli', [PatroliController::class, 'store'])->name('patroli.store');
    Route::patch('/form-patroli/{id}', [PatroliController::class, 'update'])->name('patroli.update');
    Route::get('/dashboard-lalin', [DashboardLalinController::class, 'index'])->name('dashboard-lalin.index');
    Route::get('/aktivitas-harian-petugas', [AktivitasHarianPetugasController::class, 'index'])->name('aktivitas-harian.index');
    Route::get('/mutasi-kegiatan', [MutasiKegiatanController::class, 'index'])->name('mutasi-kegiatan.index');
    Route::get('/mutasi-kegiatan/create', [MutasiKegiatanController::class, 'create'])->name('mutasi-kegiatan.create');
    Route::post('/mutasi-kegiatan', [MutasiKegiatanController::class, 'store'])->name('mutasi-kegiatan.store');
    Route::get('mutasi-kegiatan/detail/{no_mutation}', [MutasiKegiatanController::class, 'detail'])->name('mutasi.detail');
    Route::get('mutasi-kegiatan/export/{id}', [MutasiKegiatanController::class, 'export'])->name('mutasi-kegiatan.export');
    Route::get('mutasi-kegiatan/detail/edit/{id}', [MutasiKegiatanController::class, 'editMutasi'])->name('mutasi.edit');        
    Route::patch('mutasi-kegiatan/detail/edit/{id}', [MutasiKegiatanController::class, 'updateMutasi'])->name('mutasi.update');
    Route::delete('mutasi-kegiatan/detail/{id}', [MutasiKegiatanController::class, 'deleteMutasi'])->name('mutasi.delete');
    Route::get('/pelayanan-kendaraan-gangguan', [PelayananKendaraanGangguanController::class, 'index'])->name('pelayanan-kendaraan-gangguan.index');
    Route::get('/pelayanan-kendaraan-gangguan/create', [PelayananKendaraanGangguanController::class, 'create'])->name('pelayanan-kendaraan-gangguan.create');
    Route::post('/pelayanan-kendaraan-gangguan/create', [PelayananKendaraanGangguanController::class, 'store'])->name('pelayanan-kendaraan-gangguan.store');
    Route::get('pelayanan-kendaraan-gangguan/edit/{id}', [PelayananKendaraanGangguanController::class, 'editKendaraanGangguan'])->name('pelayanan-kendaraan-gangguan.edit');
    Route::patch('pelayanan-kendaraan-gangguan/edit/{id}', [PelayananKendaraanGangguanController::class, 'updateKendaraanGangguan'])->name('pelayanan-kendaraan-gangguan.update');
    Route::delete('pelayanan-kendaraan-gangguan/{id}', [PelayananKendaraanGangguanController::class, 'deletepkg'])->name('pelayanan-kendaraan-gangguan.delete');
    Route::get('/pelayanan-kendaraan-gangguan/export/{id}', [PelayananKendaraanGangguanController::class, 'export'])->name('pelayanan-kendaraan-gangguan.export');
    Route::get('/pemeriksaan-kendaraan-patroli/export/{id}', [PatroliController::class, 'export'])->name('pemeriksaan-kendaraan-patroli.export');
    
    

    Route::get('/lalin', [DashboardAdminController::class, 'index'])->name('admin.dashboard.index');
    Route::prefix('lalin')->group(function () {
        Route::name('admin.')->group(function () {
            Route::get('aktivitas-harian-petugas', [DashboardAdminController::class, 'aktivitasHarian'])->name('aktivitas.harian');
            Route::get('mutasi-kegiatan', [DashboardAdminController::class, 'mutasiKegiatan'])->name('mutasi.kegiatan');
            Route::get('pelayanan-kendaraan-gangguan', [DashboardAdminController::class, 'kendaraanGangguan'])->name('pelayanan-kendaraan-gangguan');
            Route::get('pelayanan-kendaraan-gangguan/edit/{id}', [DashboardAdminController::class, 'editKendaraanGangguan'])->name('pelayanan-kendaraan-gangguan.edit');
            Route::post('pelayanan-kendaraan-gangguan/export/', [DashboardAdminController::class, 'exportPkg'])->name('pelayanan-kendaraan-gangguan.export');
            Route::patch('pelayanan-kendaraan-gangguan/edit/{id}', [DashboardAdminController::class, 'updateKendaraanGangguan'])->name('pelayanan-kendaraan-gangguan.update');
            Route::delete('pelayanan-kendaraan-gangguan/{id}', [DashboardAdminController::class, 'deletepkg'])->name('pelayanan-kendaraan-gangguan.delete');
            Route::get('pelayanan-kendaraan-kecelakaan', [DashboardAdminController::class, 'kendaraanKecelakaan'])->name('pelayanan-kendaraan-kecelakaan');
            Route::get('mutasi-kegiatan/detail/{no_mutation}', [DashboardAdminController::class, 'detail'])->name('mutasi.detail');
            Route::get('mutasi-kegiatan/export/{id}', [DashboardAdminController::class, 'export'])->name('mutasi.export');
            Route::get('mutasi-kegiatan/detail/edit/{id}', [DashboardAdminController::class, 'editMutasi'])->name('mutasi.edit');
            Route::patch('mutasi-kegiatan/detail/{id}', [DashboardAdminController::class, 'updateMutasi'])->name('mutasi.update');
            Route::delete('mutasi-kegiatan/detail/{id}', [DashboardAdminController::class, 'deleteMutasi'])->name('mutasi.delete');
            Route::delete('pelayanan-kendaraan-kecelakaan/{id}', [DashboardAdminController::class, 'deletepkk'])->name('pelayanan-kendaraan-kecelakaan.delete');
            Route::get('pelayanan-kendaraan-kecelakaan/edit/{id}', [DashboardAdminController::class, 'editpkk'])->name('pelayanan-kendaraan-kecelakaan.edit');
            Route::get('mutasi-kegiatan/export', [MutasiKegiatanController::class, 'export'])->name('mutasi-kegiatan.export');
              Route::patch('pelayanan-kendaraan-kecelakaan/edit/{id}', [PelayananKecelakaanLaluLintasController::class, 'updatepkk'])->name('pelayanan-kendaraan-kecelakaan.update');
    Route::patch('pelayanan-kendaraan-kecelakaan/edit-next/{id}', [PelayananKecelakaanLaluLintasController::class, 'updateNext'])->name('pelayanan-kendaraan-kecelakaan.nextUpdate');
            Route::prefix('laporan-pemeriksaan-kendaraan')->group((function (){
                Route::name('lapenam.')->group(function (){
                    Route::get('/', [DashboardAdminController::class, 'lapanenam'])->name('index');
                    Route::get('ceklis-kendaraan', [DashboardAdminController::class, 'ceklisKendaraan'])->name('ceklis');
                    Route::get('ceklis-kendaraan/detail/{unit}', [DashboardAdminController::class, 'ceklisKendaraanDetail'])->name('ceklis.detail');
                    Route::delete('ceklis-kendaraan/patroli/delete/{id}', [DashboardAdminController::class, 'ceklisKendaraanDelete'])->name('ceklis.delete');
                    Route::delete('ceklis-kendaraan/ambulans/delete/{id}', [DashboardAdminController::class, 'ceklisKendaraanAmbulanDelete'])->name('ceklis-ambulan.delete');
                    Route::delete('ceklis-medical/delete/{id}', [DashboardAdminController::class, 'ceklisMedicalDelete'])->name('ceklis-medical.delete');
                    Route::delete('ceklis-kendaraan/rescue/delete/{id}', [DashboardAdminController::class, 'ceklisRescueDelete'])->name('ceklis-rescue.delete');
                    Route::delete('ceklis-kendaraan/derek-kecil/delete/{id}', [DashboardAdminController::class, 'ceklisKendaraanDerekKecilDelete'])->name('ceklis-derek-kecil.delete');
                    Route::delete('ceklis-kendaraan-derek-besar-delete/{id}', [DashboardAdminController::class, 'ceklisKendaraanDerekBesarDelete'])->name('ceklis-derek-besar.delete');
                    Route::delete('serah-terima/delete/{id}', [DashboardAdminController::class, 'serahTerimaDelete'])->name('serah-terima.delete');
                    Route::get('perawatan-kendaraan', [MonitoringPerawatanKendaraanController::class, 'index'])->name('perawatan-kendaraan.index');
                    Route::post('perawatan-kendaraan', [MonitoringPerawatanKendaraanController::class, 'store'])->name('perawatan-kendaraan.store');
                    Route::get('perawatan-kendaraan/{id}', [MonitoringPerawatanKendaraanController::class, 'edit'])->name('perawatan-kendaraan.edit');
                    Route::patch('perawatan-kendaraan/{id}', [MonitoringPerawatanKendaraanController::class, 'update'])->name('perawatan-kendaraan.update');
                    Route::get('pengisian-bbm', [PengisianBahanBakarController::class, 'index'])->name('pengisian-bbm.index');
                    Route::post('pengisian-bbm', [PengisianBahanBakarController::class, 'store'])->name('pengisian-bbm.store');
                    Route::delete('pengisian-bbm/{id}', [PengisianBahanBakarController::class, 'delete'])->name('pengisian-bbm.delete');
                    Route::get('pengisian-bbm/{id}', [PengisianBahanBakarController::class, 'edit'])->name('pengisian-bbm.edit');
                    Route::get('patroli/export/{id}', [PatroliController::class, 'export'])->name('pemeriksaan-kendaraan-patroli.export');
                    Route::get('rescue/export/{id}', [RescueController::class, 'export'])->name('pemeriksaan-kendaraan-rescue.export');
                    Route::get('ambulans/export/{id}', [AmbulanController::class, 'exportVehicleLog'])->name('pemeriksaan-kendaraan-ambulans.export');
                    Route::get('pemeriksaan-peralatan-medis/export/{id}', [AmbulanController::class, 'exportMedicalLog'])->name('pemeriksaan-peralatan-medis.export');
                    Route::get('derek-kecil/export/{id}', [DerekController::class, 'exportDerekKecil'])->name('pemeriksaan-derek-kecil.export');
                    Route::get('derek-besar/export/{id}', [DerekController::class, 'exportDerekBesar'])->name('pemeriksaan-derek-besar.export');
                    Route::get('serah-terima-inventaris/export/{id}', [SecurityControler::class, 'export'])->name('serah-terima.export');
                    Route::get('serah-terima-security/detail/edit/{id}', [SecurityControler::class, 'edit'])->name('serah-terima.edit');
                    Route::get('ceklis-kendaraan/patroli/detail/edit/{id}', [PatroliController::class, 'edit'])->name('ceklis-patroli.edit');
                    Route::get('ceklis-kendaraan/security/detail/edit/{id}', [SecurityControler::class, 'edit'])->name('ceklis-security.edit');
                    Route::get('ceklis-kendaraan/rescue/detail/edit/{id}', [RescueController::class, 'edit'])->name('ceklis-rescue.edit');
                    Route::get('ceklis-kendaraan/ambulans/detail/edit/{id}', [AmbulanController::class, 'edit'])->name('ceklis-ambulan.edit');
                     Route::get('ceklis-kendaraan/derek/detail/edit/{id}', [DerekController::class, 'edit'])->name('ceklis.derek.edit');
                });
            }));
            Route::prefix('surat-ijin-pekerjaan')->group((function (){
                Route::name('siap.')->group(function() {
                Route::get('/', [SuratIjinPekerjaanController::class, 'index'])->name('index');
                    Route::get('create', [SuratIjinPekerjaanController::class, 'create'])->name('create');
                    Route::post('create', [SuratIjinPekerjaanController::class, 'store'])->name('store');
                    Route::get('edit/{id}', [SuratIjinPekerjaanController::class, 'edit'])->name('edit');
                    Route::patch('edit/{id}', [SuratIjinPekerjaanController::class, 'update'])->name('update');
                    Route::delete('delete/{id}', [SuratIjinPekerjaanController::class, 'delete'])->name('delete');
                });
            }));
            Route::prefix('pelayanan-pengendalian-operasional')->group((function (){
                Route::name('pelayanan-pengendalian-operasional.')->group(function (){
                    Route::get('/', [PelayananPengendalianOperasionalController::class,'index'])->name('index');
                    Route::get('pelayanan-pengendalian-operasional/edit/{id}', [PelayananPengendalianOperasionalController::class,'edit'])->name('edit');
                    Route::patch('pelayanan-pengendalian-operasional/edit/{id}', [PelayananPengendalianOperasionalController::class,'update'])->name('update');
                    Route::post('pelayanan-pengendalian-operasional/export/', [DashboardAdminController::class,'exportPpo'])->name('export');
                    Route::get('pelayanan-pengendalian-operasional/delete/{id}', [PelayananPengendalianOperasionalController::class,'delete'])->name('delete');
                });
            }));
            Route::prefix('security')->group((function (){
                Route::name('security.')->group(function (){
                        Route::get('/', [SecurityControler::class, 'index'])->name('index');
                        Route::post('create', [SecurityControler::class, 'store'])->name('store');
                        Route::get('export/{id}', [SecurityControler::class, 'export'])->name('export');
                });
            }));
        });
    });
    
  Route::get('/koordinator', [DashboardAdminController::class, 'index'])->name('koordinator.dashboard.index');
    Route::prefix('koordinator')->group(function () {
        Route::name('koordinator.')->group(function () {
            Route::get('aktivitas-harian-petugas', [DashboardAdminController::class, 'aktivitasHarian'])->name('aktivitas.harian');
            Route::get('mutasi-kegiatan', [DashboardAdminController::class, 'mutasiKegiatan'])->name('mutasi.kegiatan');
            Route::get('pelayanan-kendaraan-gangguan', [DashboardAdminController::class, 'kendaraanGangguan'])->name('pelayanan-kendaraan-gangguan');
            Route::get('pelayanan-kendaraan-gangguan/edit/{id}', [DashboardAdminController::class, 'editKendaraanGangguan'])->name('pelayanan-kendaraan-gangguan.edit');
            Route::patch('pelayanan-kendaraan-gangguan/edit/{id}', [DashboardAdminController::class, 'updateKendaraanGangguan'])->name('pelayanan-kendaraan-gangguan.update');
            Route::delete('pelayanan-kendaraan-gangguan/{id}', [DashboardAdminController::class, 'deletepkg'])->name('pelayanan-kendaraan-gangguan.delete');
            Route::get('pelayanan-kendaraan-kecelakaan', [DashboardAdminController::class, 'kendaraanKecelakaan'])->name('pelayanan-kendaraan-kecelakaan');
            Route::get('mutasi-kegiatan/detail/{no_mutation}', [DashboardAdminController::class, 'detail'])->name('mutasi.detail');
            Route::get('mutasi-kegiatan/export/{id}', [DashboardAdminController::class, 'export'])->name('mutasi.export');
            Route::get('mutasi-kegiatan/detail/edit/{id}', [DashboardAdminController::class, 'editMutasi'])->name('mutasi.edit');
            Route::patch('mutasi-kegiatan/detail/{id}', [DashboardAdminController::class, 'updateMutasi'])->name('mutasi.update');
            Route::delete('mutasi-kegiatan/detail/{id}', [DashboardAdminController::class, 'deleteMutasi'])->name('mutasi.delete');
            Route::delete('pelayanan-kendaraan-kecelakaan/{id}', [DashboardAdminController::class, 'deletepkk'])->name('pelayanan-kendaraan-kecelakaan.delete');
            Route::get('pelayanan-kendaraan-kecelakaan/edit/{id}', [DashboardAdminController::class, 'editpkk'])->name('pelayanan-kendaraan-kecelakaan.edit');
            Route::prefix('laporan-pemeriksaan-kendaraan')->group((function (){
                Route::name('lapenam.')->group(function (){
                    Route::get('/', [DashboardAdminController::class, 'lapanenam'])->name('index');
                    Route::get('ceklis-kendaraan', [DashboardAdminController::class, 'ceklisKendaraan'])->name('ceklis');
                    Route::get('ceklis-kendaraan-detail/{id}', [DashboardAdminController::class, 'ceklisKendaraanDetail'])->name('ceklis.detail');
                    Route::get('ceklis-kendaraan/patroli/detail/edit/{id}', [PatroliController::class, 'edit'])->name('ceklis-patroli.edit');
                    Route::get('ceklis-kendaraan/security/detail/edit/{id}', [SecurityControler::class, 'edit'])->name('ceklis-security.edit');
                    Route::get('ceklis-kendaraan/rescue/detail/edit/{id}', [RescueController::class, 'edit'])->name('ceklis-rescue.edit');
                    Route::delete('ceklis-kendaraan-delete/{id}', [DashboardAdminController::class, 'ceklisKendaraanDelete'])->name('ceklis.delete');
                    Route::get('perawatan-kendaraan', [MonitoringPerawatanKendaraanController::class, 'index'])->name('perawatan-kendaraan.index');
                    Route::post('perawatan-kendaraan', [MonitoringPerawatanKendaraanController::class, 'store'])->name('perawatan-kendaraan.store');
                    Route::get('perawatan-kendaraan/{id}', [MonitoringPerawatanKendaraanController::class, 'edit'])->name('perawatan-kendaraan.edit');
                    Route::patch('perawatan-kendaraan/{id}', [MonitoringPerawatanKendaraanController::class, 'update'])->name('perawatan-kendaraan.update');
                    Route::get('pengisian-bbm', [PengisianBahanBakarController::class, 'index'])->name('pengisian-bbm.index');
                    Route::post('pengisian-bbm', [PengisianBahanBakarController::class, 'store'])->name('pengisian-bbm.store');
                    Route::delete('pengisian-bbm/{id}', [PengisianBahanBakarController::class, 'delete'])->name('pengisian-bbm.delete');
                    Route::get('pengisian-bbm/{id}', [PengisianBahanBakarController::class, 'edit'])->name('pengisian-bbm.edit');
                     Route::get('patroli/export/{id}', [PatroliController::class, 'export'])->name('pemeriksaan-kendaraan-patroli.export');
                    Route::get('rescue/export/{id}', [RescueController::class, 'export'])->name('pemeriksaan-kendaraan-rescue.export');
                    Route::get('ambulans/export/{id}', [AmbulanController::class, 'exportVehicleLog'])->name('pemeriksaan-kendaraan-ambulans.export');
                    Route::get('peralatan-medis/export/{id}', [AmbulanController::class, 'exportMedicalLog'])->name('pemeriksaan-peralatan-medis.export');
                    Route::get('derek-kecil/export/{id}', [DerekController::class, 'exportDerekKecil'])->name('pemeriksaan-derek-kecil.export');
                    Route::get('derek-besar/export/{id}', [DerekController::class, 'exportDerekBesar'])->name('pemeriksaan-derek-besar.export');
                    Route::get('serah-terima-inventaris/export/{id}', [SecurityControler::class, 'export'])->name('serah-terima.export');
                    Route::get('serah-terima-security/detail/edit/{id}', [SecurityControler::class, 'edit'])->name('serah-terima.edit');
                    
                });
            }));
        Route::prefix('surat-ijin-pekerjaan')->group((function (){
            Route::name('siap.')->group(function() {
            Route::get('/', [SuratIjinPekerjaanController::class, 'index'])->name('index');
                Route::get('create', [SuratIjinPekerjaanController::class, 'create'])->name('create');
                Route::post('create', [SuratIjinPekerjaanController::class, 'store'])->name('store');
                Route::get('edit/{id}', [SuratIjinPekerjaanController::class, 'edit'])->name('edit');
                Route::patch('edit/{id}', [SuratIjinPekerjaanController::class, 'update'])->name('update');
                Route::delete('delete/{id}', [SuratIjinPekerjaanController::class, 'delete'])->name('delete');
        });
    }));
     Route::prefix('pelayanan-pengendalian-operasional')->group((function (){
        Route::name('pelayanan-pengendalian-operasional.')->group(function (){
            Route::get('/', [PelayananPengendalianOperasionalController::class,'index'])->name('index');
            Route::get('pelayanan-pengendalian-operasional/edit/{id}', [PelayananPengendalianOperasionalController::class,'edit'])->name('edit');
            Route::patch('pelayanan-pengendalian-operasional/edit/{id}', [PelayananPengendalianOperasionalController::class,'update'])->name('update');
            Route::get('pelayanan-pengendalian-operasional/export/{id}', [PelayananPengendalianOperasionalController::class,'export'])->name('export');
            Route::get('pelayanan-pengendalian-operasional/delete/{id}', [PelayananPengendalianOperasionalController::class,'delete'])->name('delete');
        });
    }));
        });
    });
    Route::prefix('laporan-pemeriksaan-kendaraan')->group((function (){
        Route::name('lapenam.')->group(function (){
            Route::get('/', [LaporanPemeriksaanKendaraanController::class, 'index'])->name('index');
            Route::get('ceklis-kendaraan', [LaporanPemeriksaanKendaraanController::class, 'ceklisKendaraan'])->name('ceklis');
            Route::get('ceklis-kendaraan/detail/{nama}', [LaporanPemeriksaanKendaraanController::class, 'ceklisKendaraanDetail'])->name('ceklis.detail');
            Route::get('ceklis-kendaraan-rescue/detail/edit/{id}', [RescueController::class, 'edit'])->name('ceklis.rescue.edit');
            Route::get('ceklis-kendaraan-ambulan/detail/edit/{id}', [AmbulanController::class, 'edit'])->name('ceklis.ambulan.edit');
            Route::get('ceklis-kendaraan/patroli/detail/edit/{id}', [PatroliController::class, 'edit'])->name('ceklis.patroli.edit');
            Route::get('ceklis-kendaraan/derek/detail/edit/{id}', [DerekController::class, 'edit'])->name('ceklis-derek.edit');
            Route::get('ceklis-kendaraan/security/detail/edit/{id}', [SecurityControler::class, 'edit'])->name('ceklis.security.edit');
            Route::delete('ceklis-kendaraan-delete/{id}', [LaporanPemeriksaanKendaraanController::class, 'ceklisKendaraanDelete'])->name('ceklis.delete');
            Route::get('perawatan-kendaraan', [MonitoringPerawatanKendaraanController::class, 'index'])->name('perawatan-kendaraan.index');
            Route::get('perawatan-kendaraan/export', [MonitoringPerawatanKendaraanController::class, 'exportAll'])->name('perawatan-kendaraan.exportAll');
            Route::get('perawatan-kendaraan/create', [MonitoringPerawatanKendaraanController::class, 'create'])->name('perawatan-kendaraan.create');
            Route::post('perawatan-kendaraan/create', [MonitoringPerawatanKendaraanController::class, 'store'])->name('perawatan-kendaraan.store');
            Route::delete('perawatan-kendaraan/{id}', [MonitoringPerawatanKendaraanController::class, 'Delete'])->name('perawatan-kendaraan.delete');
            Route::get('perawatan-kendaraan/{id}', [MonitoringPerawatanKendaraanController::class, 'edit'])->name('perawatan-kendaraan.edit');
            Route::patch('perawatan-kendaraan/{id}', [MonitoringPerawatanKendaraanController::class, 'update'])->name('perawatan-kendaraan.update');
            Route::get('pengisian-bbm', [PengisianBahanBakarController::class, 'index'])->name('pengisian-bbm.index');
            Route::get('pengisian-bbm/create', [PengisianBahanBakarController::class, 'create'])->name('pengisian-bbm.create');
            Route::post('pengisian-bbm/create', [PengisianBahanBakarController::class, 'store'])->name('pengisian-bbm.store');
            Route::get('pengisian-bbm/export', [PengisianBahanBakarController::class, 'exportAll'])->name('pengisian-bbm.exportAll');
            Route::delete('pengisian-bbm/{id}', [PengisianBahanBakarController::class, 'delete'])->name('pengisian-bbm.delete');
            Route::get('pengisian-bbm/{id}', [PengisianBahanBakarController::class, 'edit'])->name('pengisian-bbm.edit');
            Route::patch('pengisian-bbm/{id}', [PengisianBahanBakarController::class, 'update'])->name('pengisian-bbm.update');
        });
    }));

    Route::prefix('surat-ijin-pekerjaan')->group((function (){
        Route::name('siap.')->group(function() {
            Route::get('/', [SuratIjinPekerjaanController::class, 'index'])->name('index');
            Route::get('create', [SuratIjinPekerjaanController::class, 'create'])->name('create');
            Route::post('create', [SuratIjinPekerjaanController::class, 'store'])->name('store');
            Route::get('edit/{id}', [SuratIjinPekerjaanController::class, 'edit'])->name('edit');
            Route::patch('edit/{id}', [SuratIjinPekerjaanController::class, 'update'])->name('update');
        });
    }));
     Route::prefix('pelayanan-pengendalian-operasional')->group((function (){
        Route::name('pelayanan-pengendalian-operasional.')->group(function (){
                Route::get('/', [PelayananPengendalianOperasionalController::class,'index'])->name('index');
                Route::get('create', [PelayananPengendalianOperasionalController::class,'create'])->name('create');
                Route::post('create', [PelayananPengendalianOperasionalController::class,'store'])->name('store');
                Route::get('edit/{id}', [PelayananPengendalianOperasionalController::class,'edit'])->name('edit');
                Route::patch('edit/{id}', [PelayananPengendalianOperasionalController::class,'update'])->name('update');
                Route::get('export/{id}', [PelayananPengendalianOperasionalController::class,'export'])->name('export');
        });
    }));
     Route::prefix('form-senkom')->group((function (){
        Route::name('senkom.')->group(function (){
                Route::get('/', [SenkomController::class,'index'])->name('index');
                Route::post('/', [SenkomController::class,'store'])->name('store');
        });
    }));
    Route::prefix('security')->group((function (){
        Route::name('security.')->group(function (){
                Route::get('/', [SecurityControler::class, 'index'])->name('index');
                Route::post('create', [SecurityControler::class, 'store'])->name('store');
                Route::patch('edit/{id}', [SecurityControler::class, 'update'])->name('update');
                Route::get('export/{id}', [SecurityControler::class, 'export'])->name('export');
        });
    }));

     Route::prefix('rescue')->group((function (){
        Route::name('rescue.')->group(function (){
              Route::get('/', [RescueController::class, 'index'])->name('index');
              Route::post('create', [RescueController::class, 'store'])->name('store');
              Route::patch('edit/{id}', [RescueController::class, 'update'])->name('update');
              Route::get('export/{id}', [RescueController::class, 'export'])->name('export');
        });
    }));
     Route::prefix('ambulan')->group((function (){
        Route::name('ambulan.')->group(function (){
                Route::get('/', [AmbulanController::class, 'index'])->name('index');
                Route::post('/create', [AmbulanController::class, 'store'])->name('store');
                Route::patch('/edit/{id}', [AmbulanController::class, 'update'])->name('update');
                Route::get('export/{id}', [AmbulanController::class, 'export'])->name('export');
        });
}));
 
    Route::get('/derek', [DerekController::class, 'index'])->name('derek.index');
    Route::post('/derek', [DerekController::class, 'store'])->name('derek.store');
     Route::patch('/derek/{id}', [DerekController::class, 'update'])->name('derek.update');
    
   
    Route::get('/pelayanan-kecelakaan-lalu-lintas', [PelayananKecelakaanLaluLintasController::class,'index'])->name('pelayanan-kecelakaan-lalu-lintas.index');
    Route::get('/pelayanan-kecelakaan-lalu-lintas/create', [PelayananKecelakaanLaluLintasController::class,'create'])->name('pelayanan-kecelakaan-lalu-lintas.create');
    Route::post('/pelayanan-kecelakaan-lalu-lintas/validate', [PelayananKecelakaanLaluLintasController::class,'validate'])->name('pelayanan-kecelakaan-lalu-lintas.validate');
    Route::get('/pelayanan-kecelakaan-lalu-lintas/next', [PelayananKecelakaanLaluLintasController::class,'next'])->name('pelayanan-kecelakaan-lalu-lintas.next');
    Route::post('/pelayanan-kecelakaan-lalu-lintas', [PelayananKecelakaanLaluLintasController::class,'store'])->name('pelayanan-kecelakaan-lalu-lintas.store');
    Route::post('/pelayanan-kecelakaan-lalu-lintas/next', [PelayananKecelakaanLaluLintasController::class,'storeNext'])->name('pelayanan-kecelakaan-lalu-lintas.storeNext');
    Route::get('pelayanan-kendaraan-kecelakaan/edit/{id}', [PelayananKecelakaanLaluLintasController::class, 'editpkk'])->name('pelayanan-kendaraan-kecelakaan.edit');
    Route::get('pelayanan-kendaraan-kecelakaan/edit-next/{id}', [PelayananKecelakaanLaluLintasController::class, 'editNext'])->name('pelayanan-kendaraan-kecelakaan.editNext');

    Route::patch('pelayanan-kendaraan-kecelakaan/edit/{id}', [PelayananKecelakaanLaluLintasController::class, 'updatepkk'])->name('pelayanan-kendaraan-kecelakaan.update');
    Route::patch('pelayanan-kendaraan-kecelakaan/edit-next/{id}', [PelayananKecelakaanLaluLintasController::class, 'updateNext'])->name('pelayanan-kendaraan-kecelakaan.nextUpdate');
    Route::delete('pelayanan-kendaraan-kecelakaan/{id}', [PelayananKecelakaanLaluLintasController::class, 'deletepkk'])->name('pelayanan-kendaraan-kecelakaan.delete');
    Route::get('/pelayanan-kecelakaan-lalu-lintas/export/{id}', [PelayananKecelakaanLaluLintasController::class, 'export'])->name('pelayanan-kecelakaan-lalu-lintas.export');

});

Route::get('/superadmin', [SuperAdminController::class, 'index'])->name('superadmin.dashboard.index');
Route::prefix('superadmin')->group(function () {
    Route::name('superadmin.')->group(function (){
        //users
        Route::get('/users', [SuperAdminController::class, 'users'])->name('users.index');
        Route::patch('/users/reset/{id}', [SuperAdminController::class, 'Reset'])->name('users.reset');
        Route::post('/users', [SuperAdminController::class, 'createUser'])->name('users.create');
        Route::patch('/users/{id}', [SuperAdminController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{id}', [SuperAdminController::class, 'deleteUser'])->name('users.delete');
        //officers
        Route::get('/officers', [SuperAdminController::class, 'officers'])->name('officers.index');
        Route::post('/officers', [SuperAdminController::class, 'createOfficer'])->name('officers.create');
        Route::patch('/officers/{id}', [SuperAdminController::class, 'updateOfficer'])->name('officers.update');
        Route::delete('/officers/{id}', [SuperAdminController::class, 'deleteOfficer'])->name('officers.delete');
        //operasional
        Route::get('/operasionals', [SuperAdminController::class, 'operasional'])->name('operasional.index');
        Route::post('/operasionals', [SuperAdminController::class, 'createOperasional'])->name('operasional.create');
        Route::patch('/operasionals/{id}', [SuperAdminController::class, 'updateOperasional'])->name('operasional.update');
        Route::delete('/operasionals/{id}', [SuperAdminController::class, 'deleteOperasional'])->name('operasional.delete');
        //kategori
        Route::get('/category', [SuperAdminController::class, 'category'])->name('category.index');
        Route::post('/category', [SuperAdminController::class, 'createCategory'])->name('category.create');
        Route::patch('/category/{id}', [SuperAdminController::class, 'updateCategory'])->name('category.update');
        Route::delete('/category/{id}', [SuperAdminController::class, 'deleteCategory'])->name('category.delete');
        //lokasi aset
        Route::get('/lokasi-aset', [SuperAdminController::class, 'lokasi'])->name('lokasi.index');
        Route::post('/lokasi-aset', [SuperAdminController::class, 'createLokasi'])->name('lokasi.create');
        Route::patch('/lokasi-aset/{id}', [SuperAdminController::class, 'updateLokasi'])->name('lokasi.update');
        Route::delete('/lokasi-aset/{id}', [SuperAdminController::class, 'deleteLokasi'])->name('lokasi.delete');
        //jenis gangguan
        Route::get('/jenis-gangguan', [SuperAdminController::class, 'gangguan'])->name('gangguan.index');
        Route::post('/jenis-gangguan', [SuperAdminController::class, 'createGangguan'])->name('gangguan.create');
        Route::patch('/jenis-gangguan/{id}', [SuperAdminController::class, 'updateGangguan'])->name('gangguan.update');
        Route::delete('/jenis-gangguan/{id}', [SuperAdminController::class, 'deleteGangguan'])->name('gangguan.delete');
        //golongan kendaraan
        Route::get('/golongan-kendaraan', [SuperAdminController::class, 'golonganKendaraan'])->name('golonganKendaraan.index');
        Route::post('/golongan-kendaraan', [SuperAdminController::class, 'createGolonganKendaraan'])->name('golonganKendaraan.create');
        Route::patch('/golongan-kendaraan/{id}', [SuperAdminController::class, 'updateGolonganKendaraan'])->name('golonganKendaraan.update');
        Route::delete('/golongan-kendaraan/{id}', [SuperAdminController::class, 'deleteGolonganKendaraan'])->name('golonganKendaraan.delete');
        //jenis kendaraan
        Route::get('/jenis-kendaraan', [SuperAdminController::class, 'jenisKendaraan'])->name('jenisKendaraan.index');
        Route::post('/jenis-kendaraan', [SuperAdminController::class, 'createJenisKendaraan'])->name('jenisKendaraan.create');
        Route::patch('/jenis-kendaraan/{id}', [SuperAdminController::class, 'updateJenisKendaraan'])->name('jenisKendaraan.update');
        Route::delete('/jenis-kendaraan/{id}', [SuperAdminController::class, 'deleteJenisKendaraan'])->name('jenisKendaraan.delete');
        //cuaca
        Route::get('/cuaca', [SuperAdminController::class, 'cuaca'])->name('cuaca.index');
        Route::post('/cuaca', [SuperAdminController::class, 'createCuaca'])->name('cuaca.create');
        Route::patch('/cuaca/{id}', [SuperAdminController::class, 'updateCuaca'])->name('cuaca.update');
        Route::delete('/cuaca/{id}', [SuperAdminController::class, 'deleteCuaca'])->name('cuaca.delete');
        //sumber informasi
        Route::get('/sumber-informasi', [SuperAdminController::class, 'sumberInformasi'])->name('sumberInformasi.index');
        Route::post('/sumber-informasi', [SuperAdminController::class, 'createSumberInformasi'])->name('sumberInformasi.create');
        Route::patch('/sumber-informasi/{id}', [SuperAdminController::class, 'updateSumberInformasi'])->name('sumberInformasi.update');
        Route::delete('/sumber-informasi/{id}', [SuperAdminController::class, 'deleteSumberInformasi'])->name('sumberInformasi.delete');
        //stasioning
        Route::get('/stasioning', [SuperAdminController::class, 'stasioning'])->name('stasioning.index');
        Route::post('/stasioning', [SuperAdminController::class, 'createStasioning'])->name('stasioning.create');
        Route::patch('/stasioning/{id}', [SuperAdminController::class, 'updateStasioning'])->name('stasioning.update');
        Route::delete('/stasioning/{id}', [SuperAdminController::class, 'deleteStasioning'])->name('stasioning.delete');
        //komponen
        Route::get('/komponen', [SuperAdminController::class, 'komponen'])->name('komponen.index');
        Route::post('/komponen', [SuperAdminController::class, 'createKomponen'])->name('komponen.create');
        Route::patch('/komponen/{id}', [SuperAdminController::class, 'updateKomponen'])->name('komponen.update');
        Route::delete('/komponen/{id}', [SuperAdminController::class, 'deleteKomponen'])->name('komponen.delete');
        //jenis perawatan
        Route::get('/jenis-perawatan', [SuperAdminController::class, 'jenisPerawatan'])->name('jenisPerawatan.index');
        Route::post('/jenis-perawatan', [SuperAdminController::class, 'createJenisPerawatan'])->name('jenisPerawatan.create');
        Route::patch('/jenis-perawatan/{id}', [SuperAdminController::class, 'updateJenisPerawatan'])->name('jenisPerawatan.update');
        Route::delete('/jenis-perawatan/{id}', [SuperAdminController::class, 'deleteJenisPerawatan'])->name('jenisPerawatan.delete');
        //unit perawatan
        Route::get('/unit-perawatan', [SuperAdminController::class, 'unitPerawatan'])->name('unitPerawatan.index');
        Route::post('/unit-perawatan', [SuperAdminController::class, 'createUnitPerawatan'])->name('unitPerawatan.create');
        Route::patch('/unit-perawatan/{id}', [SuperAdminController::class, 'updateUnitPerawatan'])->name('unitPerawatan.update');
        Route::delete('/unit-perawatan/{id}', [SuperAdminController::class, 'deleteUnitPerawatan'])->name('unitPerawatan.delete');
    });
  
});

// $randomString = Str::random(10);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout.index');
Route::get('/LogoutCuy', [LoginController::class, 'logout'])->name('logout');




