@extends('layouts.app-map')

@section('content')
    <!--suppress ALL -->
    <div class="row">
        <div class="col-md-12">
            <div id="map" style="width: 100vw; height: 95vh"></div>
        </div>
        <div class="col-md-12">
            <button type="button" class="btn btn-block btn-primary" onclick="confirmLocation()">Confirm</button>
        </div>
    </div>
@endsection

@section('scripts')
    <!--suppress ALL -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
          integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
            integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
            crossorigin=""></script>

    <!-- CSS and JS files for Search Box -->
    <script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js"></script>
    <script
        src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js"></script>
    <link rel="stylesheet" type="text/css"
          href="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css">
    <script type="text/javascript">
        // This setup the leafmap object by linking the map() method to the map id (in <div> html element)
        var map = L.map('map', {
            center: [14.164862797000069, 120.8616300000001],
            zoom: 5,
            // minZoom: 1.5,
            //  maxZoom: 1.5
        });

        // Start adding controls as follow... L.controlName().addTo(map);

        // Control 1: This add the OpenStreetMap background tile
        L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/512/{z}/{x}/{y}?title=true&access_token={accessToken}', {
            attribution: '',
            maxZoom: 20,
            accessToken: 'pk.eyJ1IjoicmVuaWVyLXRyZW51ZWxhIiwiYSI6ImNrZHhya2l3aTE3OG0ycnBpOWxlYjV3czUifQ.4hVvT7_fiVshoSa9P3uAew',
        }).addTo(map);


        // Control 2: This add a scale to the map
        L.control.scale().addTo(map);

        // Control 3: This add a Search bar
        var searchControl = new L.esri.Controls.Geosearch().addTo(map);

        var results = new L.LayerGroup().addTo(map);

        var name = null, latlng = null;
        searchControl.on('results', function (data) {
            results.clearLayers();
            for (var i = data.results.length - 1; i >= 0; i--) {
                console.log(data.results[i]);
                name = data.results[i].text;
                latlng = data.results[i].latlng;
                results.addLayer(L.marker(data.results[i].latlng));
            }
        });

        function confirmLocation() {
            $.ajax({
                url: '{{ route('booking.location.store') }}',
                method: 'POST',
                data: {
                    name: name,
                    lat: latlng.lat,
                    lng: latlng.lng
                },
                success: function (value) {
                    window.location = '{{ route('booking') }}';
                }
            })
        }
    </script>
@endsection
