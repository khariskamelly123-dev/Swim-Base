<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\AtletController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\PrestasiApiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\superadminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SchunivController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;


// middleware alias 'role' is registered in Kernel
//langsung route redirect saat pertama kali buka web
Route::get('/', function () {
    return redirect('/welcome'); // ganti ke '/...' kalau ingin ke halaman lain
});

// DASHBOARD
Route::get('/dashboard_klub', [DashboardController::class, 'dashboard_klub'])
    ->middleware('role:klub') // <--- GABUNG DI SINI
    ->name('dashboard_klub');



// LOGIN SELECTION
Route::get('/welcome', [LoginController::class, 'welcome_selection'])->name('welcome');

// CLUB
Route::get('/club_login', [ClubController::class, 'club'])->name('club.login');
Route::get('/regis_club', [ClubController::class, 'regis_club'])->name('club.register');
Route::post('/regis_club', [ClubController::class, 'club_register'])->name('club.register.process');
Route::post('/club_login_process', [ClubController::class, 'club_login_process'])->middleware('throttle:5,1')->name('club.login.process');
Route::post('/club_logout', [ClubController::class, 'club_logout'])->name('club.logout');


// login admin
Route::get('/admin_login', [adminController::class, 'admin'])->name('admin_login');
Route::post('/admin_login_process', [adminController::class, 'admin_login_process'])->name('admin.login.process');

// register admin (show + process)
Route::get('/regis_admin', [adminController::class, 'regis_admin'])->name('regis_admin');
Route::post('/regis_admin', [adminController::class, 'admin_register_process'])->name('admin.register.process');

// login super admin
Route::get('/superadmin_login', [superadminController::class, 'superadmin'])->name('superadmin_login');
Route::post('/superadmin_login_process', [superadminController::class, 'superadmin_login_process'])->name('superadmin.login.process');

// SEKOLAH / UNIVERSITAS
Route::get('/', [SchunivController::class, 'welcome_selection'])->name('welcome');
Route::middleware('guest:sekouniv')->group(function () {
    // Login
    Route::get('/schuniv/login', [SchunivController::class, 'schuniv'])->name('schuniv.login');
    Route::post('/schuniv/login', [SchunivController::class, 'schuniv_login_process'])->name('schuniv.login.process');
    
    // Register
    Route::get('/schuniv/register', [SchunivController::class, 'regis_schuniv'])->name('schuniv.register');
    Route::post('/schuniv/register', [SchunivController::class, 'schuniv_register'])->name('schuniv.register.process');
});

Route::middleware(['auth:sekouniv'])->group(function () {
    
    // Dashboard Sekolah
    Route::get('/schuniv/dashboard', function () {
        return view('dashboard_schuniv');
    })->name('dashboard_schuniv');

    // Logout Sekolah
    Route::post('/schuniv/logout', [SchunivController::class, 'schuniv_logout'])->name('schuniv.logout');
});



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

// Contoh untuk API (yang lama pakai defaults, sekarang hapus defaults-nya):
Route::group(['prefix' => 'api', 'middleware' => 'role:klub,sekolah,admin,superadmin'], function () {
    Route::resource('prestasis', PrestasiApiController::class)->only(['index','store','show','update','destroy']);
});

// Contoh untuk Kategori & Event:
Route::group(['middleware' => ['auth', 'role:admin,superadmin']], function () {
    Route::resource('kategoris', KategoriController::class)->except(['create','edit']);
    // ...
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




Route::middleware(['auth:club'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard_klub', [DashboardController::class, 'dashboard_klub'])
        ->name('dashboard_klub');
    
    // Profil
    Route::get('/profil', [DashboardController::class, 'profil'])
        ->name('profil.index');

    Route::resource('atlet', AtletController::class);
    Route::post('/atlet/{id}/request-update', [PengajuanController::class, 'pengajuanEdit'])->name('atlet.request_update');
    Route::post('/atlet/{id}/request-delete', [PengajuanController::class, 'pengajuanHapus'])->name('atlet.request_delete');
    Route::resource('kategori', KategoriController::class);
    Route::resource('event', EventController::class);
});

Route::middleware(['auth:superadmin'])->group(function () {
    Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('admin.pengajuan.index');
    Route::post('/pengajuan/{id}/approve', [PengajuanController::class, 'approve'])->name('admin.pengajuan.approve');
    Route::post('/pengajuan/{id}/reject', [PengajuanController::class, 'reject'])->name('admin.pengajuan.reject');
});