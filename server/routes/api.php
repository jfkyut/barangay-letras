<?php

use App\Http\Controllers\Profile\PasswordController;
use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/profile', [ProfileController::class,'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class,'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class,'destroy'])->name('profile.delete');
    Route::put('/password', [PasswordController::class,'update'])->name('password.update');

    // councils
    Route::get('/councils', [\App\Http\Controllers\CouncilController::class, 'index'])->name('council.index');

    // sessions
    Route::get('/sessions', [\App\Http\Controllers\OfficeSessionController::class, 'index'])->name('session.index');
    Route::post('/sessions', [\App\Http\Controllers\OfficeSessionController::class, 'store'])->name('session.store');
    Route::put('/session/{session}', [\App\Http\Controllers\OfficeSessionController::class, 'update'])->name('session.update');
    Route::delete('/session/{session}', [\App\Http\Controllers\OfficeSessionController::class, 'destroy'])->name('session.destroy');

    // session types
    Route::get('/session-types', [\App\Http\Controllers\OfficeSessionTypeController::class, 'index'])->name('session-type.index');
});
