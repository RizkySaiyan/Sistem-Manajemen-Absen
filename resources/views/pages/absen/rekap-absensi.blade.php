@php
use \App\helpers\Date;
use Carbon\Carbon;
@endphp
@extends('layout/app')
@section('content')
<div class="row mb-2">
    <h4 class="col-xs-12 col-sm-6 mt-0">Rekap Absen</h4>
    <div class="col-xs-12 col-sm-6 ml-auto text-right">
        <form action="" method="get">
            <div class="row">
                <div class="col">
                    <select name="bulan" id="bulan" class="form-control">
                        <option value="" disabled selected>-- Pilih Bulan --</option>   
                        <option value="all">Semua Bulan</option>   
                         @foreach (Date::bulan() as $key => $bulan)
                             <option value="{{$key}}">{{$bulan}}</option>
                         @endforeach           
                    </select>
                </div>
                <div class="col ">
                    <select name="tahun" id="tahun" class="form-control">
                        <option value="" disabled selected>-- Pilih Tahun</option>
                        @for($i = date('Y'); $i >= (date('Y')-5); $i--)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="col ">
                    <button type="submit" class="btn btn-primary btn-fill btn-block">Tampilkan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header border-bottom">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <table class="table border-0">
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
                        </table>
                    </div>
                    <div class="col-xs-12 col-sm-6 ml-auto text-right mb-2">
                        <div class="dropdown d-inline">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="droprop-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-print"></i>
                                Export Laporan
                            </button>
                            <div class="dropdown-menu" aria-labelledby="droprop-action">
                                <a href="#" class="dropdown-item" target="_blank"><i class="fa fa-file-pdf-o"></i> PDF</a>
                                <a href="#" class="dropdown-item" target="_blank"><i class="fa fa-file-excel-o"></i> Excel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
            <div class="card-body">
                <h4 class="card-title mb-4">Absen Bulan :</h4>
                <table class="table table-bordered">
                    <thead>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Keterangan</th>
                        <th>Detail</th>
                    </thead>
                    <tbody>
                        @foreach($absensi as $item)
                        <tr>
                            <td>1</td>
                            <td>{{Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y')}}</td>
                            <td>{{$item->jam}}</td>
                            <td>{{$item->keterangan}}</td>
                            <td><button class="btn btn-primary" id="modalfoto"><i class="fa fa-fw fa-eye"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>    
                </table>
            </div>
        </div>
    </div>
</div>
@endsection