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
                <h6 class="m-0 font-weight-bold text-primary">Lokasi</h6>
            </div>
            <div class="card-body">
                <h2>Maps</h2>
                <div id="map" style="height:400px;">
                </div>
                <button type="button" class="btn btn-danger mt-4" id="location" onclick="get_current_location()">Cek Lokasi Terkini</button>
                <hr>
                <h2>Foto Absen</h2>
                <button class="btn btn-primary" type="button" onclick="openCam()">Open Camera</button>
                <div id="camera"></div>
                <button class="btn btn-primary mb-2" type="button" style="display: none" id="cameraBtn" onclick="take_picture()"><i
                        class="fa fa-fw fa-camera"></i></button>
                <div class="container-result">
                    <div id="results" class="m-0">
                    </div>
                    <button class="btn btn-danger" type="button" style="display:none;" id="deleteResult" onclick="delete_result()"><i class="fa fa-fw fa-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi User</h6>
            </div>
            <div class="card-body">
                @foreach ($absensi as $item)
                    
                @endforeach
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
                        <input type="time" class="form-control" id="jam" name="jam" readonly>

                    </div>
                    <div class="col-lg-6">
                        <label for="Kode">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" readonly>
                    </div>
                    <div class="col-lg-6">
                        <label for="Kode">Longitude</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" readonly>
                    </div>     
                </div>
                 <input type="hidden" id="keterangan" name="keterangan" value="{{$keterangan}}" class="form-control" readonly>
                <div>
                    @if(count($absensi_check) == 2)
                        <button type='submit' class='btn btn-success mt-2'  id='absen' style='display:none;' disabled>Absen {{$keterangan}}</button>
                    @elseif(Auth::user()->role == 'Admin')
                        <button type='submit' name = 'keterangan' value='Sakit' class='btn btn-danger mt-2' {{isset($absensi) ? 'disabled' : ''}}>Sakit</button>
                        <button type='submit' name = 'keterangan' value='Izin' class='btn btn-warning mt-2' {{isset($absensi) ? 'disabled' : ''}}>Izin</button>
                    @else
                        <button type='submit' class='btn btn-success mt-2'  id='absen' style='display:none;'>Absen {{$keterangan}}</button>
                    @endif
                </div>
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

    var map = L.map('map').setView([-8.670633204301815, 115.20677501572176], 14);
    
 
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 14,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    


    

//get latitude and longitude
  marker.on('dragend', function (e) {
  document.getElementById('latitude').value = marker.getLatLng().lat;
  document.getElementById('longitude').value = marker.getLatLng().lng;
});

    function get_current_location(){
        const location = $("#location")
        navigator.geolocation.getCurrentPosition(function(location) {
        var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);
        console.log(latlng)
        marker = L.marker(latlng).addTo(map)
        document.getElementById('latitude').value = marker.getLatLng().lat;
        document.getElementById('longitude').value = marker.getLatLng().lng;
        map.setView(latlng,14,{animation : true})
        })}


</script>
@endsection
