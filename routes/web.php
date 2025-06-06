<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard/user', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');

});

// Rute untuk authecated users
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('usulan_kata', \App\Http\Controllers\UsulanKataController::class);
});

// Rute untuk usulan kata (Admin)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('usulan', \App\Http\Controllers\UsulanKataController::class);
    Route::resource('kata', \App\Http\Controllers\KataController::class, ['parameters' => ['kata' => 'kata']])->except('show');

});

// Rute untuk ahli
Route::middleware(['auth', 'role:ahli'])->group(function () {
    Route::get('/usulan/{usulan}/review', [\App\Http\Controllers\UsulanKataController::class, 'review'])->name('usulan.review');
    Route::post('/usulan/{usulan}/approve', [\App\Http\Controllers\UsulanKataController::class, 'approve'])->name('usulan.approve');
    Route::post('/usulan/{usulan}/reject', [\App\Http\Controllers\UsulanKataController::class, 'reject'])->name('usulan.reject');

    Route::get('/laporan-kesalahan', [\App\Http\Controllers\LaporanKesalahanController::class, 'index'])->name('laporan_kesalahan.index');
    Route::get('/laporan-kesalahan/{id}', [\App\Http\Controllers\LaporanKesalahanController::class, 'show'])->name('laporan_kesalahan.show');
    Route::put('/laporan-kesalahan/{id}', [\App\Http\Controllers\LaporanKesalahanController::class, 'update'])->name('laporan_kesalahan.update');
    Route::put('/laporan-kesalahan/{id}/selesai', [\App\Http\Controllers\LaporanKesalahanController::class, 'selesai'])->name('laporan_kesalahan.selesai');
    Route::put('/laporan-kesalahan/{id}/update-kata', [\App\Http\Controllers\LaporanKesalahanController::class, 'updateKata'])->name('laporan_kesalahan.update_kata');
    Route::get('/kata-log', [\App\Http\Controllers\LaporanKesalahanController::class, 'kataLog'])->name('kata.log');
});


require __DIR__ . '/auth.php';

Route::get('entry', [\App\Http\Controllers\KataController::class, 'entry'])->name('kata.entry');
Route::get('/', [\App\Http\Controllers\DictionaryController::class, 'index'])->name('dictionary.index');
Route::get('/kata/{kata}', [\App\Http\Controllers\DictionaryController::class, 'show'])->name('dictionary.show');

// Route Laporan Kesalahan
Route::get('/laporan/create/{kata_id}', [\App\Http\Controllers\LaporanKesalahanController::class, 'create'])->name('laporan.create');
Route::post('/laporan', [\App\Http\Controllers\LaporanKesalahanController::class, 'store'])->name('laporan.store');
Route::get('/laporan-saya', [\App\Http\Controllers\LaporanKesalahanController::class, 'laporanSaya'])->name('laporan_saya');