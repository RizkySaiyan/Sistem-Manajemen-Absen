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
        <form action="/karyawan/update/{{$user->id}}" method="post">
            @csrf
            <div class="form-group">
                <label for="Divisi">Divisi</label>
                <div class="input-group mb-3">
                    <select class="custom-select" id="inputGroupSelect01" name="divisi">
                    @foreach ($divisi as $item)
                      <option value ="{{$item->id}}">{{$item->nama_divisi}} - {{$item->kode_divisi}}</option>
                    @endforeach
                    </select>
                  </div>
            </div>
            <div class="form-group">
                <label for="Divisi">Role</label>
                <div class="input-group mb-3">
                    <select class="custom-select" id="inputGroupSelect01" name="role">
                      <option value ="Admin" {{$user->role == 'Admin' ? 'selected' : ''}}>Admin</option>
                      <option value ="Staff" {{$user->role == 'Staff' ? 'selected' : ''}}>Staff</option>
                    </select>
                  </div>
            </div>
            <div class="form-group">
                <label for="nama">NIK</label>
                <input type="text" class="form-control" name="nik" value="{{$user->nik}}">
            </div>
            <div class="form-group">
                <label for="nama">Nama Karyawan</label>
                <input type="text" class="form-control" name="nama_karyawan" value="{{$user->name}}">
            </div>
            <div class="form-group">
                <label for="divisi">username</label>
                <input type="text" class="form-control" name="username" value="{{$user->username}}">
            </div>
            <div class="form-group">
                <label for="divisi">Alamat</label>
                <input type="text" class="form-control" name="alamat" value="{{$user->alamat}}">
            </div>
            <div class="form-group">
                <label for="divisi">Email</label>
                <input type="text" class="form-control" name="email" value="{{$user->email}}">
            </div>
            <div class="form-group">
                <label for="divisi">Nomor Telepon</label>
                <input type="text" class="form-control" name="notelp" value="{{$user->notelp}}">
            </div>
            <button type="submit" class="btn btn-dark px-3">Ubah Data</button> 
        </form>
    </div>
</div>
@endsection