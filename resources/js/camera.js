Webcam.set({
        width:350,
        height:300,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

Webcam.attach('#camera');

    function take_picture() {

        Webcam.snap( function(picture_data) {

            // display results in page
            document.getElementById('results').innerHTML = 
            '<img src="'+picture_data+'"/>';

        } );
    }
