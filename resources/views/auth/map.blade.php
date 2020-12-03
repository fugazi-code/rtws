@extends('layouts.app-map')

@section('content')
    <!--suppress ALL -->
    <div class="row">
        <div class="col-md-12">
            <div class="btn-group" role="group" style="display: flex;">
                <button type="button" class="btn btn-primary" onclick="confirmLocation()">Confirm</button>
                <a href="{{ route('book') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
        <div class="col-md-12">
            <div id="map" style="width: 100vw; height: 95vh"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" defer>
        // init map
        var map = L.map('map', {
            zoomControl: false
        }).setView([14.434354283557754, 120.9925489160215], 6);

        // init map style
        var tiles = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });

        // init zoom control
        L.control.zoom({
            position: 'topright'
        }).addTo(map);

        // init marker Group
        var markerGroup = new L.layerGroup().addTo(map);

        // init events for map interaction
        function onMapClick(e) {
            markerGroup.clearLayers();
            marker = new L.marker(e.latlng);
            marker.addTo(markerGroup);
            reverseGeocoding(e.latlng)
        };

        function onSearch(latlng) {
            markerGroup.clearLayers();
            marker = new L.marker(latlng);
            marker.addTo(markerGroup);
        }

        map.on('click', onMapClick);

        map.addLayer(tiles);

        // init autocomplete Google maps searchables
        var g_name = '';
        new L.Control.GPlaceAutocomplete({
            callback: function (place) {
                var loc = place.geometry.location;
                g_name = place.formatted_address;

                map.panTo([loc.lat(), loc.lng()]);
                map.setZoom(15);

                g_lat = loc.lat();
                g_lng = loc.lng()
                onSearch([loc.lat(), loc.lng()])
            },
            position: 'topleft'
        }).addTo(map);

        // init function confirm location
        function confirmLocation() {
            $.ajax({
                url: '{{ route('booking.location.store') }}',
                method: 'POST',
                data: {
                    name: g_name,
                    lat: g_lat,
                    lng: g_lng
                },
                success: function (value) {
                    window.location = '{{ route('book') }}';
                }
            });
        }

        function reverseGeocoding(latlng) {
            var geocoder = new google.maps.Geocoder();
            var address = 'London, UK';

            if (geocoder) {
                geocoder.geocode({'location': {lat: latlng.lat, lng: latlng.lng}},
                    function (results, status) {
                        g_lat = results[0].geometry.location.lat();
                        g_lng = results[0].geometry.location.lng()
                        g_name = results[0].formatted_address
                    });
            }
        }
    </script>
@endsection
