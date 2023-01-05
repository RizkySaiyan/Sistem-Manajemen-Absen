<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\absensi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;
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

    public function list_karyawan(){
        $user = User::all();

        return view('pages.absen.list-karyawan', compact('user'));
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
        $folder = "storage/absen_foto/";
        $folderPath = "public/absen_foto/";
        
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.jpeg';
        $file = $folder . $fileName;
        $fileUpload = $folderPath . $fileName;
        $absensi->foto_kunjungan = $file;
        Storage::put($fileUpload, $image_base64);
        }
        $absensi->save();

        return redirect('/absen')->with('flash-message', 'Berhasil melakukan absen');
    }

    public function rekap(Request $request, $id = null){
        
        if(empty($id)){
            $id = Auth::user()->id;
        }
        // $now = Carbon::now();
        // dd($request->bulan,$request->tahun);
        $keterangan = $request->absen;
        $bulan_params = $request->bulan;
        $tahun_params = $request->tahun;

        $absensi = absensi::where('user_id','=',$id)
        ->WhereMonth('created_at','=',$request->bulan)
        ->WhereYear('created_at','=',$request->tahun)
        ->orderBy('created_at','desc')
        ->get();
        
        if(isset($keterangan)){
           $absensi = absensi::where('keterangan','=',$keterangan)
            ->WhereMonth('created_at','=',$request->bulan)
            ->WhereYear('created_at','=',$request->tahun)
            ->orderBy('created_at','desc')
            ->get();
        }

        $count = absensi::where('keterangan','=','Masuk')
        ->where('user_id','=',$id)
        ->WhereMonth('created_at','=',$request->bulan)
        ->WhereYear('created_at','=',$request->tahun)
        ->get();
        
        
        $user = User::find($id);
        return view('pages.absen.rekap-absensi',compact('count','absensi','user','bulan_params','tahun_params'));
    }

    public function detail(Request $request,$id_detail){
            $now = Carbon::now();

            $absensi = absensi::find($id_detail);
            $keterangan = (isset($absensi->keterangan) && $absensi->keterangan == 'Masuk') ? 'Keluar': 'Masuk';
            
            if(empty($absensi)){
                $absensi = [];
            };
        
            return view('pages.absen.detail', compact('absensi','keterangan'));
    }

    public function cetak_pdf(Request $request,$id){

        if(empty($id)){
            $id = Auth::user()->id;
        }
        // $now = Carbon::now();
        // dd($request->bulan,$request->tahun);
        $keterangan = $request->absen;
        $bulan_params = $request->bulan;
        $tahun_params = $request->tahun;

        $absensi = absensi::where('user_id','=',$id)
        ->WhereMonth('created_at','=',$request->bulan)
        ->WhereYear('created_at','=',$request->tahun)
        ->orderBy('created_at','desc')
        ->get();
        
        if(isset($keterangan)){
           $absensi = absensi::where('keterangan','=',$keterangan)
            ->WhereMonth('created_at','=',$request->bulan)
            ->WhereYear('created_at','=',$request->tahun)
            ->orderBy('created_at','desc')
            ->get();
        }

        $count = absensi::where('keterangan','=','Masuk')
        ->where('user_id','=',$id)
        ->WhereMonth('created_at','=',$request->bulan)
        ->WhereYear('created_at','=',$request->tahun)
        ->get();
        
        
        $user = User::find($id);
        $pdf = PDF::loadView('pages/absen/rekap-absensi-pdf',compact('user','count','absensi','bulan_params','tahun_params'))->setPaper('a4','portrait');
        return $pdf->download('Rekap Absensi PDF');
    }

}
