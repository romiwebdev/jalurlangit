<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\AmalanController;
use App\Http\Controllers\Dashboard\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman depan (Frontend)
Route::get('/', [FrontendController::class, 'index'])->name('beranda');
Route::get('/amalan/{id}', [FrontendController::class, 'show'])->name('amalan.detail');
Route::get('/favorit', [FrontendController::class, 'favorit'])->name('favorit');

// Authenticated Dashboard Routes
Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    // Manajemen Amalan
    Route::resource('amalan', AmalanController::class);

    // Manajemen Kategori
    Route::resource('kategori', KategoriController::class)->except(['show']);

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// File auth bawaan Laravel Breeze / Jetstream
require __DIR__ . '/auth.php';
