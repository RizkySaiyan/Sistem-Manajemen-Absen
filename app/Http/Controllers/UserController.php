<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\divisi;
use App\Models\jamkerja;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function profil(){

        $id = Auth::user()->id;
        $user = User::find($id);
        return view('pages.Profil.profil',compact('user'));
    }
    public function profil_update(Request $request){

        $id = Auth::user()->id;
        $user = User::find($id);
        $user->name = $request->nama;
        $user->nik = $request->nik;
        $user->email = $request->email;
        $user->notelp = $request->notelp;
        if(!empty($request->password)){
            $user->password = bcrypt($request->password);
        }
        if($request->file('foto')){
            $file = $request->file('foto');
            $folderPath = "storage/profil/";
            $fileNameWExt = $file->getClientOriginalName();
            $filename = pathinfo($fileNameWExt,PATHINFO_FILENAME);
            $ext = $file->getClientOriginalExtension();
            $filesave = $filename.'.'.$ext;
            $path = $file->storeAs($folderPath,$filesave);
            $user->path_gambar = 'storage/profil/'.$filesave;
        }
        $user->save();
        return redirect('/profil')->with('flash-message','Berhasil Update Profil');
    }

    public function karyawan(){

        $user = User::where('id','!=',Auth::user()->id)
        ->paginate(10);
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
        $user->role = $request->role;
        $user->name = $request->nama_karyawan;
        $user->username = $request->username;
        $user->password = bcrypt('123456');
        $user->alamat = $request->alamat;
        $user->notelp = $request->notelp;
        $user->email = $request->email;
        $user->nik = $request->nik;
        $user->role = 'Staff';
        $user->save();

        return redirect('/karyawan')->with('success', 'Karyawan telah berhasil ditambah!'); 
    }

    public function edit($id){

        $user = user::find($id);
        $divisi = divisi::all();
        return view('pages.karyawan.ubahKaryawan',compact('user','divisi'));
    }

    public function update(Request $request,$id){
        
        $user = user::find($id);
        $user->divisi_id = $request->divisi;
        $user->role = $request->role;
        $user->name = $request->nama_karyawan;
        $user->username = $request->username;
        // $user->password = bcrypt($request->password);
        $user->alamat = $request->alamat;
        $user->notelp = $request->notelp;
        $user->email = $request->email;
        $user->nik = $request->nik;
        $user->save();

        return redirect('/karyawan')->with('flash-message', 'Karyawan telah berhasil diubah');
    }

    public function destroy($id)
    {
        $user = user::find($id);
        $user->delete();
        return redirect('/karyawan')->with('flash-message', 'Data Berhasil Di Hapus');
    }
    
}
