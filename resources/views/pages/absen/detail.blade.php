@extends('layout/app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Absensi</h1>
</div>
<form action="/absen" method="post" enctype="multipart/form-data">
    @csrf
<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ini Content</h6>
            </div>
            <div class="card-body">
                <div class="container-result">
                    <div class="card mx-auto">
                        <img src="{{asset("{$absensi->foto_kunjungan}")}}" alt="">
                    </div>
                </div>
                <hr>
                <div id="map" style="height:500px;">
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ini Content</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="Kode">Nama Divisi</label>
                        <input type="text" class="form-control mb-2" name="divisi" value="{{$user->divisi->nama_divisi}}" readonly>
                    </div>
                    <div class="col-lg-12">
                        <label for="inputNoRekening">Nama Karyawan</label>
                        <input type="text" class="form-control mb-2" name="user" value="{{$user->name}}" readonly>
                    </div>
                    <div class="col-lg-12">
                        <label for="Kode">Jam</label>
                        <input type="time" class="form-control" id="jam" name="jam" value="{{$absensi->jam}}" readonly>

                    </div>
                    <div class="col-lg-6">
                        <label for="Kode">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" value="{{$absensi->latitude}}"readonly>
                    </div>
                    <div class="col-lg-6">
                        <label for="Kode">Longitude</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" value="{{$absensi->longitude}}" readonly>
                    </div>
                    <div class="col-lg-12">
                        <label for="Kode">Keterangan</label>     
                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{$keterangan}}" class="form-control" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection
@section('js')
<script>
    function openCam() {
        Webcam.set({
            width: 300,
            height: 300,
            image_format: 'jpeg',
            jpeg_quality: 100
        });

        Webcam.attach('#camera');

        const buttonCam = document.querySelector('#cameraBtn');
        
        buttonCam.style.display = 'block'
    }
    
    const padTo2Digits = (num) => {
        if (typeof num === 'string') return num.padStart(2, '0')
        return num.toString().padStart(2, '0')
    }

    function take_picture() {

        const showImg = document.querySelector('#results');
        const jam = $("#jam");
        const jam_masuk = $("#jam_masuk");
        const jam_keluar = $("#jam_keluar");
        const absen = $("#absen");
        const keterangan = $("#keterangan");
        Webcam.snap(function (picture_data) {

            // display results in page
            const base64image = document.getElementById('results').src;
            document.getElementById('results').innerHTML =
                '<img src="' + picture_data + '"/> <input type="hidden" name="foto" value = "'+ picture_data +'">'

        });
        deleteResult.style.display = 'block'
        showImg.style.display = 'block'
        absen.attr("style","display:block")
        
        const date = new Date();
        const hours = padTo2Digits(date.getHours());
        const minutes = padTo2Digits(date.getMinutes());
        jam.val(`${hours}:${minutes}`);
        
        // if(keterangan.val("Masuk")){
        //     absen.html("<button type='submit' class='btn btn-success mt-2'  id='absen' style='display:block;'>Absen Masuk</button>")
        // }
        // else{
        //     absen.html("<button type='submit' class='btn btn-success mt-2'  id='absen' style='display:block;'>Absen Keluar</button>")
        // }
    }

    function delete_result(){

        const deleteImg = document.querySelector('#results');

        deleteImg.style.display = 'none'
        deleteResult.style.display = 'none'
     }
    const lat = $("#latitude")
    const long = $("#longitude")
    var map = L.map('map').setView([lat.val(),long.val()], 14);
    
 
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 14,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    
    var marker = L.marker([lat.val(),long.val()]).addTo(map);


//get latitude and longitude
  marker.on('dragend', function (e) {
  document.getElementById('latitude').value = marker.getLatLng().lat;
  document.getElementById('longitude').value = marker.getLatLng().lng;
});
@if(Session::has('flash-message'))
    swal({
        title : "{{Session::get('flash-message')}}",
        icon  : "success"
    })
@endif
</script>
@endsection
