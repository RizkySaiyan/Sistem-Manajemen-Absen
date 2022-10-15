@extends('layout/app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Jam Kerja</h1>
    <a href="/jam-kerja" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
        class="fas fa-arrow-left fa-sm text-white-50"></i>Kembali</a>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Jam Kerja</h6>
    </div>
    <div class="card-body">
        <form action="/jam-kerja" method="post">
            @csrf
            <div class="form-group">
                <label for="Kode Jam Kerja">Divisi</label>
                <div class="input-group mb-3">
                    <select class="custom-select" id="inputGroupSelect01" name="divisi">
                    @foreach ($divisi as $item)
                      <option value ="{{$item->id}}">{{$item->kode_divisi}}</option>
                    @endforeach
                    </select>
                  </div>
            </div>
            <div class="form-group">
                <label for="Kode">Jam Mulai</label>
                <input type="time" class="form-control" name="jam_mulai">
            </div>
            <div class="form-group">
                <label for="inputNoRekening">Jam Selesai</label>
                <input type="time" class="form-control" name="jam_selesai">
            </div>
            <button type="submit" class="btn btn-dark px-3">Tambah Data</button> 
        </form>
    </div>
</div>
@endsection