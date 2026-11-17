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

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/pilihrole', function () {
    return view('auth.roleselect');
})->name('pilihrole');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login/{role}', [AuthController::class, 'showRoleLogin'])->name('login.role');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register/{role}', [AuthController::class, 'showRoleRegister'])->name('register.role');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Protected Routes (Wajib Login & Disesuaikan Per Role)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Route khusus Mahasiswa
    Route::middleware(['role:mahasiswa'])->group(function () {
        Route::get('/biodata', [DataKesehatanController::class, 'showBiodataForm'])->name('biodata.create');
        Route::post('/biodata', [DataKesehatanController::class, 'storeBiodata'])->name('biodata.store');

        Route::get('/kesehatan/input', [DataKesehatanController::class, 'create'])->name('kesehatan.create');
        Route::post('/kesehatan/store', [DataKesehatanController::class, 'store'])->name('kesehatan.store');
        Route::get('/kesehatan/riwayat', [DataKesehatanController::class, 'index'])->name('kesehatan.index');
        Route::get('/kesehatan/kantin', [DataKesehatanController::class, 'kantin'])->name('kesehatan.kantin');

        Route::get('/kesehatan/export-pdf', [DataKesehatanController::class, 'exportPdf'])->name('kesehatan.pdf');
    });

    // Route khusus Ahli Gizi
    Route::middleware(['role:ahli_gizi'])->group(function () {
        Route::get('/gizi/dashboard', [GiziController::class, 'index'])->name('gizi.dashboard');
        Route::post('/gizi/rekomendasi/{id}', [GiziController::class, 'storeRekomendasi'])->name('gizi.rekomendasi.store');
    });

    // Route khusus Admin
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::post('/admin/menu/store', [AdminController::class, 'store'])->name('admin.menu.store');
        Route::put('/admin/menu/update/{id}', [AdminController::class, 'update'])->name('admin.menu.update');
        Route::delete('/admin/menu/delete/{id}', [AdminController::class, 'destroy'])->name('admin.menu.destroy');
    });



});
