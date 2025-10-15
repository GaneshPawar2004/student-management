<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\StudentController;

Route::get('/health', function () {
    return response()->json(['status' => 'ok', 'time' => now()->toDateTimeString()]);
});

Route::get('/', [WelcomeController::class, 'index']);
Route::resource('students', StudentController::class);
Route::get('students/{student}/restore', [StudentController::class, 'restore'])->name('students.restore');
Route::delete('students/{student}/force', [StudentController::class, 'forceDelete'])->name('students.force-delete');