<!DOCTYPE html>
<html>
<head>
	<title>Rekap Absensi PDF</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
@php
use \App\helpers\Date;
use Carbon\Carbon;
use Illuminate\Http\Request;
setlocale(LC_TIME, 'id_ID');
\Carbon\Carbon::setLocale('id');
@endphp
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Rekap Absensi</h4>
		
	</center>
	<center>
		<h5>{{Carbon::create($tahun_params,$bulan_params)->isoFormat('MMMM Y')}}</h5>	
	</center>
	<br>
	<table class="table border-1">
		<tr>
			<th class="border-0 py-0">Nama</th>
			<th class="border-0 py-0">:</th>
			<th class="border-0 py-0">{{$user->name}}</th>
		</tr>
		<tr>
			<th class="border-0 py-0">Divisi</th>
			<th class="border-0 py-0">:</th>
			<th class="border-0 py-0">{{$user->divisi->nama_divisi}}</th>
		</tr>
		<tr>
			<th class="border-0 py-0">Jumlah Absen Bulan Ini</th>
			<th class="border-0 py-0">:</th>
			<th class="border-0 py-0">{{count($count)}}</th>
		</tr>
	</table>
	<table class='table table-bordered'>
		<thead>
			<tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Keterangan</th>
			</tr>
		</thead>
		<tbody>
            @foreach($absensi as $key => $item)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y')}}</td>
                <td>{{$item->jam}}</td>
                <td>{{$item->keterangan}}</td>
            </tr>
            @endforeach
		</tbody>
	</table>
 
</body>
</html>