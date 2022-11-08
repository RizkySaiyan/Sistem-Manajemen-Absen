<?php

namespace App\Http\Controllers;
use Datatables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\divisi;

class DivisiController extends Controller
{
    
    public function index(Request $request){

        $divisi = divisi::paginate(10);
        return view('pages.Divisi.divisi')->with([
            'data' => $divisi
        ]);
    }

    public function create(){
        return view('pages.divisi.tambahDivisi');
    }

    public function store(Request $request){

        $request->validate([
            'kodedivisi' => 'required',
            'namadivisi' => 'required'
        ]);
        $divisi = new divisi;

        $divisi->nama_divisi = $request->namadivisi;
        $divisi->kode_divisi = $request->kodedivisi;

        $divisi->save();

        return redirect('/divisi')->with('flash-message', 'Divisi telah berhasil ditambah!'); 
    }
    

    public function edit($id){

        $divisi = divisi::find($id);
        return view('pages.divisi.ubahDivisi',compact('divisi'));
    }

    public function update(Request $request){
        
        $id = $request->id;
        $divisi = divisi::find($id);
        $divisi->nama_divisi = $request->namadivisi;
        $divisi->kode_divisi = $request->kodedivisi;
        $divisi->save();

        return redirect('/divisi')->with('flash-message', 'Divisi telah berhasil diubah');
    }

    public function destroy($id)
    {
        $divisi = divisi::find($id);
        $divisi->delete();
        return redirect('/divisi')->with('flash-message', 'Data Berhasil Di Hapus');
    }
}
