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
})->middleware('auth');

Route::post('/login', [C\LoginController::class,'authenticate'])->name('login');
Route::get('/login', [C\LoginController::class,'index']);
Route::get('/logout',  [C\LoginController::class,'logout'])->middleware('auth');
//profile
Route::get('/profil',[C\UserController::class,'profil']);
Route::post('/profil',[C\UserController::class,'profil_update']);

Route::get('/karyawan',[C\UserController::class,'karyawan'])->middleware('auth');
Route::get('/karyawan/tambah',[C\UserController::class,'create']);
Route::get('/karyawan/edit/{id}',[C\UserController::class,'edit']);
Route::post('/karyawan',[C\UserController::class,'store']);
Route::post('/karyawan/update/{id}',[C\UserController::class,'update']);
Route::post('/karyawan/destroy/{id}',[C\UserController::class,'destroy']);


Route::get('/absen',[C\AbsensiController::class,'index'])->middleware('auth');
Route::post('/absen',[C\AbsensiController::class,'store'])->middleware('auth');
Route::get('/absen-rekap/{id?}',[C\AbsensiController::class,'rekap'])->middleware('auth');
Route::get('/list-karyawan',[C\AbsensiController::class,'list_karyawan'])->middleware('auth');
Route::get('/detail-absen/{id_detail}',[C\AbsensiController::class,'detail'])->middleware('auth');

Route::get('/divisi',[C\DivisiController::class,'index'])->middleware('auth');
Route::get('/divisi/tambah',[C\DivisiController::class,'create']);
Route::get('/divisi/edit/{id}',[C\DivisiController::class,'edit']);
Route::post('/divisi',[C\DivisiController::class,'store']);
Route::post('/divisi/update/{id}',[C\DivisiController::class,'update']);
Route::post('/divisi/destroy/{id}',[C\DivisiController::class,'destroy']);

Route::get('/golongan',[C\GolonganController::class,'index'])->middleware('auth');
Route::get('/golongan/tambah',[C\GolonganController::class,'create']);
Route::get('/golongan/edit/{id}',[C\GolonganController::class,'edit']);
Route::post('/golongan',[C\GolonganController::class,'store']);
Route::post('/golongan/update/{id}',[C\GolonganController::class,'update']);
Route::post('/golongan/destroy/{id}',[C\GolonganController::class,'destroy']);

Route::get('/jam-kerja',[C\JamKerjaController::class,'index'])->middleware('auth');
Route::get('/jam-kerja/tambah',[C\JamKerjaController::class,'create']);
Route::get('/jam-kerja/edit/{id}',[C\JamKerjaController::class,'edit']);
Route::post('/jam-kerja',[C\JamKerjaController::class,'store']);
Route::post('/jam-kerja/update/{id}',[C\JamKerjaController::class,'update']);
Route::post('/jam-kerja/destroy/{id}',[C\JamKerjaController::class,'destroy']);




