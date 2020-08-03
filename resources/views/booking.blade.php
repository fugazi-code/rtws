@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-user">
                    <div class="card-header">
                        <h5 class="title">{{ $page_name }}</h5>
                    </div>
                    <div class="card-body">
                        <style>
                            .btn-info:not(:disabled):not(.disabled).active {
                                background-color: #ca8aea !important;
                            }
                        </style>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="btn-group btn-group-toggle btn-block" data-toggle="buttons">
                                    <label class="btn btn-info text-white active">
                                        <input type="radio" name="motorcycle" checked> <strong>Motorcycle</strong>
                                    </label>
                                    <label class="btn btn-info text-white">
                                        <input type="radio" name="car"><strong> Car</strong>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="padala" type="checkbox" value="padala">
                                        Padala – less 10 kgs, above 10 kgs
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="pabili" type="checkbox" value="pabili">
                                        Pabili – less Php 1k , above 1k
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="Pa-grocery" type="checkbox" value="">
                                        Pa–grocery – less Php 2k , above 2k
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 row mt-4">
                            <div class="col-md-12">
                                <label>Schedule Pick-Up</label>
                                <input type="datetime-local" name="schedule" class="form-control">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label>Pick-Up</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="now-ui-icons location_pin"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="pick-up" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label>Drop-Off</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="now-ui-icons location_pin"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="drop-off" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-2">
                            <label>Amount</label>
                            <input type="number" name="amount" class="form-control">
                        </div>
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12 mt-4">--}}
{{--                                <label>Note to Rider</label>--}}
{{--                                <textarea name="note" class="form-control" placeholder="(Optional)"></textarea>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-md-12 mt-4">
                            <button type="submit" class="btn btn-round btn-success">Book Now!</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
