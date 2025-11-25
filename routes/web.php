<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\AtletController;


// LOGIN
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('user.logout');

// register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');


//profile
Route::get('/profile', function () {
    return view('profil.profil');
})->middleware('auth')->name('profile');


// CRUD ATLET
Route::resource('atlet', AtletController::class);

//----------------------------
// PENGAJUAN
//----------------------------

// FORM pengajuan edit atlet
Route::get(
    '/pengajuan/edit/{id}',
    [PengajuanController::class, 'formEdit']
)
    ->name('pengajuan.formEdit');

// POST kirim pengajuan edit atlet
Route::post(
    '/pengajuan/edit/{id}',
    [PengajuanController::class, 'pengajuanEdit']
)
    ->name('pengajuan.edit');

// FORM pengajuan hapus atlet
Route::get(
    '/pengajuan/hapus/{id}',
    [PengajuanController::class, 'formHapus']
)
    ->name('pengajuan.formHapus');

// POST kirim pengajuan hapus atlet
Route::post(
    '/pengajuan/hapus/{id}',
    [PengajuanController::class, 'pengajuanHapus']
)
    ->name('pengajuan.hapus');

// Halaman admin melihat semua pengajuan
Route::get(
    '/pengajuan',
    [PengajuanController::class, 'index']
)
    ->name('pengajuan.index');

// APPROVE & REJECT (SUPER ADMIN)
Route::post(
    '/pengajuan/{id}/approve',
    [PengajuanController::class, 'approve']
)
    ->name('pengajuan.approve');

Route::post(
    '/pengajuan/{id}/reject',
    [PengajuanController::class, 'reject']
)
    ->name('pengajuan.reject');
