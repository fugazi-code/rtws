@extends('layouts.app-map')

@section('content')
    <!--suppress ALL -->
    <div id="map" style="width: 100vw; height: 100vh;"></div>
@endsection

@section('scripts')
    <!--suppress ALL -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
          integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
            integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
            crossorigin=""></script>

    <script type="text/javascript">
        var map = L.map('map').fitWorld();
        L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/512/{z}/{x}/{y}?title=true&access_token={accessToken}', {
            accessToken: 'pk.eyJ1IjoicmVuaWVyLXRyZW51ZWxhIiwiYSI6ImNrZHhya2l3aTE3OG0ycnBpOWxlYjV3czUifQ.4hVvT7_fiVshoSa9P3uAew',
            maxZoom: 20,
        }).addTo(map);

        map.locate({setView: true, maxZoom: 28});

        function onLocationFound(e) {
            var radius = e.accuracy;
            L.marker(e.latlng).addTo(map)
            L.circle(e.latlng, radius).addTo(map);
        }

        function onChangeMarkerLocation(e) {
            L.marker(e.latlng).addTo(map)
        }
        map.on('locationfound', onLocationFound);
        map.on('dblclick', onChangeMarkerLocation);
    </script>
@endsection
