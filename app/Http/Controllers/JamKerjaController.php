<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\divisi;
use App\Models\jamkerja;

class JamKerjaController extends Controller
{
    
    public function index(){
        $data = DB::table('waktu_kerja')
        ->leftJoin('divisi', 'divisi.id', '=', 'waktu_kerja.divisi_id')
        ->select('divisi.id','divisi.nama_divisi','waktu_kerja.jam_masuk','waktu_kerja.jam_keluar')
        ->get();
        return view('pages.Jam-Kerja.jam-kerja',compact('data'));
    }

    public function create(){
        $divisi = divisi::all();
        return view('pages.Jam-Kerja.tambahJamKerja',compact('divisi'));
    }

    public function store(Request $request){


        $jamkerja = new jamkerja;
        $jamkerja->divisi_id = $request->divisi;
        $jamkerja->jam_masuk = $request->jam_mulai;
        $jamkerja->jam_keluar = $request->jam_selesai;

        $jamkerja->save();

        return redirect('/jam-kerja')->with('success', 'Jam Kerja telah berhasil ditambah!');
    }
}
