@extends('layout/app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Golongan Karyawan</h1>
    <a href="/goloangan/tambah" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
        class="fas fa-plus fa-sm text-white-50"></i>Tambah Data Golongan</a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Golongan Karyawan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama golongan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{$item->nama_golongan}}</td>
                        <form action="/golongan/destroy/{{$item->id}}" method="post">
                            @csrf
                            <td>
                                <a href="/golongan/edit/{{$item->id}}" class="btn btn-success">
                                <i class="fas fa-edit"></i>
                                </a>
                                <button class="delete btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
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