<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function() {
    Route::get('/registrasi', [AuthController::class, 'tampilRegistrasi'])->name('registrasi.tampil');
    Route::post('/registrasi/submit', [AuthController::class, 'submitRegistrasi'])->name('registrasi.submit');
    
    Route::get('/login', [AuthController::class, 'tampilLogin'])->name('login');
    Route::post('/login/submit', [AuthController::class, 'submitLogin'])->name('login.submit');
});

Route::get('/siswa',[SiswaController::class, 'tampil'])->name('siswa.tampil');
Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');

Route::middleware('auth')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // Route::get('/siswa/tambah',[SiswaController::class, 'tambah'])->name('siswa.tambah');
    // Route::post('siswa/submit',[SiswaController::class, 'submit'])->name('siswa.submit');
    // Route::get('siswa/edit{id}',[SiswaController::class, 'edit'])->name('siswa.edit');
    // Route::post('siswa/update{id}',[SiswaController::class, 'update'])->name('siswa.update');
    // Route::post('siswa/delete{id}',[SiswaController::class, 'delete'])->name('siswa.delete');
    
    Route::post('/siswa/storeAjax', [SiswaController::class, 'storeAjax'])->name('siswa.storeAjax');
    Route::get('/siswa/editAjax/{id}', [SiswaController::class, 'editAjax'])->name('siswa.editAjax');
    Route::put('/siswa/updateAjax/{id}', [SiswaController::class, 'updateAjax'])->name('siswa.updateAjax');
    Route::delete('/siswa/deleteAjax/{id}', [SiswaController::class, 'deleteAjax'])->name('siswa.deleteAjax');
});