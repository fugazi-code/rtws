@extends('auth.layout.app')

@section('content')
    <!--suppress ALL -->
    <div id="app" class="row">
        <div class="col-md-12">
            <div class="card card-accent-warning">
                <div class="card-header">
                    Book Now
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('booking.submit') }}">
                                @csrf
                                {{--VEHICLE--}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Pick a vehicle</label>
                                        <div class="col-md-9 col-form-label">
                                            <div class="form-check form-check-inline mr-1">
                                                <input class="form-check-input" v-model="form.vehicle"
                                                       id="inline-radio1" type="radio" value="motorcycle"
                                                       name="inline-radios">
                                                <label class="form-check-label" for="inline-radio1">Motorcycle</label>
                                            </div>
                                            <div class="form-check form-check-inline mr-1">
                                                <input class="form-check-input" v-model="form.vehicle"
                                                       id="inline-radio2" type="radio" value="car" name="inline-radios">
                                                <label class="form-check-label" for="inline-radio2">Car</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--SERVICES--}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Pick a service</label>
                                        <div class="col-md-9 col-form-label">
                                            <div class="form-check form-check-inline mr-1">
                                                <input class="form-check-input" v-model="form.service"
                                                       id="inline-radio1" type="radio" value="padala"
                                                       name="inline-radios2">
                                                <label class="form-check-label" for="inline-radio1">padala</label>
                                            </div>
                                            <div class="form-check form-check-inline mr-1">
                                                <input class="form-check-input" v-model="form.service"
                                                       id="inline-radio2" type="radio" value="pabili"
                                                       name="inline-radios2">
                                                <label class="form-check-label" for="inline-radio2">pabili</label>
                                            </div>
                                            <div class="form-check form-check-inline mr-1">
                                                <input class="form-check-input" v-model="form.service"
                                                       id="inline-radio2" type="radio" value="grocery"
                                                       name="inline-radios2">
                                                <label class="form-check-label" for="inline-radio2">grocery</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--PU & DP--}}
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label>Pick-Up</label>
                                        <div class="input-group" @click="mapPickUp">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-search-location"></i>
                                                </div>
                                            </div>
                                            <input type="text" v-model="form.pu.name" name="pick_up"
                                                   class="form-control"
                                                   placeholder="Pick-Up">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label>Drop-Off</label>
                                        <div class="input-group" @click="mapDropOff">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-search-location"></i>
                                                </div>
                                            </div>
                                            <input type="text" v-model="form.dp.name" name="drop_off"
                                                   class="form-control"
                                                   placeholder="Drop-Off">
                                        </div>
                                    </div>
                                </div>
                                {{--SUB-CATEG--}}
                                <div class="row mt-2">
                                    <div class="col-md-12" v-if="form.service == 'padala'">
                                        <label>Weight (kg.)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-balance-scale"></i></div>
                                            </div>
                                            <input type="number" v-model="form.weight" name="weight"
                                                   class="form-control"
                                                   placeholder="Weight in kilograms" @keyup="matrix()">
                                        </div>
                                    </div>
                                    <div class="col-md-12" v-else>
                                        <label>Budget</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-coins"></i></div>
                                            </div>
                                            <input type="text" v-model="form.budget" name="budget" class="form-control"
                                                   placeholder="Budget in Peso">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-6">
                                        <label>Schedule Pick-Up</label>
                                        <input type="datetime-local" name="schedule" class="form-control"
                                               v-model="form.schedule_pickup">
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Delivery Fee</label>
                                        <input type="text" name="amount" class="form-control" v-model="form.amount"
                                               readonly>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Kilometers</label>
                                        <input type="text" name="kilometers" class="form-control"
                                               v-model="form.kilometers"
                                               readonly>
                                    </div>
                                </div>
                                <div class="row mt-2 justify-content-center">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-block btn-round btn-success">Book Now!
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!--suppress ALL -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
          integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
            integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
            crossorigin=""></script>
    <script>
        const e = new Vue({
            el: '#app',
            data: {
                form: {!! $form !!}
            },
            methods: {
                setService(value) {
                    this.form.service = value;
                    this.matrix();
                },
                setVehicle(value) {
                    this.form.vehicle = value;
                    this.matrix();
                },
                setSub(value) {
                    this.form.sub = value;
                    this.matrix();
                },
                mapMdl() {
                    var $this = this;
                    $('#mapModal').modal('show');
                },
                mapPickUp() {
                    this.form.setup = 'pu'
                    window.location = '/m/m?' + $.param(this.form)
                },
                mapDropOff() {
                    this.form.setup = 'dp'
                    window.location = '/m/m?' + $.param(this.form)
                },
                matrix() {
                    var $this = this;
                    $this.form.kilometers = Math.round($this.form.kilometers);
                    $.ajax({
                        url: '{{ route('booking.matrix') }}',
                        method: 'POST',
                        data: $this.form,
                        success: function (value) {
                            $this.form.amount = value;
                        }
                    })
                }
            },
            mounted() {
                var $this = this;
                if ($this.form.pu.name != null && $this.form.dp.name != null) {
                    kilometers = getDistance(
                        [$this.form.pu.lat, $this.form.pu.lng],
                        [$this.form.dp.lat, $this.form.dp.lng]
                    );
                    $this.form.kilometers = kilometers;
                    $this.matrix();
                }
            }
        });

        function getDistance(origin, destination) {
            // return distance in meters
            var lat1 = toRadian(origin[0]),
                lon1 = toRadian(origin[1]),
                lat2 = toRadian(destination[0]),
                lon2 = toRadian(destination[1]);

            var deltaLat = lat2 - lat1;
            var deltaLon = lon2 - lon1;

            var a = Math.pow(Math.sin(deltaLat / 2), 2) + Math.cos(lat1) * Math.cos(lat2) * Math.pow(Math.sin(deltaLon / 2), 2);
            var c = 2 * Math.asin(Math.sqrt(a));
            var EARTH_RADIUS = 6371;
            return (c * EARTH_RADIUS * 1000) / 1000;
        }

        function toRadian(degree) {
            return degree * Math.PI / 180;
        }
    </script>
@endsection
