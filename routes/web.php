<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataKesehatanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GiziController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kesehatan/input', [DataKesehatanController::class, 'create'])->name('kesehatan.create');
Route::post('/kesehatan/store', [DataKesehatanController::class, 'store'])->name('kesehatan.store');
Route::get('/kesehatan/riwayat', [DataKesehatanController::class, 'index'])->name('kesehatan.index');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('kesehatan.index');
    });

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/gizi/dashboard', [GiziController::class, 'index'])->name('gizi.dashboard');
    Route::get('/kesehatan/input', [DataKesehatanController::class, 'create'])->name('kesehatan.create');
    Route::post('/kesehatan/store', [DataKesehatanController::class, 'store'])->name('kesehatan.store');
    Route::get('/kesehatan/riwayat', [DataKesehatanController::class, 'index'])->name('kesehatan.index');

});
