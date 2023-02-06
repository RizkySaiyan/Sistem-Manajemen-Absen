@extends('layout/app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <div class="d-none d-inline-block">Bulan Januari</div>
</div>

<!-- Content Row -->


<!-- Content Row -->

<!-- Content Row -->
<div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Jumlah Staff
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$user}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Jumlah Sakit
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$sakit}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-hospital fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Jumlah Izin
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$ijin}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!-- Donut Chart -->
    <div class="col-xl-12 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Performa</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4">
                    <canvas id="myPieChart"></canvas>
                </div>
                <hr>
                Styling for the donut chart can be found in the
                <code>/js/demo/chart-pie-demo.js</code> file.
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    const ctx = document.getElementById('myPieChart');
    const jumlah_terlambat = <?php echo json_encode($jumlah_terlambat); ?>;

    const jumlah_tepatwaktu = <?php echo json_encode($jumlah_tepatwaktu); ?>;
    
    new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ['Karyawan Tepat Waktu', 'Karyawan Terlambat'],
            datasets: [{
              label: 'Jumlah',
              data: [jumlah_tepatwaktu, jumlah_terlambat],
              borderWidth: 1,
              backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc']
            }]
          },
          
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            },
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Persentase Siswa Yang Menunggak'
                },
            },
        }
        });
</script>
@endsection