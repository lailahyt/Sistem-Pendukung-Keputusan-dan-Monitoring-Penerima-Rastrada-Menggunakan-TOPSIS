<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubkriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\TopsisController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\BantuanLainController;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/debug-request', function (Request $request) {

    dd([
        'url' => url('/'),
        'fullUrl' => $request->fullUrl(),
        'secure' => $request->secure(),
        'scheme' => $request->getScheme(),
        'host' => $request->getHost(),
        'headers' => $request->headers->all(),
    ]);
});


// Landing Page
Route::get('/', [LandingController::class, 'index']);
// Authentication
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);
// Route::get('/register', [AuthController::class, 'registerView']);
// Route::post('/register', [AuthController::class, 'register']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('role:Admin,Petugas,Lurah,RT/RW');

Route::get('/resident', [ResidentController::class, 'index'])->middleware(['role:Admin,Petugas,Lurah,RT/RW']);
Route::get('/resident/create', [ResidentController::class, 'create'])->middleware(['role:Admin,Petugas,Lurah,RT/RW']);
Route::get('/resident/{id}', [ResidentController::class, 'edit'])->middleware(['role:Admin,Petugas,Lurah,RT/RW']);
Route::post('/resident', [ResidentController::class, 'store'])->middleware(['role:Admin,Petugas,Lurah,RT/RW']);
Route::put('/resident/{id}', [ResidentController::class, 'update'])->middleware(['role:Admin,Petugas,Lurah,RT/RW']);
Route::delete('/resident/{id}', [ResidentController::class, 'destroy'])->middleware(['role:Admin,Petugas,Lurah,RT/RW']);
Route::post('/resident/{resident}/ajukan', [ResidentController::class, 'ajukan'])->middleware(['role:RT/RW']);

Route::get('/bantuan-lain', [BantuanLainController::class, 'index'])->middleware(['role:Admin,Petugas,Lurah']);
Route::get('/bantuan-lain/create', [BantuanLainController::class, 'create'])->middleware(['role:Petugas']);
Route::post('/bantuan-lain', [BantuanLainController::class, 'store'])->middleware(['role:Petugas']);
Route::get('/bantuan-lain/{id}/edit', [BantuanLainController::class, 'edit'])->middleware(['role:Petugas']);
Route::put('/bantuan-lain/{id}', [BantuanLainController::class, 'update'])->middleware(['role:Petugas']);
Route::delete('/bantuan-lain/{id}', [BantuanLainController::class, 'destroy'])->middleware(['role:Petugas']);

Route::get('/employee', [PegawaiController::class, 'index'])->middleware(['role:Admin']);
Route::get('/employee/create', [PegawaiController::class, 'create'])->middleware(['role:Admin']);
Route::get('/employee/{id}/edit', [PegawaiController::class, 'edit'])->middleware(['role:Admin']);
Route::post('/employee', [PegawaiController::class, 'store'])->middleware(['role:Admin']);
Route::put('/employee/{id}', [PegawaiController::class, 'update'])->middleware(['role:Admin']);
Route::delete('/employee/{id}', [PegawaiController::class, 'destroy'])->middleware(['role:Admin']);

Route::get('/kriteria', [KriteriaController::class, 'index'])->middleware(['role:Admin,Petugas,Lurah']);
Route::get('/kriteria/create', [KriteriaController::class, 'create'])->middleware(['role:Admin,Petugas']);
Route::get('/kriteria/{kode}', [KriteriaController::class, 'edit'])->middleware(['role:Admin,Petugas']);
Route::put('/kriteria/{kode}', [KriteriaController::class, 'update'])->middleware(['role:Admin,Petugas']);
Route::post('/kriteria', [KriteriaController::class, 'store'])->middleware(['role:Admin,Petugas']);
Route::delete('/kriteria/{kode}', [KriteriaController::class, 'destroy'])->middleware(['role:Admin,Petugas']);
Route::put('/kriteria/{id}/toggle', [KriteriaController::class, 'toggle'])->middleware(['role:Admin']);

Route::get('/kriteria/{id}/subkriteria', [SubkriteriaController::class, 'index'])->middleware(['role:Admin,Petugas,Lurah']);
Route::get('/kriteria/{id}/subkriteria/create', [SubkriteriaController::class, 'create'])->middleware(['role:Admin']);
Route::post('/kriteria/{id}/subkriteria', [SubkriteriaController::class, 'store'])->middleware(['role:Admin,Petugas']);
Route::put('/subkriteria/{id}', [SubkriteriaController::class, 'update'])->middleware(['role:Admin']);
Route::delete('/subkriteria/{id}', [SubkriteriaController::class, 'destroy'])->middleware(['role:Admin']);

Route::get('/penilaian', [PenilaianController::class, 'index'])->middleware(['role:Admin,Petugas']);
Route::get('/penilaian/{id}', [PenilaianController::class, 'create'])->middleware(['role:Admin,Petugas']);
Route::get('/penilaian/{id}/edit', [PenilaianController::class, 'edit'])->middleware(['role:Admin,Petugas']);
Route::put('/penilaian/{id}', [PenilaianController::class, 'update'])->middleware(['role:Admin,Petugas']);
Route::post('/penilaian/store', [PenilaianController::class, 'store'])->middleware(['role:Admin,Petugas']);
Route::get('/penilaian/detail-json/{id}', [PenilaianController::class, 'detailJson'])->middleware(['role:Admin,Petugas']);
Route::delete('/penilaian/{id}', [PenilaianController::class, 'destroy'])->middleware(['role:Admin,Petugas']);

Route::resource('periode', PeriodeController::class)->middleware(['role:Admin, Lurah']);

Route::middleware(['role:Lurah'])->group(function () {

    Route::get(
        '/kuota-penerima',
        [PeriodeController::class, 'kuotaIndex']
    )->name('kuota.index');

    Route::put(
        '/kuota-penerima/{periode}',
        [PeriodeController::class, 'updateKuota']
    )->name('kuota.update');
});


Route::get('/topsis', [TopsisController::class, 'index'])->middleware(['role:Admin,Petugas']);

Route::get('/hasil', [HasilController::class, 'index'])->middleware(['role:Admin,Petugas,Lurah']);
Route::post('/hasil/tetapkan-kuota', [MonitoringController::class, 'tetapkanKuota'])
    ->middleware(['role:Lurah'])
    ->name('hasil.tetapkan.kuota');

Route::get('/monitoring', [MonitoringController::class, 'index'])->middleware(['role:Admin,Petugas,Lurah']);
Route::get('/monitoring/{id}/edit', [MonitoringController::class, 'edit'])->middleware(['role:Admin,Petugas']);
Route::put('/monitoring/{id}', [MonitoringController::class, 'update'])->middleware(['role:Admin,Petugas']);
Route::get('/monitoring/{id}', [MonitoringController::class, 'show'])->middleware(['role:Admin,Petugas,Lurah']);
Route::delete('/monitoring/{id}/batalkan', [MonitoringController::class, 'batalkan'])->name('monitoring.batalkan');

Route::get('/report', [LaporanController::class, 'index'])->middleware(['role:Admin,Petugas,Lurah']);
Route::get('/report/export-pdf', [LaporanController::class, 'exportPdf'])->middleware(['role:Admin,Petugas,Lurah']);
Route::get('/report/export-excel', [LaporanController::class, 'exportExcel'])->middleware(['role:Admin,Petugas,Lurah']);

Route::get('/account-list', [UserController::class, 'account_list_view'])->middleware(['role:Admin']);

// Route::get('/account-request', [UserController::class, 'account_request_view'])->middleware(['role:Admin']);
// Route::post('/account-request/approval/{id}', [UserController::class, 'account_approval'])->middleware(['role:Admin']);

Route::get('/account-list/create', [UserController::class, 'account_create_view'])
    ->middleware(['role:Admin'])
    ->name('account.create');

Route::post('/account-list/store', [UserController::class, 'account_store'])
    ->middleware(['role:Admin'])
    ->name('account.store');

Route::get('/account-list/{id}/edit', [UserController::class, 'account_edit_view'])
    ->middleware(['role:Admin'])
    ->name('account.edit');

Route::put('/account-list/{id}', [UserController::class, 'account_update'])
    ->middleware(['role:Admin'])
    ->name('account.update');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::put('/profile/update', [ProfileController::class, 'update']);
Route::get('/profile/ubah-password', [ProfileController::class, 'ubahPassword']);
Route::put('/profile/update-password', [ProfileController::class, 'updatePassword']);
