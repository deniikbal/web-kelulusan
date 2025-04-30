<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GraduationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cek-kelulusan', [GraduationController::class, 'index']);
Route::post('/cek-kelulusan', [GraduationController::class, 'check']);
