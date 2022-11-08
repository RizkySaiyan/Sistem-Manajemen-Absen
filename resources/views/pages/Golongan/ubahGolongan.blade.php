@extends('layout/app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Golongan Karyawan</h1>
    <a href="/golongan" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
        class="fas fa-arrow-left fa-sm text-white-50"></i>Kembali</a>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Golongan</h6>
    </div>
    <div class="card-body">
        <form action="/golongan/update/{{$golongan->id}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$golongan->id}}">
            <div class="form-group">
                <label for="inputNoRekening">Nama Golongan</label>
                <input type="text" class="form-control" name="namadivisi" value="{{$golongan->nama_golongan}}">
            </div>
            <button type="submit" class="btn btn-dark px-3">Edit Data</button> 
        </form>
    </div>
</div>
@endsection