<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PublicTrackController;
use App\Http\Controllers\LaporanController;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/harga', [PriceController::class, 'index'])->name('prices.index');
    Route::get('/harga/tambah', [PriceController::class, 'create'])->name('prices.create');
    Route::post('/harga', [PriceController::class, 'store'])->name('prices.store');
    Route::get('/harga/{price}/edit', [PriceController::class, 'edit'])->name('prices.edit');
    Route::put('/harga/{price}', [PriceController::class, 'update'])->name('prices.update');
    Route::delete('/harga/{price}', [PriceController::class, 'destroy'])->name('prices.destroy');

    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/tambah', [PesananController::class, 'create'])->name('pesanan.create');
    Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
    Route::get('/pesanan/{pesanan}', [PesananController::class, 'show'])->name('pesanan.show');
    Route::patch('/pesanan/{pesanan}/status', [PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');
    Route::delete('/pesanan/{pesanan}', [PesananController::class, 'destroy'])->name('pesanan.destroy');

    Route::get('/laporan/export', [LaporanController::class, 'export'])
    ->name('laporan.export');
});
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
        Route::get('/kamar', [KamarController::class, 'index'])->name('kamar.index');

        Route::get('/lacak', [PublicTrackController::class, 'index'])->name('public.lacak');

require __DIR__.'/auth.php';
