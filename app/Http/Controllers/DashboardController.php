<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\absensi;
use App\Models\User;
use App\Models\jamkerja;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index(){

        $user = User::all()
        ->count();
        
        $sakit = absensi::where('keterangan','=','Sakit')
        ->count();

        $ijin = absensi::where('keterangan','=','Izin')
        ->count();

        $absensi = absensi::join('users','users.id','=','absensi.user_id')
        ->join('waktu_kerja','waktu_kerja.divisi_id','users.divisi_id')
        ->select('waktu_kerja.*','absensi.*')
        ->WhereMonth('created_at','=',Carbon::now())
        ->WhereYear('created_at','=',Carbon::now())
        ->orderBy('created_at','desc')
        ->get();

        $new_absensi = $absensi->map(function ($new_absensi){
            if($new_absensi->jam_masuk < $new_absensi->jam){
                $jumlah_terlambat = $new_absensi->jadwal = 'Terlambat';
            }
            elseif($new_absensi->keterangan == 'Sakit' || $new_absensi->keterangan == 'Izin') {
                $new_absensi->jadwal = 'Tidak Masuk';
            }
            else{
                $new_absensi->jadwal = 'Tepat Waktu';
            }
            return $new_absensi;
        });

        $jumlah_terlambat = 0;
        $jumlah_tepatwaktu = 0;
        foreach ($new_absensi as $key => $value) {
            if($value['jadwal'] === 'Terlambat'){
                json_encode($jumlah_terlambat++);
            }
            elseif($value == 'Tepat Waktu'){
                json_encode($jumlah_tepatwaktu++);
            }
        }

        return view('pages.dashboard',compact('user','sakit','ijin','jumlah_tepatwaktu','jumlah_terlambat'));
    }
}
