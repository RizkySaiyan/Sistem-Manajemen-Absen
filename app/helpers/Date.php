<?php
namespace App\helpers;
 
use Illuminate\Support\Facades\DB;
 
class Date {

    public static function bulan() {
        $bulan_arr = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];
    
        // if ($m !== 0) {
        //     return $bulan_arr[$m];
        // }
        return $bulan_arr;
        // dd('test')
    }

}
