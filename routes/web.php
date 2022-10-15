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

Route::get('/karyawan',[C\UserController::class,'index']);


Route::get('/absen',[C\AbsensiController::class,'index']);

Route::get('/divisi',[C\DivisiController::class,'index']);
Route::get('/divisi/tambah',[C\DivisiController::class,'create']);
Route::get('/divisi/edit/{id}',[C\DivisiController::class,'edit']);
Route::post('/divisi',[C\DivisiController::class,'store']);
Route::post('/divisi',[C\DivisiController::class,'update']);

Route::get('/jam-kerja',[C\JamKerjaController::class,'index']);
Route::get('/jam-kerja/tambah',[C\JamKerjaController::class,'create']);
Route::post('/jam-kerja',[C\JamKerjaController::class,'store']);




