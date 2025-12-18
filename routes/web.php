<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

//CONTROLLER
use App\Http\Controllers\Antrian\AntrianController;
use App\Http\Controllers\Antrian\LoketController;
use App\Http\Controllers\Antrian\DisplayController;
use App\Http\Controllers\Antrian\JenisAntrianController;
use App\Http\Controllers\Antrian\LoketMasterController;


// AUTHENTICATION LARAVEL (AUTH UI BOOTSTRAP + SPATIE ROLES PERMISSIONS)
Auth::routes(['register' => false]); // Cannot Access /register
Route::group(['middleware' => ['web', 'auth']], function() {
    Route::get('/', function() { return redirect()->route('antrian.index'); });
    Route::get('/dashboard', [AntrianController::class, 'index'])->name('antrian.index');
});

//JENIS_ANTRIAN
Route::get('/jenis-antrian', [JenisAntrianController::class, 'index'])->name('jenis.index');
Route::post('/jenis-antrian', [JenisAntrianController::class, 'store']);
Route::patch('/jenis-antrian/{id}/toggle', [JenisAntrianController::class, 'toggle']);

//LOKET
Route::get('/loket-master', [LoketMasterController::class, 'index'])->name('loket.master');
Route::post('/loket-master', [LoketMasterController::class, 'store']);
Route::patch('/loket-master/{id}/toggle', [LoketMasterController::class, 'toggle'])->name('loket.toggle');
Route::patch('/loket-master/{id}', [LoketMasterController::class, 'update'])->name('loket.update');

//ANTRIAN
Route::get('/ambil-antrian', [AntrianController::class, 'ambil'])->name('ambil.index');
Route::post('/ambil-antrian/ajax', [AntrianController::class, 'ambilAjax'])->name('ambil.ajax');

//PANGGILAN
Route::get('/loket-antrian', [LoketController::class, 'index'])->name('panggil.index');
Route::post('/loket/{loketId}/panggil', [LoketController::class, 'panggil'])->name('panggil.panggil');
Route::get('/loket-antrian/data', [LoketController::class, 'data'])->name('panggil.data');

Route::get('/display', [DisplayController::class, 'index'])->name('display.index');
Route::get('/display/data', [DisplayController::class, 'data']);
Route::post('/display/{logId}/tampil', [DisplayController::class, 'tampil']);


Route::fallback(function () {
    return response()->view('pages.errors.custom-404', [], 404);
});
