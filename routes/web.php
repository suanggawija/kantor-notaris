<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KlienController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\RakController;
use App\Http\Controllers\UserController;
use App\Mail\PengajuanShipped;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;


// Route::get('/send', function () {
//     Mail::to('suanggawija@gmail.com')->send(new PengajuanShipped);
// });


Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('user', UserController::class);
    Route::resource('rak', RakController::class);
    Route::resource('klien', KlienController::class);
    Route::resource('pembayaran', PembayaranController::class);
    Route::resource('permohonan', PermohonanController::class);
    Route::resource('log', LogController::class);
    Route::resource('notifikasi', NotifikasiController::class);
    Route::resource('laporan', LaporanController::class);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login_form'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});
