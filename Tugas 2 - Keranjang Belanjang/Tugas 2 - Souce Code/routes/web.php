<?php

use App\Http\Controllers\KeranjangController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/tugas2/index');

Route::prefix('tugas2')->group(function () {
    Route::get('/index', [KeranjangController::class, 'index'])->name('index');
    Route::get('/keranjang', [KeranjangController::class, 'keranjang'])->name('keranjang');

    Route::post('/tambah/{id}', [KeranjangController::class, 'tambah'])->name('tambah');
    Route::post('/tambah-qty/{id}', [KeranjangController::class, 'tambahQty'])->name('tambahQty');
    Route::post('/kurang-qty/{id}', [KeranjangController::class, 'kurangQty'])->name('kurangQty');
    Route::post('/hapus/{id}', [KeranjangController::class, 'hapus'])->name('hapus');
    Route::post('/kosongkan', [KeranjangController::class, 'kosongkan'])->name('kosongkan');
});