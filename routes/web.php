<?php

use App\Http\Controllers\ProfileController;
use App\Models\LoanDetail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', \App\Http\Controllers\LoanDetail\LoanDetailIndexController::class)->name('dashboard');

    Route::prefix('emi-details')->name('emi.')->group(function () {
        Route::get('/', \App\Http\Controllers\EmiDetail\EmiDetailIndexController::class)->name('details');
        Route::get('/process-data', \App\Http\Controllers\EmiDetail\EmiDetailProcessController::class)->name('process-data');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
