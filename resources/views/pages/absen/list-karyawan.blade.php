@extends('layout/app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">List Karyawan</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Karyawan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Karyawan</th>
                        <th>Nama Divisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->divisi->nama_divisi}}</td>
                                <td>
                                    <a href="{{(request()->is('list-karyawan-rekap')) ? url('/absen-rekap/'.$item->id) : url('/absen/'.$item->id)}}" class="btn btn-primary">
                                    <i class="fas fa-eye"></i>
                                    </a>
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