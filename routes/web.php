<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controllers
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\SchunivController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\superadminController;
use App\Http\Controllers\AtletController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RekorController; // Pastikan buat controller ini untuk Input FP

/*
|--------------------------------------------------------------------------
| 1. PUBLIC & AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('welcome');
});

Route::get('/welcome', [LoginController::class, 'welcome_selection'])->name('welcome');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// --- AUTH: CLUB ---
Route::get('/club_login', [ClubController::class, 'club'])->name('club.login');
Route::post('/club_login_process', [ClubController::class, 'club_login_process'])->middleware('throttle:5,1')->name('club.login.process');
Route::get('/regis_club', [ClubController::class, 'regis_club'])->name('club.register');
Route::post('/regis_club', [ClubController::class, 'club_register'])->name('club.register.process');

// --- AUTH: SEKOLAH / UNIV ---
Route::get('/schuniv/login', [SchunivController::class, 'schuniv'])->name('schuniv.login');
Route::post('/schuniv/login', [SchunivController::class, 'schuniv_login_process'])->name('schuniv.login.process');
Route::get('/schuniv/register', [SchunivController::class, 'regis_schuniv'])->name('schuniv.register');
Route::post('/schuniv/register', [SchunivController::class, 'schuniv_register'])->name('schuniv.register.process');

// --- AUTH: ADMIN ---
Route::get('/admin_login', [adminController::class, 'admin'])->name('admin_login');
Route::post('/admin_login_process', [adminController::class, 'admin_login_process'])->name('admin.login.process');
Route::get('/regis_admin', [adminController::class, 'regis_admin'])->name('regis_admin'); // Hati-hati membuka registrasi admin ke publik
Route::post('/regis_admin', [adminController::class, 'admin_register_process'])->name('admin.register.process');

// --- AUTH: SUPER ADMIN ---
Route::get('/superadmin_login', [superadminController::class, 'superadmin'])->name('superadmin_login');
Route::post('/superadmin_login_process', [superadminController::class, 'superadmin_login_process'])->name('superadmin.login.process');


/*
|--------------------------------------------------------------------------
| 2. GROUP: SUPER ADMIN (Sesuai Sidebar)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:superadmin'])->group(function () {
    
    // Dashboard Utama
    Route::get('/super/dashboard', [DashboardController::class, 'index'])->name('super.dashboard');

    // Master Data User
    Route::get('/super/users', [superadminController::class, 'manage_users'])->name('super.users.index');

    // Pusat Validasi (Approval)
    Route::prefix('super/approval')->name('super.approval.')->group(function() {
        // Halaman List Pengajuan Edit
        Route::get('/edit', [PengajuanController::class, 'listEdit'])->name('edit');
        // Halaman List Pengajuan Hapus
        Route::get('/hapus', [PengajuanController::class, 'listHapus'])->name('hapus');
        
        // Action Approve/Reject
        Route::post('/{id}/approve', [PengajuanController::class, 'approve'])->name('action.approve');
        Route::post('/{id}/reject', [PengajuanController::class, 'reject'])->name('action.reject');
    });
});


/*
|--------------------------------------------------------------------------
| 3. GROUP: ADMIN (Operator Lomba)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:admin'])->group(function () {
    
    // Dashboard Admin
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

    // Manajemen Event (List Kompetisi)
    Route::get('/admin/events', [EventController::class, 'indexAdmin'])->name('admin.event.list');

    // Pencatatan Rekor (Input FP)
    // Anda perlu membuat method 'inputFp' di RekorController/EventController
    Route::get('/admin/input-fp', [EventController::class, 'inputFp'])->name('admin.input.fp');
    Route::post('/admin/input-fp', [EventController::class, 'storeFp'])->name('admin.store.fp');

    // Verifikasi Rekor
    Route::get('/admin/verifikasi-rekor', [EventController::class, 'verifikasi'])->name('admin.rekor.verifikasi');
});


/*
|--------------------------------------------------------------------------
| 4. GROUP: USER (KLUB & SEKOLAH)
|--------------------------------------------------------------------------
| Karena Sidebar Klub dan Sekolah SAMA, kita samakan struktur routenya.
| Menggunakan middleware group terpisah karena guard auth-nya beda.
*/

// --- Routes untuk KLUB ---
Route::middleware(['auth:club'])->group(function () {
    
    Route::get('/dashboard_klub', [DashboardController::class, 'dashboard_klub'])->name('dashboard_klub');
    Route::get('/profil_klub', [DashboardController::class, 'profil'])->name('profil.index');

    // CRUD Atlet
    Route::resource('atlet', AtletController::class);

    // Request Edit/Hapus
    Route::post('/atlet/{id}/request-update', [PengajuanController::class, 'pengajuanEdit'])->name('atlet.request_update');
    Route::post('/atlet/{id}/request-delete', [PengajuanController::class, 'pengajuanHapus'])->name('atlet.request_delete');

    // Status Pengajuan
    Route::get('/status-pengajuan', [PengajuanController::class, 'statusSaya'])->name('pengajuan.status');

    // Manajemen Event
    Route::resource('event', EventController::class)->only(['index', 'show']);

    // --- TAMBAHKAN BARIS INI (SOLUSI) ---
    // Menggunakan only(['index']) karena Klub biasanya hanya melihat daftar kategori, tidak mengeditnya.
    Route::resource('kategori', KategoriController::class)->only(['index']); 
});

// --- Routes untuk SEKOLAH / UNIV ---
Route::middleware(['auth:sekouniv'])->group(function () {
    
    // Note: Nama route disamakan polanya atau diarahkan ke controller yang sama jika logic-nya mirip
    // Jika Sidebar Sekolah ingin menggunakan route('dashboard_klub'), Anda harus memberi nama route yg sama 
    // TAPI karena nama route harus unik, lebih baik di sidebar menggunakan logika if(role=='sekolah') route('dashboard_sekolah')
    
    Route::get('/schuniv/dashboard', function () {
        return view('dashboard_schuniv');
    })->name('dashboard_schuniv'); // Nanti sesuaikan di sidebar

    // Gunakan controller yang sama atau buat khusus Sekolah
    Route::resource('atlet-sekolah', AtletController::class); 
    
    // Status Pengajuan
    Route::get('/schuniv/status-pengajuan', [PengajuanController::class, 'statusSaya'])->name('schuniv.pengajuan.status');
});