<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\absensi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class AbsensiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $now = Carbon::now();

        $id = Auth::user()->id;
        $absensi = absensi::where('user_id','=',$id)
        ->whereDate('created_at','=',$now->toDateString())
        ->orderBy('created_at','desc')
        ->first();

        $absensi_check = absensi::where('user_id','=',$id)
        ->whereDate('created_at','=',$now->toDateString())
        ->orderBy('created_at','desc')
        ->get()
        ->toArray();

        $keterangan = (isset($absensi->keterangan) && $absensi->keterangan == 'Masuk') ? 'Keluar': 'Masuk';
        
        if(empty($absensi)){
            $absensi = [];
        };


        // dd(count($absensi_check));
        $user = User::find($id);
        return view('pages.absen.absensi', compact('absensi','user','keterangan','absensi_check'));
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

    public function rekap(Request $request){
        $id = Auth::user()->id;
        // $now = Carbon::now();
        // dd($request->bulan,$request->tahun);
        $absensi = absensi::where('user_id','=',$id)
        ->WhereMonth('created_at','=',$request->bulan)
        ->WhereYear('created_at','=',$request->tahun)
        ->orderBy('created_at','desc')
        ->get();

        // ->toArray();
        
        
        $user = User::find($id);

        return view('pages.absen.rekap-absensi',compact('absensi','user'));
    }

}
