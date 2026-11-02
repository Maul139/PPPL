<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataKesehatanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GiziController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// 1. Landing Page Utama saat buka http://127.0.0.1:8000/
Route::get('/', function () {
    return view('landing');
})->name('landing');

// 2. Pilih Role (Mahasiswa / Ahli Gizi)
Route::get('/pilihrole', function () {
    return view('auth.roleselect');
})->name('pilihrole');

// 3. Auth Routes Dynamic
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login/{role}', [AuthController::class, 'showRoleLogin'])->name('login.role');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register/{role}', [AuthController::class, 'showRoleRegister'])->name('register.role');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Protected Routes (Wajib Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/biodata', [DataKesehatanController::class, 'showBiodataForm'])->name('biodata.create');
    Route::post('/biodata', [DataKesehatanController::class, 'storeBiodata'])->name('biodata.store');

    Route::get('/kesehatan/input', [DataKesehatanController::class, 'create'])->name('kesehatan.create');
    Route::post('/kesehatan/store', [DataKesehatanController::class, 'store'])->name('kesehatan.store');
    Route::get('/kesehatan/riwayat', [DataKesehatanController::class, 'index'])->name('kesehatan.index');

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/gizi/dashboard', [GiziController::class, 'index'])->name('gizi.dashboard');
    Route::post('/gizi/rekomendasi/{id}', [GiziController::class, 'storeRekomendasi'])->name('gizi.rekomendasi.store');

});
