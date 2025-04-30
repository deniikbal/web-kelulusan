<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GraduationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cek-kelulusan', [GraduationController::class, 'index']);
Route::post('/api/check-graduation', [GraduationController::class, 'check']);
