<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;


// Authentication routes
Route::get('/', [AuthController::class, 'login'] );
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'registerView'] );
Route::post('/register', [AuthController::class, 'register'] );

Route::get('/dashboard', function () {
    return view('pages.dashboard');
});

Route::get('/resident', [ResidentController::class, 'index']);
Route::get('/resident/create', [ResidentController::class, 'create']);
Route::get('/resident/{id}', [ResidentController::class, 'edit']);
Route::post('/resident', [ResidentController::class, 'store']);
Route::put('/resident/{id}', [ResidentController::class, 'update']);
Route::delete('/resident/{id}', [ResidentController::class, 'destroy']);

Route::resource('employee', PegawaiController::class);
Route::get('/employee/create', [PegawaiController::class, 'create']);
Route::get('/employee/{id}', [PegawaiController::class, 'edit']);
Route::post('/employee', [PegawaiController::class, 'store']);
Route::put('/employee/{id}', [PegawaiController::class, 'update']);
Route::delete('/employee/{id}', [PegawaiController::class, 'destroy']);

Route::get('/kriteria', [KriteriaController::class, 'index']);
Route::get('/kriteria/create', [KriteriaController::class, 'create']);
Route::get('/kriteria/{kode}', [KriteriaController::class, 'edit']);
Route::put('/kriteria/{kode}', [KriteriaController::class, 'update']);
Route::post('/kriteria', [KriteriaController::class, 'store']);
Route::delete('/kriteria/{kode}', [KriteriaController::class, 'destroy']);

Route::get('/penilaian', function () {
    return view('pages.penilaian.index');
});

Route::get('/perhitungan', function () {
    return view('pages.perhitungan.index');
});

Route::get('/hasil', function () {
    return view('pages.hasil.index');
});

Route::get('/monitoring', function () {
    return view('pages.monitoring.index');
});

Route::get('/report', function () {
    return view('pages.report.index');
});
