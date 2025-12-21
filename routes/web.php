<?php

use Illuminate\Support\Facades\Route;

// --- CONTROLLERS IMPORT ---
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AthleteController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AchievementController;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES (Halaman Depan & Guest)
|--------------------------------------------------------------------------
*/

// Halaman Home Utama
Route::get('/', function () { 
    return view('home'); 
})->name('home');

// Pencarian Publik
Route::get('/athletes', [AthleteController::class, 'index'])->name('athletes.index');
Route::get('/achievements', [AchievementController::class, 'index'])->name('achievements.index');
Route::get('/events-list', [EventController::class, 'index'])->name('events.list'); // Nama route ini dipakai di Navbar

// Halaman pemilihan login (Welcome Card)
// ALIAS 'login' ditambahkan di sini agar tombol di Navbar tidak error
Route::get('/welcome', [LoginController::class, 'welcome_selection'])->name('login.selection');
Route::get('/login', [LoginController::class, 'welcome_selection'])->name('login'); 

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| 2. AUTHENTICATION ROUTES (GUEST ONLY)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function() {
    
    // --- CLUB AUTH ---
    Route::prefix('club')->name('club.')->group(function() {
        Route::get('login', [ClubController::class, 'showLoginForm'])->name('login');
        Route::post('login', [ClubController::class, 'loginProcess'])->name('login.process');
        Route::get('register', [ClubController::class, 'showRegisterForm'])->name('register');
    });

    // --- INSTITUTION AUTH ---
    Route::prefix('institution')->name('institution.')->group(function() {
        Route::get('login', [InstitutionController::class, 'showLoginForm'])->name('login');
        Route::post('login', [InstitutionController::class, 'loginProcess'])->name('login.process');
        Route::get('register', [InstitutionController::class, 'showRegisterForm'])->name('register');
    });

    // --- ADMIN & SUPER ADMIN AUTH ---
    Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminController::class, 'loginProcess'])->name('admin.login.process');
    
    Route::get('/superadmin/login', [SuperAdminController::class, 'showLoginForm'])->name('superadmin.login');
    Route::post('/superadmin/login', [SuperAdminController::class, 'loginProcess'])->name('superadmin.login.process');
});


/*
|--------------------------------------------------------------------------
| 3. DASHBOARD ROUTES (AUTH REQUIRED)
|--------------------------------------------------------------------------
| Menyesuaikan dengan logic Navbar: route('dashboard')
*/
Route::middleware(['auth:web'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});


/*
|--------------------------------------------------------------------------
| 4. SUPER ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:super_admin'])->prefix('super-admin')->name('super.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'superAdmin'])->name('dashboard');
    Route::get('/users', [SuperAdminController::class, 'manageUsers'])->name('users.index');
    
    // Approval Center
    Route::prefix('approvals')->name('approval.')->group(function() {
        Route::get('/', [SubmissionController::class, 'index'])->name('index');
        Route::post('/{id}/approve', [SubmissionController::class, 'approve'])->name('approve');
    });
});


/*
|--------------------------------------------------------------------------
| 5. ADMIN ROUTES (Operator Lomba)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
    Route::resource('events', EventController::class);
    Route::get('/achievements/input', [AchievementController::class, 'inputForm'])->name('achievement.input');
});


/*
|--------------------------------------------------------------------------
| 6. CLUB ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:club'])->prefix('club')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'club'])->name('club.dashboard');
    Route::resource('athlete', AthleteController::class);
});

// Placeholders
Route::view('/statistics', 'statistics.index')->name('statistics');
Route::view('/gallery', 'gallery.index')->name('gallery');