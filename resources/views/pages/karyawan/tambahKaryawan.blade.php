@extends('layout/app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Karyawan</h1>
    <a href="/karyawan" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
        class="fas fa-arrow-left fa-sm text-white-50"></i>Kembali</a>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Karyawan</h6>
    </div>
    <div class="card-body">
        <form action="/karyawan" method="post">
            @csrf
            <div class="form-group">
                <label for="Divisi">Divisi</label>
                <div class="input-group mb-3">
                    <select class="custom-select" id="inputGroupSelect01" name="divisi">
                    @foreach ($divisi as $item)
                      <option value ="{{$item->id}}">{{$item->kode_divisi}}</option>
                    @endforeach
                    </select>
                  </div>
            </div>
            <div class="form-group">
                <label for="nama">NIK</label>
                <input type="text" class="form-control" name="nik">
            </div>
            <div class="form-group">
                <label for="nama">Nama Karyawan</label>
                <input type="text" class="form-control" name="nama_karyawan">
            </div>
            <div class="form-group">
                <label for="divisi">username</label>
                <input type="text" class="form-control" name="username">
            </div>
            <div class="form-group">
                <label for="divisi">Alamat</label>
                <input type="text" class="form-control" name="alamat">
            </div>
            <div class="form-group">
                <label for="divisi">Email</label>
                <input type="text" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label for="divisi">Nomor Telepon</label>
                <input type="text" class="form-control" name="notelp">
            </div>
            <button type="submit" class="btn btn-dark px-3">Tambah Data</button> 
        </form>
    </div>
</div>
@endsection