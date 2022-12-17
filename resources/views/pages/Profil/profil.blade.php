@extends('layout/app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Profil Karyawan</h1>
</div>

<!-- Content Row -->
<form action="/profil" enctype="multipart/form-data" method="POST">
    @csrf
<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Profil</h6>
            </div>
            <div class="card-body">
                <div class="card mx-auto" style="width:20em;">
                    <img src='{{asset("{$user->path_gambar}")}}' alt="">
                </div>
                <div class="form-group mt-3">
                    <label for="file">Masukkan gambar</label>
                    <input type="file" name="foto" class="form-control-file">
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Profil</h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="Kode Jam Kerja">NIK</label>
                    <input type="text" class="form-control" name="nik" value="{{$user->nik}}">
                </div>
                <div class="form-group">
                    <label for="Kode">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <label for="">No telp</label>
                    <input type="text" class="form-control" name="notelp" value="{{$user->notelp}}">
                </div>
                <div class="form-group">
                    <label for="">email</label>
                    <input type="text" class="form-control" name="email"value="{{$user->email}}">
                </div>
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" class="form-control" name="username"value="{{$user->username}}">
                </div>
                <div class="form-group">
                    <label for="">Password Baru</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <button type="submit" class="btn btn-success px-3">Simpan Data</button> 
            </div>

        </div>
    </div>
</div>
</form>
@endsection
@section('js')
<script>
    @if(Session::has('flash-message'))
        swal({
            title : "{{Session::get('flash-message')}}",
            icon  : "success"
        })
    @endif
</script>
@endsection
