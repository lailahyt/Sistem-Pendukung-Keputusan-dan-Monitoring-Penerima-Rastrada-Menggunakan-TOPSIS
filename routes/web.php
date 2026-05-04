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
use App\Models\Penilaian;
use Illuminate\Support\Facades\Route;


// Authentication routes
Route::get('/', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'registerView']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware('role:Admin,Petugas,Lurah');

Route::get('/resident', [ResidentController::class, 'index'])->middleware(['role:Admin,Petugas,Lurah']);
Route::get('/resident/create', [ResidentController::class, 'create'])->middleware(['role:Admin,Petugas,Lurah ']);
Route::get('/resident/{id}', [ResidentController::class, 'edit'])->middleware(['role:Admin,Petugas,Lurah']);
Route::post('/resident', [ResidentController::class, 'store'])->middleware(['role:Admin,Petugas,Lurah']);
Route::put('/resident/{id}', [ResidentController::class, 'update'])->middleware(['role:Admin,Petugas,Lurah']);
Route::delete('/resident/{id}', [ResidentController::class, 'destroy'])->middleware(['role:Admin,Petugas,Lurah']);

Route::get('/employee', [PegawaiController::class, 'index'])->middleware(['role:Admin']);
Route::get('/employee/create', [PegawaiController::class, 'create'])->middleware(['role:Admin']);
Route::get('/employee/{id}', [PegawaiController::class, 'edit'])->middleware(['role:Admin']);
Route::post('/employee', [PegawaiController::class, 'store'])->middleware(['role:Admin']);
Route::put('/employee/{id}', [PegawaiController::class, 'update'])->middleware(['role:Admin']);
Route::delete('/employee/{id}', [PegawaiController::class, 'destroy'])->middleware(['role:Admin']);

Route::get('/kriteria', [KriteriaController::class, 'index'])->middleware(['role:Admin,Petugas']);
Route::get('/kriteria/create', [KriteriaController::class, 'create'])->middleware(['role:Admin,Petugas']);
Route::get('/kriteria/{kode}', [KriteriaController::class, 'edit'])->middleware(['role:Admin,Petugas']);
Route::put('/kriteria/{kode}', [KriteriaController::class, 'update'])->middleware(['role:Admin,Petugas']);
Route::post('/kriteria', [KriteriaController::class, 'store'])->middleware(['role:Admin,Petugas']);
Route::delete('/kriteria/{kode}', [KriteriaController::class, 'destroy'])->middleware(['role:Admin,Petugas']);

Route::get('/kriteria/{id}/subkriteria', [SubkriteriaController::class, 'index'])->middleware(['role:Admin,Petugas']);
Route::get('/kriteria/{id}/subkriteria/create', [SubkriteriaController::class, 'create'])->middleware(['role:Admin,Petugas']);
Route::post('/kriteria/{id}/subkriteria', [SubkriteriaController::class, 'store'])->middleware(['role:Admin,Petugas']);

Route::get('/penilaian', [PenilaianController::class, 'index'])->middleware(['role:Admin,Petugas']);
Route::get('/penilaian/{id}', [PenilaianController::class, 'create'])->middleware(['role:Admin,Petugas']);
Route::get('/penilaian/{id}/edit', [PenilaianController::class, 'edit'])->middleware(['role:Admin,Petugas']);
Route::put('/penilaian/{id}', [PenilaianController::class, 'update'])->middleware(['role:Admin,Petugas']);
Route::post('/penilaian/store', [PenilaianController::class, 'store'])->middleware(['role:Admin,Petugas']);
Route::get('/penilaian/detail-json/{id}', [PenilaianController::class, 'detailJson'])->middleware(['role:Admin,Petugas']);
Route::delete('/penilaian/{id}', [PenilaianController::class, 'destroy'])->middleware(['role:Admin,Petugas']);

Route::resource('periode', PeriodeController::class)->middleware(['role:Admin']);

Route::get('/topsis', [TopsisController::class, 'index'])->middleware(['role:Admin,Petugas']);

Route::get('/account-list', [UserController::class, 'account_list_view'])->middleware(['role:Admin']);

Route::get('/account-request', [UserController::class, 'account_request_view'])->middleware(['role:Admin']);
Route::post('/account-request/approval/{id}', [UserController::class, 'account_approval'])->middleware(['role:Admin']);

// Route::get('/penilaian', function () {
//     return view('pages.penilaian.index');
// });

// Route::get('/perhitungan', function () {
//     return view('pages.perhitungan.index');
// });

// Route::get('/hasil', function () {
//     return view('pages.hasil.index');
// });

// Route::get('/monitoring', function () {
//     return view('pages.monitoring.index');
// });

// Route::get('/report', function () {
//     return view('pages.report.index');
// });
