<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\AtletController;


// =====================
// LOGIN
// =====================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('user.logout');


// =====================
// HARUS LOGIN
// =====================
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard-user');
    })->name('user.dashboard');


    // =====================
    // CRUD ATLET
    // =====================
    Route::resource('atlet', AtletController::class);


    // ================================
    //           PENGAJUAN
    // ================================

    // FORM pengajuan edit atlet
    Route::get('/pengajuan/edit/{id}', 
        [PengajuanController::class, 'formEdit'])
        ->name('pengajuan.formEdit');

    // KIRIM pengajuan edit
    Route::post('/pengajuan/edit/{id}', 
        [PengajuanController::class, 'pengajuanEdit'])
        ->name('pengajuan.edit');


    // FORM pengajuan hapus atlet
    Route::get('/pengajuan/hapus/{id}', 
        [PengajuanController::class, 'formHapus'])
        ->name('pengajuan.formHapus');

    // KIRIM pengajuan hapus
    Route::post('/pengajuan/hapus/{id}', 
        [PengajuanController::class, 'pengajuanHapus'])
        ->name('pengajuan.hapus');


    // Halaman admin melihat semua pengajuan
    Route::get('/pengajuan', 
        [PengajuanController::class, 'index'])
        ->name('pengajuan.index');


    // =====================
    // APPROVE / REJECT oleh SUPER ADMIN
    // =====================
    Route::post('/pengajuan/{id}/approve', 
        [PengajuanController::class, 'approve'])
        ->name('pengajuan.approve');

    Route::post('/pengajuan/{id}/reject', 
        [PengajuanController::class, 'reject'])
        ->name('pengajuan.reject');
});
