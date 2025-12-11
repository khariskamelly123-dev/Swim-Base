<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\AtletController;
use App\Http\Controllers\ClubLoginContoller;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\PrestasiApiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\superadminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;

use Illuminate\Support\Facades\Auth;
// middleware alias 'role' is registered in Kernel
//langsung route redirect saat pertama kali buka web
Route::get('/', function () {
    return redirect('/welcome'); // ganti ke '/...' kalau ingin ke halaman lain
});

// DASHBOARD
Route::get('/dashboard_user', [DashboardController::class, 'dashboard'])->name('dashboard_user');
Route::get('/dashboard_afterlogin', [DashboardController::class, 'dashboard_afterlogin'])
    ->middleware('role')
    ->defaults('roles', 'klub,sekolah,admin,superadmin')
    ->name('dashboard_afterlogin');



// LOGIN SELECTION
Route::get('/welcome', [LoginController::class, 'welcome_selection'])->name('welcome');

// CLUB
Route::get('/club_login', [ClubLoginContoller::class, 'club'])->name('club.login');
Route::get('/regis_club', [ClubLoginContoller::class, 'regis_club'])->name('club.register');
Route::post('/regis_club', [ClubLoginContoller::class, 'club_register'])->name('club.register.process');
Route::post('/club_login_process', [ClubLoginContoller::class, 'club_login_process'])->middleware('throttle:5,1')->name('club.login.process');
Route::post('/club_logout', [ClubLoginContoller::class, 'club_logout'])->name('club.logout');


// login admin
Route::get('/admin_login', [adminController::class, 'admin'])->name('admin_login');
Route::post('/admin_login_process', [adminController::class, 'admin_login_process'])->name('admin.login.process');

// register admin (show + process)
Route::get('/regis_admin', [adminController::class, 'regis_admin'])->name('regis_admin');
Route::post('/regis_admin', [adminController::class, 'admin_register_process'])->name('admin.register.process');

// login super admin
Route::get('/superadmin_login', [superadminController::class, 'superadmin'])->name('superadmin_login');
Route::post('/superadmin_login_process', [superadminController::class, 'superadmin_login_process'])->name('superadmin.login.process');


// seko_univ
Route::get('/login', [LoginController::class, 'seko_univ'])->name('login');
Route::get('/schuniv_regis', [LoginController::class, 'regis_seko_univ'])->name('sekouniv_register');
Route::post('/schuniv_regis', [LoginController::class, 'sekouniv_register'])->name('sekouniv.register.process');
Route::post('/sekouniv_login_process', [LoginController::class, 'sekouniv_login_process'])->middleware('throttle:5,1')->name('sekouniv.login.process');
Route::post('/sekouniv_logout', [LoginController::class, 'sekouniv_logout'])->name('sekouniv.logout');

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

//PRESTASI
Route::get('/prestasi', [PrestasiController::class, 'indexprestasi'])->name('prestasi');

// API: Prestasi resource (create/read/update/delete) - allow klub/sekolah/admin
Route::group(['prefix' => 'api', 'middleware' => 'role', 'defaults' => ['roles' => 'klub,sekolah,admin,superadmin']], function () {
    Route::resource('prestasis', PrestasiApiController::class)->only(['index','store','show','update','destroy']);
});

// Kategori & Event resource routes (admin)
Route::group(['middleware' => ['auth','role'], 'defaults' => ['roles' => 'admin,superadmin']], function () {
    Route::resource('kategoris', KategoriController::class)->except(['create','edit']);
    Route::resource('events', EventController::class)->except(['create','edit']);
    // Activity logs (admin)
    Route::get('activity-logs', [ActivityLogController::class,'index'])->name('activity.logs');
});

//ATLET
Route::get('/atlet', [AtletController::class, 'index'])->name('atlet.index');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//DASHBOARD SUPERADMIN
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'role'])
    ->defaults('roles', 'superadmin')
    ->name('dashboard');

//DASHBOARD ADMIN
Route::get('/dashboard_admin', [DashboardController::class, 'admin'])
    ->middleware(['auth', 'role'])
    ->defaults('roles', 'admin,superadmin')
    ->name('dashboard_admin');



// (logout handled by controller above)

