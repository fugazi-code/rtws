@extends('layouts.app-map')

@section('content')
    <!--suppress ALL -->
    <div class="from-icon">
        <i class="fa fa-fb"></i>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-block btn-primary" onclick="confirmLocation()">Confirm</button>
        </div>
        <div class="col-md-12">
            <div id="map" style="width: 100vw; height: 100vh;"></div>
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

    <script type="text/javascript">
        var map = L.map('map').fitWorld();
        var layer = null;
        L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/512/{z}/{x}/{y}?title=true&access_token={accessToken}', {
            accessToken: 'pk.eyJ1IjoicmVuaWVyLXRyZW51ZWxhIiwiYSI6ImNrZHhya2l3aTE3OG0ycnBpOWxlYjV3czUifQ.4hVvT7_fiVshoSa9P3uAew',
            maxZoom: 20,
        }).addTo(map);

        var LeafIcon = L.Icon.extend({
            options: {
                iconSize: [95, 95],
                shadowSize: [50, 64],
                iconAnchor: [22, 94],
                shadowAnchor: [4, 62],
                popupAnchor: [-3, -76]
            }
        });

        var fromIcon = new LeafIcon({iconUrl: '/img/from-marker.png'});
        var toIcon = new LeafIcon({iconUrl: '/img/to-marker.png'});

        map.locate({setView: true, maxZoom: 28});

        var fromMarker = null;
        var toMarker = null;

        var fromLatLng = null;
        var toLatLng = null;

        var kilometers = null;

        function onLocationFound(e) {
            var radius = e.accuracy;

            fromLatLng = e.latlng;
            toLatLng = e.latlng;

            fromMarker = L.marker(e.latlng, {'icon': fromIcon, draggable: true}).addTo(map)
            fromMarker.addTo(map);

            toMarker = L.marker(e.latlng, {'icon': toIcon, draggable: true}).addTo(map)
            toMarker.addTo(map);

            L.circle(e.latlng, radius).addTo(map);

            fromMarker.on('move', function (e) {
                fromLatLng = e.latlng
                this.bindPopup("Position is " + e.latlng).openPopup()
                distance()
            });

            toMarker.on('move', function (e) {
                toLatLng = e.latlng
                this.bindPopup("Position is " + e.latlng).openPopup()
                distance()
            });
        }

        function distance() {
            meter = map.distance(fromLatLng, toLatLng);
            kilometers = meter / 100;
        }

        function confirmLocation() {
            var $this = this;
            $.ajax({
                url: '{{ route('booking.location.store') }}',
                method: 'POST',
                data: {
                    fromLatLng: this.fromLatLng.lat + ',' + this.fromLatLng.lng,
                    toLatLng: this.toLatLng.lat + ',' + this.toLatLng.lng,
                    kilometers: this.kilometers
                },
                success: function (value) {
                    window.location = '{{ route('booking') }}';
                }
            });
        }

        map.on('locationfound', onLocationFound);
    </script>
@endsection
