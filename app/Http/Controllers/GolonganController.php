<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\golongan;

class GolonganController extends Controller
{
    //
    public function index(Request $request){

        $golongan = golongan::paginate(10);
        return view('pages.Golongan.golongan')->with([
            'data' =>$golongan
        ]);
    }

    public function create(){
        return view('pages.Golongan.tambahGolongan');
    }

    public function store(Request $request){

        $request->validate([
            'kodedivisi' => 'required',
            'namadivisi' => 'required'
        ]);

        $golongan = new golongan;

        $golongan->nama_golongan = $request->namagolongan;

        $golongan->save();

        return redirect('/golongan')->with('flash-message', 'Golongan telah berhasil ditambah!'); 
    }
    

    public function edit($id){

        $golongan = golongan::find($id);
        return view('pages.Golongan.ubahGolongan',compact('golongan'));
    }

    public function update(Request $request){
        
        $id = $request->id;
        $golongan = golongan::find($id);
        $golongan->nama_golongan = $request->namagolongan;
        $golongan->save();

        return redirect('/golongan')->with('flash-message', 'Golongan telah berhasil diubah');
    }

    public function destroy($id)
    {
        $golongan = golongan::find($id);
        $golongan->delete();
        return redirect('/golongan')->with('flash-message', 'Data Berhasil Di Hapus');
    }
    
}
