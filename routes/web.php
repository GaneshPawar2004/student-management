<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\StudentController;

Route::get('/health', function () {
    return response()->json(['status' => 'ok', 'time' => now()->toDateTimeString()]);
});

Route::get('/', [WelcomeController::class, 'index']);
Route::resource('students', StudentController::class);