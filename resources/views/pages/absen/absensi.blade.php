@extends('layout/app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Absensi</h1>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ini Content</h6>
            </div>
            <div class="card-body">
                <button class="btn btn-primary" onclick="openCam()">Open Camera</button>
                <div id="camera"></div>
                <button class="btn btn-primary" style="display: none" id="cameraBtn" onclick="take_picture()"><i class="fa fa-fw fa-camera"></i></button>
                <div id="results">

                </div>
                <div id="map" style="height:180px;">

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
                <button class="btn btn-primary" onclick="openCam()">Open Camera</button>
                <div id="camera"></div>
                <button class="btn btn-primary" style="display: none" id="cameraBtn" onclick="take_picture()"><i class="fa fa-fw fa-camera"></i></button>
                <div id="results"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    function openCam(){
        Webcam.set({
                width:350,
                height:300,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
        
        Webcam.attach('#camera');
        
        const buttonCam = document.querySelector('#cameraBtn');
        console.log(buttonCam);
        buttonCam.style.display='block'
    }
    function take_picture() {

        Webcam.snap( function(picture_data) {

            // display results in page
            document.getElementById('results').innerHTML = 
            '<img src="'+picture_data+'"/>';

        } );
    }

    var map = L.map('map').setView([51.505, -0.09], 13);
    
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
    </script>
@endsection