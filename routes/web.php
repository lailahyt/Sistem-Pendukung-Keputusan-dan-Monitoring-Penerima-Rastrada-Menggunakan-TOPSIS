<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResidentController;

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
});

Route::get('/resident', [ResidentController::class, 'index']);
Route::get('/resident/create', [ResidentController::class, 'create']);
Route::get('/resident/{id}', [ResidentController::class, 'edit']);
Route::post('/resident', [ResidentController::class, 'store']);
Route::put('/resident/{id}', [ResidentController::class, 'update']);
Route::delete('/resident/{id}', [ResidentController::class, 'destroy']);

Route::get('/kriteria', function () {
    return view('pages.kriteria.index');
});

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
