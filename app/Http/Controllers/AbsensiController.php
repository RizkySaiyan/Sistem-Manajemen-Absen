<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\absensi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $id = Auth::user()->id;
        $absensi = absensi::where('user_id','=',$id)
        ->first();

        if(empty($absensi)){
            $absensi = [];
        };
        
        $user = User::find($id);
        return view('pages.absen.absensi', compact('absensi','user'));
    }

    public function store(Request $request){

        $absensi = new absensi;
        $absensi->jam = $request->jam;
        $absensi->user_id = Auth::user()->id;
        $absensi->keterangan = $request->keterangan;
        $absensi->latitude = $request->latitude;
        $absensi->longitude = $request->longitude;
        if($request->foto){
        $img = $request->foto;
        $folderPath = "public/absen_foto/";
        
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.jpeg';
        $file = $folderPath . $fileName;
        $absensi->foto_kunjungan = $file;
        Storage::put($file, $image_base64);
        }
        $absensi->save();

        return redirect('/absen')->with('flash-message', 'Berhasil melakukan absen');
    }

}
