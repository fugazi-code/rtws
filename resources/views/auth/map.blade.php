@extends('layouts.app-map')

@section('content')
    <!--suppress ALL -->
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-block btn-primary" onclick="confirmLocation()">Confirm</button>
        </div>
        <div class="col-md-12">
            <div id="map" style="width: 100vw; height: 95vh"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- leaflet library -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.3/leaflet.js"></script>
    <script type="text/javascript" src="https://tiles.unwiredmaps.com/js/leaflet-unwired.js"></script>

    <!-- location control -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.css"/>
    <!-- location control -->
    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.js"
            charset="utf-8"></script>
    <!-- geocoding plugin -->
    <link rel="stylesheet"
          href="https://maps.locationiq.com/v2/libs/leaflet-geocoder/1.9.5/leaflet-geocoder-locationiq.min.css">
    <script
        src="https://maps.locationiq.com/v2/libs/leaflet-geocoder/1.9.5/leaflet-geocoder-locationiq.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-plugins/3.0.2/control/Permalink.js"></script>

    <script type="text/javascript">
        // Maps access token goes here
        var key = 'pk.d77cc8e3aa8354c6533770b02a1c9046';

        // Add layers that we need to the map
        var streets = L.tileLayer.Unwired({key: key, scheme: "streets"});

        // Initialize the map
        var map = L.map('map', {
            center: [12.2205183, 122.3861085], // Map loads with this location as center
            zoom: 6,
            scrollWheelZoom: true,
            layers: [streets],
            zoomControl: false
        });

        // Add the 'zoom' control
        L.control.zoom({
            position: 'topleft'
        }).addTo(map);

        // Add the 'scale' control
        L.control.scale().addTo(map);
        L.control.locate({
            position: "bottomright"
        }).addTo(map);

        // Add the autocomplete text box
        var name = null, latlng = null, marker = null;
        L.control.geocoder(key, {
            placeholder: 'Search nearby...',
            url: "https://api.locationiq.com/v1",
            expanded: true,
            panToPoint: true,
            focus: true,
            expanded: true,
            markers: false,
            params: {
                countrycodes: 'PH'
            },
            position: "topleft"
        }).on('select', function (ev) {
            latlng = ev.latlng;
            name = ev.feature.innerText
            if (marker != undefined) {
                map.removeLayer(marker);
            };

            marker = L.marker(ev.latlng, {
                draggable: true
            }).addTo(map);

            marker.on('dragend', function (event) {
                var position = marker.getLatLng();
                latlng = marker.getLatLng();
                name = marker.getLatLng();
            });

            map.setView(ev.latlng, 16);
        }).addTo(map);

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
                    window.location = '{{ route('book') }}';
                }
            });
        }

        map.addControl(new L.Control.Permalink({useLocation: true, text: null}));
    </script>
@endsection
