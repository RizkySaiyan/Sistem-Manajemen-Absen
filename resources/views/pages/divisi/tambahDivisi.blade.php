@extends('layout/app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Divisi Karyawan</h1>
    <a href="/divisi" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
        class="fas fa-arrow-left fa-sm text-white-50"></i>Kembali</a>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Divisi</h6>
    </div>
    <div class="card-body">
        <form action="/divisi" method="post">
            @csrf
            <div class="form-group">
                <label for="Kode">Kode Divisi</label>
                <input type="text" class="form-control" name="kodedivisi">
            </div>
            <div class="form-group">
                <label for="inputNoRekening">Nama Divisi</label>
                <input type="text" class="form-control" name="namadivisi">
            </div>
            <button type="submit" class="btn btn-dark px-3">Tambah Data</button> 
        </form>
    </div>
</div>
@endsection