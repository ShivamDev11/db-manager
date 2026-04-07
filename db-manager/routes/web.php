<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\ImportController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('businesses')->group(function () {
    Route::get('/', [BusinessController::class, 'index'])->name('businesses.index');
    Route::get('/duplicates', [BusinessController::class, 'duplicates'])->name('businesses.duplicates');
    Route::post('/merge', [BusinessController::class, 'merge'])->name('businesses.merge');
    Route::get('/report', [BusinessController::class, 'report'])->name('businesses.report');
    Route::get('/{id}', [BusinessController::class, 'show'])->name('businesses.show');
    Route::delete('/{id}', [BusinessController::class, 'destroy'])->name('businesses.destroy');
});

Route::prefix('import')->group(function () {
    Route::get('/', [ImportController::class, 'showForm'])->name('import.form');
    Route::post('/', [ImportController::class, 'import'])->name('import.store');
});
