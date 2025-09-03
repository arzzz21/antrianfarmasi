<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

//CONTROLLER
use App\Http\Controllers\Antrian\AntrianController;
use App\Http\Controllers\Antrian\PanggilanAntrianController;
use App\Http\Controllers\Antrian\DisplayAntrianController;


// AUTHENTICATION LARAVEL (AUTH UI BOOTSTRAP + SPATIE ROLES PERMISSIONS)
Auth::routes(['register' => false]); // Cannot Access /register
Route::group(['middleware' => ['web', 'auth']], function() {
    Route::get('/', function() { return redirect()->route('antrian.index'); });
    Route::get('/dashboard', [AntrianController::class, 'index'])->name('antrian.index');

    // Ambil nomor antrian
    Route::get('/ambil', [AntrianController::class, 'ambilJenisPage'])->name('antrian.page.ambil.jenis');

    // Halaman ambil antrian per jenis
    Route::get('/ambil/{jenisId}', [AntrianController::class, 'ambilSubJenisPage'])->name('antrian.page.ambil.subjenis');

    // Proses ambil nomor (klik tombol sub jenis)
    Route::post('/ambil/{subJenisId}', [AntrianController::class, 'ambil'])->name('antrian.ambil');

    //Cetak
    Route::get('/cetak/{id}', [AntrianController::class, 'cetak'])->name('antrian.cetak');

    //Panggil Antrian
    Route::prefix('antrian')->group(function() {
        // Pilih jenis + loket
        Route::get('/panggil/pilih', [PanggilanAntrianController::class, 'pilihJenisLoket'])->name('antrian.panggil.pilih');
        Route::post('/panggil/pilih', [PanggilanAntrianController::class, 'simpanPilihan'])->name('antrian.panggil.simpan');
        Route::get('/get-loket/{jenis_id}', [PanggilanAntrianController::class, 'getLoketByJenis'])->name('antrian.getLoket');

        Route::get('/panggil', [PanggilanAntrianController::class, 'index'])->name('antrian.panggil.index');
        Route::post('/panggil/{id}', [PanggilanAntrianController::class, 'panggil'])->name('antrian.panggil');
        Route::get('/panggil-data', [PanggilanAntrianController::class, 'data'])->name('antrian.panggil.data');
        Route::get('/data', [PanggilanAntrianController::class, 'getDataAntrian'])->name('antrian.data');
    });

    //Display Antrian
    Route::prefix('antrian')->group(function() {
        // Pilih jenis antrian untuk display
        Route::get('/display/pilih', [DisplayAntrianController::class, 'pilihJenis'])->name('antrian.display.pilih');
        Route::post('/display/pilih', [DisplayAntrianController::class, 'simpanPilihan'])->name('antrian.display.simpan');

        // Halaman display antrian
        Route::get('/display', [DisplayAntrianController::class, 'index'])->name('antrian.display.index');
        Route::get('/display-data', [DisplayAntrianController::class, 'data'])->name('antrian.display.data');
    });
});

Route::fallback(function () {
    return response()->view('pages.errors.custom-404', [], 404);
});
