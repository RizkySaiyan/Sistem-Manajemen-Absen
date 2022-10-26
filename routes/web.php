<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as C;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages/dashboard');
});

Route::post('/login', [C\LoginController::class,'authenticate'])->name('login');
Route::get('/login', [C\LoginController::class,'index']);
//profile
Route::get('/profil',[C\UserController::class,'index']);

Route::get('/karyawan',[C\UserController::class,'karyawan']);
Route::get('/karyawan/tambah',[C\UserController::class,'create']);
Route::get('/karyawan/ubah',[C\UserController::class,'edit']);
Route::post('/karyawan',[C\UserController::class,'store']);
Route::post('/karyawan/update/{id}',[C\UserController::class,'update']);
Route::post('/karyawan/destroy/{id}',[C\UserController::class,'destroy']);


Route::get('/absen',[C\AbsensiController::class,'index']);

Route::get('/divisi',[C\DivisiController::class,'index']);
Route::get('/divisi/tambah',[C\DivisiController::class,'create']);
Route::get('/divisi/edit/{id}',[C\DivisiController::class,'edit']);
Route::post('/divisi',[C\DivisiController::class,'store']);
Route::post('/divisi/update/{id}',[C\DivisiController::class,'update']);
Route::post('/divisi/destroy/{id}',[C\DivisiController::class,'destroy']);

Route::get('/jam-kerja',[C\JamKerjaController::class,'index']);
Route::get('/jam-kerja/tambah',[C\JamKerjaController::class,'create']);
Route::get('/jam-kerja/edit/{id}',[C\JamKerjaController::class,'edit']);
Route::post('/jam-kerja',[C\JamKerjaController::class,'store']);
Route::post('/jam-kerja/update/{id}',[C\JamKerjaController::class,'update']);
Route::post('/jam-kerja/destroy/{id}',[C\JamKerjaController::class,'destroy']);




