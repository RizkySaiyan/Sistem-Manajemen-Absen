@extends('layout/app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Divisi Karyawan</h1>
    <a href="/divisi/tambah" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
        class="fas fa-plus fa-sm text-white-50"></i>Tambah Data Divisi</a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Divisi Karyawan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Divisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{$item->kode_divisi}}</td>
                            <td>{{$item->nama_divisi}}</td>
                        <form action="/divisi/destroy" method="post">
                            <td>
                                <a href="/divisi/edit/{{$item->id}}" class="btn btn-success">
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
$('#datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ url('/divisi') }}",
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'nama_divisi', name: 'nama_divisi'},
        {data: 'kode_divisi', name: 'kode_divisi'},
        {
            data: 'action', 
            name: 'action', 
            orderable: false, 
            searchable: false
        },
    ]
});

</script>
@endsection