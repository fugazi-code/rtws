@extends('layouts.app')

@section('content')
    <!--suppress ALL -->
    <style>
        .btn-info:not(:disabled):not(.disabled).active {
            background-color: #ca8aea !important;
        }
    </style>
    <div class="content" id="app">
        <form method="POST" action="{{ route('booking.submit') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-user">
                        <div class="card-header">
                            <h5 class="title">{{ $page_name }}</h5>
                        </div>
                        <div class="card-body">
                            {{--                            VEHICLE--}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons">
                                        <label class="btn btn-info text-white active">
                                            <input type="radio" name="vehicle" value="motorcycle"
                                                   @click="setVehicle('motorcycle')" checked>
                                            <strong>Motorcycle</strong>
                                        </label>
                                        <label class="btn btn-info text-white">
                                            <input type="radio" name="vehicle" value="car"
                                                   @click="setVehicle('car')">
                                            <strong> Car</strong>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{--                            SERVICES--}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons">
                                        <label class="btn btn-info text-white active">
                                            <input type="radio" name="service" id="padala" value="padala"
                                                   @click="setService('padala')" checked>
                                            <strong>Padala</strong>
                                        </label>
                                        <label class="btn btn-info text-white">
                                            <input type="radio" name="service" id="pabili" value="pabili"
                                                   @click="setService('pabili')">
                                            <strong>Pabili</strong>
                                        </label>
                                        <label class="btn btn-info text-white">
                                            <input type="radio" name="service" id="pa-grocery" value="pa-grocery"
                                                   @click="setService('pa-grocery')">
                                            <strong>Pa-Grocery</strong>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{--                            SUB-CATEG--}}
                            <div class="row">
                                <div class="col-md-12" v-if="form.service == 'padala'">
                                    <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons">
                                        <label class="btn btn-info text-white active">
                                            <input type="radio" name="sub" value="less 10kgs"
                                                   @click="setSub('less 10kgs')" checked>
                                            <strong> less 10kgs</strong>
                                        </label>
                                        <label class="btn btn-info text-white">
                                            <input type="radio" name="sub" value="above 10kgs"
                                                   @click="setSub('above 10kgs')">
                                            <strong> above 10kgs</strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12" v-if="form.service == 'pabili'">
                                    <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons">
                                        <label class="btn btn-info text-white active">
                                            <input type="radio" name="sub" value="less 1k"
                                                   @click="setSub('lessk 1k')" checked>
                                            <strong> less 1k</strong>
                                        </label>
                                        <label class="btn btn-info text-white">
                                            <input type="radio" name="sub" value="above 1k"
                                                   @click="setSub('above 1k')">
                                            <strong> above 1k</strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12" v-if="form.service == 'pa-grocery'">
                                    <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons">
                                        <label class="btn btn-info text-white active">
                                            <input type="radio" name="sub" value="less 2k"
                                                   @click="setSub('less 2k')" checked>
                                            <strong> less 2k</strong>
                                        </label>
                                        <label class="btn btn-info text-white">
                                            <input type="radio" name="sub" value="above 2k"
                                                   @click="setSub('above 2k')">
                                            <strong> above 2k</strong>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label>Pick-Up</label>
                                    <div class="input-group" @click="mapPickUp">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user-circle"></i></div>
                                        </div>
                                        <input type="text" v-model="form.pu.name" class="form-control"
                                               placeholder="Pick-Up">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label>Drop-Off</label>
                                    <div class="input-group" @click="mapDropOff">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user-circle"></i></div>
                                        </div>
                                        <input type="text" v-model="form.dp.name" class="form-control"
                                               placeholder="Drop-Off">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-xs-6">
                                    <label>Schedule Pick-Up</label>
                                    <input type="datetime-local" name="schedule" class="form-control"
                                           v-model="form.schedule_pickup">
                                </div>
                                <div class="col-xs-6">
                                    <label>Amount</label>
                                    <input type="number" name="amount" class="form-control">
                                </div>
                            </div>
                            <div class="row mt-2 justify-content-center">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-block btn-round btn-success">Book Now!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
    <script>
        const e = new Vue({
            el: '#app',
            data: {
                form: {!! $form !!}
            },
            methods: {
                setService(value) {
                    this.form.service = value;
                },
                setVehicle(value) {
                    this.form.vehicle = value;
                },
                setSub(value) {
                    this.form.sub = value;
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
                    $.ajax({
                        url: '{{ route('booking.matrix') }}',
                        method: 'POST',
                        data: $this.form,
                        success: function (value) {

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
            return (c * EARTH_RADIUS * 1000)/1000;
        }

        function toRadian(degree) {
            return degree * Math.PI / 180;
        }
    </script>
@endsection
