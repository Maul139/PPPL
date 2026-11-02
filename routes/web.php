<?php

use Illuminate\Support\Facades\Route;

Route::get('/kesehatan/input', function () {
    return view('kesehatan.input');
});
Route::get('/', function () {
    return view('welcome');
})
;
