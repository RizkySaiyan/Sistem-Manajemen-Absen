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
        $data = jamkerja::leftjoin('divisi', 'divisi.id', '=', 'waktu_kerja.divisi_id')
        ->select('divisi.kode_divisi','divisi.nama_divisi',
        'waktu_kerja.divisi_id','waktu_kerja.id',
        'waktu_kerja.jam_masuk','waktu_kerja.jam_keluar')
        ->get();
        return view('pages.Jam-Kerja.jam-kerja')->with([
            'data' => $data
        ]);
        
    }

    public function create(){
        $divisi = divisi::all();
        return view('pages.Jam-Kerja.tambahJamKerja',compact('divisi'));
    }

    public function edit($id){
        $divisi = divisi::all();
        $data = jamkerja::leftjoin('divisi', 'divisi.id', '=', 'waktu_kerja.divisi_id')
        ->Where('waktu_kerja.id',$id)
        ->select('divisi.kode_divisi','divisi.nama_divisi',
        'waktu_kerja.divisi_id','waktu_kerja.id'
        ,'waktu_kerja.jam_masuk','waktu_kerja.jam_keluar')
        ->get();
        return view('pages.Jam-Kerja.ubahJamKerja',compact('data','divisi'));
    }

    public function store(Request $request){


        $jamkerja = new jamkerja;
        $jamkerja->divisi_id = $request->divisi;
        $jamkerja->jam_masuk = $request->jam_mulai;
        $jamkerja->jam_keluar = $request->jam_selesai;

        $jamkerja->save();

        return redirect('/jam-kerja')->with('success', 'Jam Kerja telah berhasil ditambah!');
    }

    public function update(Request $request,$id){
        
        $jamkerja = jamkerja::find($id);
        $jamkerja->divisi_id = $request->divisi;
        $jamkerja->jam_masuk = $request->jam_mulai;
        $jamkerja->jam_keluar = $request->jam_selesai;

        $jamkerja->save();

        return redirect('/jam-kerja')->with('success', 'Divisi telah berhasil diubah');
    }

    public function destroy($id)
    {
        $jamkerja = jamkerja::find($id);
        $jamkerja->delete();
        return redirect('/jam-kerja')->with('success', 'Data Berhasil Di Hapus');
    }
}
