<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataKesehatanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kesehatan/input', [DataKesehatanController::class, 'create'])->name('kesehatan.create');
Route::post('/kesehatan/store', [DataKesehatanController::class, 'store'])->name('kesehatan.store');
