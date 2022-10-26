<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\divisi;
use App\Models\jamkerja;
use App\Models\User;


class UserController extends Controller
{

    public function profil(){

        $user = User::paginate(10);
        return view('pages.Profil.profil')->with([
            'data' => $user
        ]);
    }

    public function karyawan(){

        $user = User::paginate(10);
        return view('pages.karyawan.karyawan')->with([
            'data' => $user
        ]);
    }

    public function create(){

        $divisi = divisi::all();
        return view('pages.karyawan.tambahKaryawan',compact('divisi'));

    }

    public function store(Request $request){

        
        $user = new user;
        $user->divisi_id = $request->divisi;
        $user->name = $request->nama_karyawan;
        $user->username = $request->username;
        $user->password = bcrypt('123456');
        $user->alamat = $request->alamat;
        $user->notelp = $request->notelp;
        $user->email = $request->email;
        $user->save();

        return redirect('/karyawan')->with('success', 'Karyawan telah berhasil ditambah!'); 
    }

    public function edit($id){

        $user = user::find($id);
        return view('pages.karyawan.ubahKaryawan',compact('user'));
    }

    public function update(Request $request,$id){
        
        $user = user::find($id);
        $user->divisi_id = $request->divisi;
        $user->name = $request->nama_karyawan;
        $user->username = $request->username;
        // $user->password = bcrypt('123456');
        $user->alamat = $request->alamat;
        $user->notelp = $request->notelp;
        $user->email = $request->email;
        $user->save();

        return redirect('/karyawan')->with('success', 'Karyawan telah berhasil diubah');
    }

    public function destroy($id)
    {
        $user = user::find($id);
        $user->delete();
        return redirect('/user')->with('success', 'Data Berhasil Di Hapus');
    }
    
}
